-- Service landing pages feature migrations
-- Run this in phpMyAdmin after deploying to production.

CREATE TABLE `service_pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `title` json NOT NULL,
  `subtitle` json NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `video_url` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_pages_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `service_page_faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_page_id` bigint unsigned NOT NULL,
  `question` json NOT NULL,
  `answer` json NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_page_faqs_service_page_id_foreign` (`service_page_id`),
  CONSTRAINT `service_page_faqs_service_page_id_foreign`
    FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Register migrations in Laravel's migrations table
INSERT INTO `migrations` (`migration`, `batch`)
SELECT m.migration, COALESCE(MAX(b.batch), 0) + 1
FROM (
  SELECT '2026_06_17_000001_create_service_pages_table' AS migration UNION ALL
  SELECT '2026_06_17_000002_create_service_page_faqs_table' AS migration
) m
CROSS JOIN migrations b;
