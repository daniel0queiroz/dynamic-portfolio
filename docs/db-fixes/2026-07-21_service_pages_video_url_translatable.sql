-- Make service_pages.video_url translatable (per-language video links).
-- Run once in phpMyAdmin if migrations are not executed in CI/CD.

UPDATE `service_pages`
SET `video_url` = CASE
    WHEN `video_url` IS NULL OR `video_url` = '' THEN NULL
    ELSE JSON_OBJECT('en', `video_url`)
END;

ALTER TABLE `service_pages`
  MODIFY COLUMN `video_url` JSON NULL;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
  ('2026_07_21_000000_convert_video_url_to_translatable_in_service_pages_table', 99);
