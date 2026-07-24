-- Services drag-and-drop reorder migration
-- Run this in phpMyAdmin after deploying the reorder feature to production.

ALTER TABLE `services`
  ADD COLUMN `sort_order` int NOT NULL DEFAULT 0 AFTER `link`;

-- Register migration in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_24_000005_add_sort_order_to_services_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
