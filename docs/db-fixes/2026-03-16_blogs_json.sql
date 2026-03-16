-- Convert blogs title/description to JSON translatable format.
-- Run once in phpMyAdmin if migrations are not executed in CI/CD.

UPDATE `blogs`
SET `title` = CASE
    WHEN `title` IS NULL OR `title` = '' THEN '{"en":""}'
    WHEN JSON_VALID(`title`) THEN `title`
    ELSE JSON_OBJECT('en', `title`)
END,
`description` = CASE
    WHEN `description` IS NULL OR `description` = '' THEN '{"en":""}'
    WHEN JSON_VALID(`description`) THEN `description`
    ELSE JSON_OBJECT('en', `description`)
END;

ALTER TABLE `blogs`
  MODIFY COLUMN `title` JSON NULL,
  MODIFY COLUMN `description` JSON NULL;
