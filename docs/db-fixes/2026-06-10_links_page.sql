-- Links page feature migrations
-- Run this in phpMyAdmin after deploying the links-page feature to production.

CREATE TABLE `link_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `url` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `link_page_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `profile_name` json NOT NULL,
  `profile_bio` json NOT NULL,
  `default_locale` varchar(5) NOT NULL DEFAULT 'en',
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Register migrations in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT m.migration, COALESCE(MAX(b.batch), 0) + 1
FROM (
  SELECT '2026_06_10_000000_create_link_items_table'          AS migration UNION ALL
  SELECT '2026_06_10_000001_create_link_page_settings_table'  AS migration UNION ALL
  SELECT '2026_06_10_000002_add_profile_image_to_link_page_settings' AS migration
) m
CROSS JOIN migrations b;
