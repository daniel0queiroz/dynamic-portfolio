<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Tables and their translatable columns.
     */
    protected array $tables = [
        'heroes'                      => ['title', 'sub_title', 'btn_text'],
        'typer_titles'                => ['title'],
        'services'                    => ['name', 'description'],
        'abouts'                      => ['title', 'description'],
        'categories'                  => ['name'],
        'portfolio_items'             => ['title', 'description', 'client'],
        'skill_items'                 => ['name'],
        'experiences'                 => ['title', 'description'],
        'feedback'                    => ['name', 'position', 'description'],
        'blogs'                       => ['title', 'description'],
        'blog_categories'             => ['name'],
        'portfolio_section_settings'  => ['title', 'sub_title'],
        'skill_section_settings'      => ['title', 'sub_title'],
        'feedback_section_settings'   => ['title', 'sub_title'],
        'blog_section_settings'       => ['title', 'sub_title'],
        'contact_section_settings'    => ['title', 'sub_title'],
        'footer_infos'                => ['info', 'copy_right'],
        'footer_help_links'           => ['name'],
        'footer_useful_links'         => ['name'],
        'privacy_policies'            => ['title', 'description'],
        'seo_settings'                => ['title', 'description', 'keywords'],
    ];

    public function up(): void
    {
        foreach ($this->tables as $table => $columns) {
            foreach ($columns as $column) {
                // Wrap existing plain-text value in {"en": "value"} JSON format
                DB::statement("
                    UPDATE `{$table}`
                    SET `{$column}` = CASE
                        WHEN `{$column}` IS NULL OR `{$column}` = ''
                            THEN '{\"en\":\"\"}'
                        ELSE JSON_OBJECT('en', `{$column}`)
                    END
                ");

                // Convert column to JSON type
                DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` JSON NULL");
            }
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table => $columns) {
            foreach ($columns as $column) {
                // Convert JSON column back to text
                DB::statement("ALTER TABLE `{$table}` MODIFY COLUMN `{$column}` TEXT NULL");

                // Extract the English value back to plain text
                DB::statement("
                    UPDATE `{$table}`
                    SET `{$column}` = COALESCE(
                        JSON_UNQUOTE(JSON_EXTRACT(`{$column}`, '$.en')),
                        ''
                    )
                ");
            }
        }
    }
};
