<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * One-off migration: re-encode every existing JPEG/PNG upload to WebP and
 * rewrite the DB columns that reference them, so already-uploaded images
 * benefit from the same optimization the upload pipeline now applies to
 * new files. Safe to run more than once — already-converted files are
 * simply skipped on subsequent runs.
 */
class ImageWebpMigrationService
{
    /** table => [columns that may hold an "uploads/..." image path] */
    protected const COLUMNS = [
        'heroes' => ['image'],
        'link_page_settings' => ['profile_image'],
        'abouts' => ['image'],
        'blogs' => ['image'],
        'general_settings' => ['logo', 'footer_logo', 'favicon'],
        'link_items' => ['thumbnail'],
        'portfolio_items' => ['image'],
        'experiences' => ['image'],
        'service_pages' => ['image', 'mobile_image'],
        'skill_section_settings' => ['image'],
    ];

    protected const OPTIMIZABLE_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    public function run(int $quality = 82, int $maxDimension = 1920): array
    {
        $manager = new ImageManager(new Driver());
        $disk = Storage::disk('uploads');

        $results = ['converted' => [], 'skipped' => [], 'errors' => []];

        foreach ($disk->allFiles() as $path) {
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (!in_array($extension, self::OPTIMIZABLE_EXTENSIONS, true)) {
                continue;
            }

            $oldFilename = basename($path);
            $newFilename = pathinfo($oldFilename, PATHINFO_FILENAME) . '.webp';
            $directory = dirname($path);
            $newPath = ($directory === '.') ? $newFilename : $directory . '/' . $newFilename;

            try {
                $originalSize = $disk->size($path);
                $encoded = (string) $manager->read($disk->path($path))
                    ->scaleDown($maxDimension, $maxDimension)
                    ->toWebp(quality: $quality);

                if (strlen($encoded) >= $originalSize) {
                    $results['skipped'][] = "{$path} (WebP not smaller, kept original)";
                    continue;
                }

                $disk->put($newPath, $encoded);

                $rowsUpdated = $this->updateReferences($oldFilename, $newFilename);

                $disk->delete($path);

                $results['converted'][] = [
                    'old' => $path,
                    'new' => $newPath,
                    'old_size' => $originalSize,
                    'new_size' => strlen($encoded),
                    'rows_updated' => $rowsUpdated,
                ];
            } catch (\Throwable $e) {
                $results['errors'][] = "{$path}: {$e->getMessage()}";
            }
        }

        return $results;
    }

    protected function updateReferences(string $oldFilename, string $newFilename): int
    {
        $count = 0;

        foreach (self::COLUMNS as $table => $columns) {
            if (!DB::getSchemaBuilder()->hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                $rows = DB::table($table)
                    ->where($column, 'like', '%' . $oldFilename)
                    ->get(['id', $column]);

                foreach ($rows as $row) {
                    $newValue = str_replace($oldFilename, $newFilename, $row->{$column});
                    DB::table($table)->where('id', $row->id)->update([$column => $newValue]);
                    $count++;
                }
            }
        }

        return $count;
    }
}
