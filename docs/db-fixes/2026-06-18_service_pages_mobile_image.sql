-- Add mobile_image column to service_pages
-- Run in phpMyAdmin after deploying.

ALTER TABLE `service_pages`
  ADD COLUMN `mobile_image` varchar(255) DEFAULT NULL AFTER `image`;

-- Register migration
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_06_18_000000_add_mobile_image_to_service_pages_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
