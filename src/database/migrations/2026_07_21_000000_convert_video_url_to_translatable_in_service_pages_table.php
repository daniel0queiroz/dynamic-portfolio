<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Wrap existing plain-text value in {"en": "value"} JSON format
        DB::statement("
            UPDATE `service_pages`
            SET `video_url` = CASE
                WHEN `video_url` IS NULL OR `video_url` = ''
                    THEN NULL
                ELSE JSON_OBJECT('en', `video_url`)
            END
        ");

        // Convert column to JSON type
        DB::statement('ALTER TABLE `service_pages` MODIFY COLUMN `video_url` JSON NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE `service_pages` MODIFY COLUMN `video_url` VARCHAR(500) NULL');

        DB::statement("
            UPDATE `service_pages`
            SET `video_url` = JSON_UNQUOTE(JSON_EXTRACT(`video_url`, '$.en'))
        ");
    }
};
