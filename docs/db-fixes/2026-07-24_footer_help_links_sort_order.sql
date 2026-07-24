-- Footer help links drag-and-drop reorder migration
-- Run this in phpMyAdmin after deploying the reorder feature to production.

ALTER TABLE `footer_help_links`
  ADD COLUMN `sort_order` int NOT NULL DEFAULT 0 AFTER `url`;

-- Register migration in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_24_000001_add_sort_order_to_footer_help_links_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
