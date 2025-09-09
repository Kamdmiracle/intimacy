# Installation Guide (cPanel)

1. **Create MySQL Database**
   - cPanel > MySQL Database Wizard
   - Create DB, user, grant ALL PRIVILEGES.

2. **Upload Files**
   - cPanel File Manager or FTP.
   - Place this folder under `public_html/` (e.g., `public_html/intimacy/`).

3. **Configure App**
   - Edit `config/config.php`
     - DB_HOST, DB_NAME, DB_USER, DB_PASS
     - BASE_URL (e.g., `/intimacy/`)
     - FORCE_HTTPS true if SSL enabled.

4. **Create Tables & Seed Data**
   - cPanel > phpMyAdmin
   - Import `scripts/sql/schema.sql`
   - Import `scripts/sql/seed.sql`

5. **Permissions**
   - Ensure `storage/` and `storage/uploads/` are writable (755 or 775).

6. **Cron (optional)**
   - cPanel > Cron Jobs
   - Command: `php /home/USERNAME/public_html/intimacy/scripts/reminders_cron.php` daily.

7. **Login & Use**
   - Visit `https://yourdomain.com/intimacy/`
   - Register new users.