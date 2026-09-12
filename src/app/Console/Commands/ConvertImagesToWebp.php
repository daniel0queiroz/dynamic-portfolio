<?php

namespace App\Console\Commands;

use App\Services\ImageWebpMigrationService;
use Illuminate\Console\Command;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp {--quality=82} {--max-dimension=1920}';

    protected $description = 'Convert existing JPEG/PNG uploads to WebP and update DB references';

    public function handle(ImageWebpMigrationService $service): int
    {
        $this->info('Converting existing uploads to WebP...');

        $results = $service->run(
            quality: (int) $this->option('quality'),
            maxDimension: (int) $this->option('max-dimension'),
        );

        $savedBytes = 0;
        foreach ($results['converted'] as $item) {
            $savedBytes += $item['old_size'] - $item['new_size'];
            $this->line(sprintf(
                '  %s -> %s (%s -> %s, %d row(s) updated)',
                $item['old'],
                $item['new'],
                $this->formatBytes($item['old_size']),
                $this->formatBytes($item['new_size']),
                $item['rows_updated']
            ));
        }

        foreach ($results['skipped'] as $skipped) {
            $this->comment("  skipped: {$skipped}");
        }

        foreach ($results['errors'] as $error) {
            $this->error("  error: {$error}");
        }

        $this->newLine();
        $this->info(sprintf(
            'Done. Converted: %d, Skipped: %d, Errors: %d, Saved: %s',
            count($results['converted']),
            count($results['skipped']),
            count($results['errors']),
            $this->formatBytes($savedBytes)
        ));

        return self::SUCCESS;
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes < 1024) {
            return $bytes . ' B';
        }
        if ($bytes < 1024 * 1024) {
            return round($bytes / 1024, 1) . ' KB';
        }
        return round($bytes / (1024 * 1024), 2) . ' MB';
    }
}
