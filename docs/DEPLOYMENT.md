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
5. `docs/db-fixes/2026-07-22_service_pages_whatsapp.sql`
   - Adds `whatsapp_enabled`, `whatsapp_number`, `whatsapp_message` columns to `service_pages` so each landing page can override the WhatsApp button with its own number/message per language.
6. `docs/db-fixes/2026-07-24_footer_help_links_sort_order.sql`
   - Adds `sort_order` column to `footer_help_links` for drag-and-drop reordering.
7. `docs/db-fixes/2026-07-24_footer_social_links_sort_order.sql`
   - Adds `sort_order` column to `footer_social_links` for drag-and-drop reordering.
8. `docs/db-fixes/2026-07-24_footer_useful_links_sort_order.sql`
   - Adds `sort_order` column to `footer_useful_links` for drag-and-drop reordering.
9. `docs/db-fixes/2026-07-24_portfolio_items_sort_order.sql`
   - Adds `sort_order` column to `portfolio_items` for drag-and-drop reordering.
10. `docs/db-fixes/2026-07-24_services_sort_order.sql`
    - Adds `sort_order` column to `services` for drag-and-drop reordering.
11. `docs/db-fixes/2026-07-24_skill_items_sort_order.sql`
    - Adds `sort_order` column to `skill_items` for drag-and-drop reordering.
12. `docs/db-fixes/2026-07-24_typer_titles_sort_order.sql`
    - Adds `sort_order` column to `typer_titles` for drag-and-drop reordering.
13. `docs/db-fixes/2026-09-12_feedback_trailing_br.sql`
    - Content fix (not schema): strips a stray trailing `<br>` from the "Brayam Dias" testimonial's Portuguese description that was pushing the closing quote mark onto its own line.
