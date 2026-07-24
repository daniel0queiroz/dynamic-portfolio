-- Footer useful links drag-and-drop reorder migration
-- Run this in phpMyAdmin after deploying the reorder feature to production.

ALTER TABLE `footer_useful_links`
  ADD COLUMN `sort_order` int NOT NULL DEFAULT 0 AFTER `url`;

-- Register migration in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_24_000003_add_sort_order_to_footer_useful_links_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
