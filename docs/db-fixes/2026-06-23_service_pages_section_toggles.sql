-- Add lead_form_enabled and faq_enabled toggle columns to service_pages
-- Run in phpMyAdmin after deploying.

ALTER TABLE `service_pages`
  ADD COLUMN `lead_form_enabled` TINYINT(1) NOT NULL DEFAULT 1 AFTER `form_success_message`,
  ADD COLUMN `faq_enabled`       TINYINT(1) NOT NULL DEFAULT 1 AFTER `lead_form_enabled`;

-- Register migration
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_06_23_000000_add_section_toggles_to_service_pages_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
