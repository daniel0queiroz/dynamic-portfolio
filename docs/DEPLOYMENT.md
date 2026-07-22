# Deployment Notes

This project is deployed via FTP and does not run Laravel migrations in CI/CD.

## One-off DB fixes

Run these scripts manually in phpMyAdmin when deploying corresponding code changes:

1. `docs/db-fixes/2026-03-16_blogs_json.sql`
   - Converts `blogs.title` and `blogs.description` to JSON and wraps existing values.
2. `docs/db-fixes/2026-06-23_service_pages_section_toggles.sql`
   - Adds `lead_form_enabled` and `faq_enabled` columns to `service_pages`.
3. `docs/db-fixes/2026-07-21_service_pages_video_url_translatable.sql`
   - Converts `service_pages.video_url` to JSON so it can hold a separate link per language (EN/ES/PT).
4. `docs/db-fixes/2026-07-22_whatsapp_settings.sql`
   - Creates `whatsapp_settings` (floating WhatsApp button toggle, phone number, per-language pre-filled message) and seeds its single row. Acts as the site-wide/homepage default.
