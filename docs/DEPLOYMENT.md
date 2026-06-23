# Deployment Notes

This project is deployed via FTP and does not run Laravel migrations in CI/CD.

## One-off DB fixes

Run these scripts manually in phpMyAdmin when deploying corresponding code changes:

1. `docs/db-fixes/2026-03-16_blogs_json.sql`
   - Converts `blogs.title` and `blogs.description` to JSON and wraps existing values.
2. `docs/db-fixes/2026-06-23_service_pages_section_toggles.sql`
   - Adds `lead_form_enabled` and `faq_enabled` columns to `service_pages`.
