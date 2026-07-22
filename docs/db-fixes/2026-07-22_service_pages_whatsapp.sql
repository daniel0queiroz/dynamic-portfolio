-- Per-landing-page floating WhatsApp button: toggle + phone number + per-language pre-filled message
-- Run these in order via phpMyAdmin on production.

-- 1. Add WhatsApp columns to service_pages
ALTER TABLE `service_pages`
  ADD COLUMN `whatsapp_enabled` TINYINT(1) NOT NULL DEFAULT 0 AFTER `faq_enabled`,
  ADD COLUMN `whatsapp_number`  VARCHAR(255) NULL AFTER `whatsapp_enabled`,
  ADD COLUMN `whatsapp_message` JSON NULL AFTER `whatsapp_number`;

-- 2. Register migration
INSERT INTO `migrations` (`migration`, `batch`)
SELECT '2026_07_22_000001_add_whatsapp_fields_to_service_pages_table', COALESCE(MAX(batch), 0) + 1
FROM migrations;
