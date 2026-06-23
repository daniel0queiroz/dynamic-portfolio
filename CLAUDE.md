# Deployment

This project deploys via FTP and does **not** run `php artisan migrate` in production. See `docs/DEPLOYMENT.md`.

**Whenever you create or edit a file in `database/migrations/`, you must also:**

1. Create a matching raw SQL file in `docs/db-fixes/`, named `YYYY-MM-DD_short_description.sql`. It must contain the equivalent `ALTER TABLE` / `CREATE TABLE` statements, followed by an `INSERT INTO migrations (...)` to register the migration so Laravel doesn't try to re-run it. Match the style of existing files in that folder (e.g. `docs/db-fixes/2026-06-18_lead_forms.sql`).
2. Add a line for that file under "One-off DB fixes" in `docs/DEPLOYMENT.md`.

Do this in the same turn the migration is written — don't wait to be asked. If a migration is purely additive/no schema change relevant to phpMyAdmin (rare), say so explicitly instead of silently skipping the file.
