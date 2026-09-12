-- Adds page_title/page_subtitle columns to feedback_section_settings, so
-- the /testimonial page's heading and subtitle text become admin-editable.
-- Run via phpMyAdmin on production.

ALTER TABLE `feedback_section_settings`
  ADD COLUMN `page_title`    JSON NULL AFTER `cta_label`,
  ADD COLUMN `page_subtitle` JSON NULL AFTER `page_title`;

INSERT INTO migrations (migration, batch) VALUES
('2026_09_12_210000_add_page_title_subtitle_to_feedback_section_settings_table', (SELECT batch FROM (SELECT MAX(batch) AS batch FROM migrations) AS m) + 1);
