-- Typer titles drag-and-drop reorder migration
-- Run this in phpMyAdmin after deploying the reorder feature to production.

ALTER TABLE `typer_titles`
  ADD COLUMN `sort_order` int NOT NULL DEFAULT 0 AFTER `title`;

-- Register migration in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_24_000007_add_sort_order_to_typer_titles_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
