-- Floating WhatsApp contact button: global toggle + phone number + per-language pre-filled message
-- Run these in order via phpMyAdmin on production.

-- 1. Create whatsapp_settings table
CREATE TABLE `whatsapp_settings` (
  `id`           BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `is_enabled`   TINYINT(1) NOT NULL DEFAULT 0,
  `phone_number` VARCHAR(255) NULL,
  `message`      JSON NULL,
  `created_at`   TIMESTAMP NULL,
  `updated_at`   TIMESTAMP NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. Seed the single settings row
INSERT INTO `whatsapp_settings` (`is_enabled`, `phone_number`, `message`, `created_at`, `updated_at`)
VALUES (0, NULL, NULL, NOW(), NOW());

-- 3. Register migration
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_22_000000_create_whatsapp_settings_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
