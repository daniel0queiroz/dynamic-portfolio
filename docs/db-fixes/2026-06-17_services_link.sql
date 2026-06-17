-- Services link field migration
-- Run this in phpMyAdmin after deploying the services-link feature to production.

ALTER TABLE `services`
  ADD COLUMN `link` varchar(255) DEFAULT NULL AFTER `description`;

-- Register migration in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_06_17_000000_add_link_to_services_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
