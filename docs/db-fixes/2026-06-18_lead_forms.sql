-- Lead form system: form config columns + lead_form_fields, leads, lead_answers tables
-- Run these in order via phpMyAdmin on production.

-- 1. Add form config columns to service_pages
ALTER TABLE `service_pages`
  ADD COLUMN `form_title`           JSON NULL AFTER `video_url`,
  ADD COLUMN `form_subtitle`        JSON NULL AFTER `form_title`,
  ADD COLUMN `cta_label`            JSON NULL AFTER `form_subtitle`,
  ADD COLUMN `form_success_message` JSON NULL AFTER `cta_label`;

-- 2. Create lead_form_fields table
CREATE TABLE `lead_form_fields` (
  `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_page_id` BIGINT UNSIGNED NOT NULL,
  `label`           JSON NOT NULL,
  `placeholder`     JSON NULL,
  `type`            ENUM('text','email','tel','textarea','select') NOT NULL DEFAULT 'text',
  `options`         JSON NULL,
  `is_required`     TINYINT(1) NOT NULL DEFAULT 1,
  `sort_order`      INT NOT NULL DEFAULT 0,
  `created_at`      TIMESTAMP NULL,
  `updated_at`      TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `lead_form_fields_service_page_id_index` (`service_page_id`),
  CONSTRAINT `lead_form_fields_service_page_id_foreign`
    FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. Create leads table
CREATE TABLE `leads` (
  `id`              BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `service_page_id` BIGINT UNSIGNED NOT NULL,
  `locale`          VARCHAR(8) NOT NULL DEFAULT 'en',
  `ip_address`      VARCHAR(45) NULL,
  `user_agent`      TEXT NULL,
  `lgpd_consent`    TINYINT(1) NOT NULL DEFAULT 0,
  `created_at`      TIMESTAMP NULL,
  `updated_at`      TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `leads_service_page_id_index` (`service_page_id`),
  CONSTRAINT `leads_service_page_id_foreign`
    FOREIGN KEY (`service_page_id`) REFERENCES `service_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. Create lead_answers table
CREATE TABLE `lead_answers` (
  `id`         BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lead_id`    BIGINT UNSIGNED NOT NULL,
  `field_id`   BIGINT UNSIGNED NULL,
  `value`      TEXT NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  PRIMARY KEY (`id`),
  KEY `lead_answers_lead_id_index` (`lead_id`),
  KEY `lead_answers_field_id_index` (`field_id`),
  CONSTRAINT `lead_answers_lead_id_foreign`
    FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lead_answers_field_id_foreign`
    FOREIGN KEY (`field_id`) REFERENCES `lead_form_fields` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. Register migrations
INSERT INTO `migrations` (`migration`, `batch`) VALUES
  ('2026_06_18_000001_add_form_config_to_service_pages_table', 99),
  ('2026_06_18_000002_create_lead_form_fields_table', 99),
  ('2026_06_18_000003_create_leads_table', 99),
  ('2026_06_18_000004_create_lead_answers_table', 99);
