-- Adds role/company split + is_active moderation flag to `feedback`,
-- and a cta_label column to `feedback_section_settings` (the "Add Yours"
-- button text). Run these in order via phpMyAdmin on production.

ALTER TABLE `feedback`
  ADD COLUMN `role`      JSON NULL AFTER `position`,
  ADD COLUMN `company`   JSON NULL AFTER `role`,
  ADD COLUMN `is_active` TINYINT(1) NOT NULL DEFAULT 1 AFTER `description`;

ALTER TABLE `feedback_section_settings`
  ADD COLUMN `cta_label` JSON NULL AFTER `sub_title`;

INSERT INTO migrations (migration, batch) VALUES
('2026_09_12_191323_add_role_company_is_active_to_feedback_table', (SELECT batch FROM (SELECT MAX(batch) AS batch FROM migrations) AS m) + 1),
('2026_09_12_191324_add_cta_label_to_feedback_section_settings_table', (SELECT batch FROM (SELECT MAX(batch) AS batch FROM migrations) AS m) + 1);

-- Content migration: split the existing "Brayam Dias" testimonial's
-- position ("Founder — Cleath Ophthalmology Marketing Consulting") into the
-- new role/company columns. Run the SELECT first to confirm this is the
-- right row (ids can differ from the dev DB) before running the UPDATE.
-- Existing typo "Oftamológico" (vs "Oftalmológico") in the pt value is
-- preserved as-is, not corrected here.

SELECT id, name, position FROM feedback WHERE id = 8;

UPDATE feedback
SET
  role = JSON_OBJECT('en', 'Founder', 'es', 'Fundador', 'pt', 'Fundador'),
  company = JSON_OBJECT(
    'en', 'Cleath Ophthalmology Marketing Consulting',
    'es', 'Cleath Assessoria de Marketing Oftalmológico',
    'pt', 'Cleath Assessoria de Marketing Oftamológico'
  )
WHERE id = 8;
