<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ImageWebpMigrationService;

class MaintenanceController extends Controller
{
    /**
     * One-time (safe to re-run) maintenance action: convert existing
     * JPEG/PNG uploads to WebP and update the DB rows that reference them.
     * Exists as a web route (instead of an artisan command) because
     * production is deployed over FTP with no shell/SSH access.
     */
    public function convertImagesToWebp(ImageWebpMigrationService $service)
    {
        set_time_limit(300);

        $results = $service->run();

        return view('admin.maintenance.convert-images-webp', compact('results'));
    }
}
