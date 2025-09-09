# Couples Intimacy Building App

A PHP/MySQL web app you can deploy on standard cPanel hosting.

## Quick Start
1. Create a new MySQL database on cPanel.
2. Upload all files to a subfolder (e.g., `intimacy/`) or your document root.
3. Edit `config/config.php` to set DB credentials and BASE_URL (if using subfolder).
4. In phpMyAdmin, run `scripts/sql/schema.sql`, then `scripts/sql/seed.sql`.
5. Visit the app in your browser to register and log in.
6. (Optional) Create an admin user by updating their `role` to `admin` in the `users` table.

## Features
- Monthly Reviews with separate answers and history
- 120+ Date Ideas with filters
- Conversation Prompts across 6 categories + Weekly random
- Photo uploads with storage optimization
- Reminders for anniversaries, birthdays, milestones, holidays
- Personal Notes (private or shared) + priority flags
- Admin seed importer

## Security
- Password hashing with `password_hash`
- CSRF tokens on forms
- Prepared statements via PDO
- Basic CSP header and upload validation
- HTTPS redirect toggle

## Cron (optional)
- Set a daily cron for `php /home/USER/public_html/intimacy/scripts/reminders_cron.php`
  to email upcoming reminders.

## Customization
- Update look/feel in `app/Views` (Bootstrap 5 loaded from CDN).
- Extend models/controllers under `app/`.

## Notes
- For SMS, integrate a provider (e.g., Twilio) within `scripts/reminders_cron.php`.
- For advanced photo editing, integrate a JS library (e.g., Cropper.js) on `photos/index.php`.
- Consider enabling SMTP (PHPMailer) if `mail()` is blocked by your host.