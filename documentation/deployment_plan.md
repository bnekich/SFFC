# Deployment Plan for Safe Families Case Management Application

## Step 1: Verify Hosting Environment Compatibility

- **Objective**: Ensure GoDaddy hosting supports the required stack (PHP 8.2, MariaDB 10.5, Laravel 12).
- **Actions**:
  1. Log in to your GoDaddy cPanel.
  2. Check PHP version:
     - Navigate to “Select PHP Version” or “MultiPHP Manager.”
     - Confirm PHP 8.2 is available and set it as the default for the `public_html` directory.
  3. Check database support:
     - Go to “MySQL Databases” in cPanel.
     - Verify if MariaDB 10.5 (or compatible version) is available. GoDaddy often uses MariaDB as a drop-in replacement for MySQL.
  4. Confirm SSH access:
     - In cPanel, go to “Manage Shell” and enable SSH if not already enabled.
     - Retrieve SSH credentials (host, port, username, password) from cPanel’s “SSH Access” section.
  5. Verify Node.js and Composer availability:
     - Run `node -v` and `composer --version` via SSH to confirm they’re installed. If not, you may need to install them manually or use GoDaddy’s “Setup Node.js App” feature.
- **Notes**:
  - If PHP 8.2 or MariaDB 10.5 isn’t supported, contact GoDaddy support to upgrade your plan or confirm compatibility.
  - Laravel 12 requires PHP 8.2+, so PHP 8.2 is non-negotiable.

## Step 2: Archive the Existing Website

- **Objective**: Safely back up the current site (https://bruce-nekich.net) and its database to prevent data loss.
- **Actions**:
  1. **Backup website files**:
     - Connect to the server via SSH or use cPanel’s “File Manager.”
     - Navigate to the `public_html` directory.
     - Create a compressed archive of the current site:
       ```bash
       tar -czvf bruce-nekich-backup-$(date +%F).tar.gz public_html
       ```
     - Move the archive to a safe location outside `public_html`, e.g., `~/backups/`.
     - Download the archive to your local machine via cPanel’s File Manager or SCP for off-server storage.
  2. **Backup the database**:
     - In cPanel, go to “phpMyAdmin.”
     - Select the database associated with the current site (check `public_html/.env` for the database name).
     - Export the database as an SQL file.
     - Alternatively, use the command line via SSH:
       ```bash
       mysqldump -u [db_username] -p [db_name] > bruce-nekich-db-$(date +%F).sql
       ```
     - Download the SQL file to your local machine.
  3. **Verify backups**:
     - Ensure the tar.gz file contains all `public_html` contents.
     - Check the SQL file for valid database schema and data.
  4. **Optional**: Move the old site to a subdirectory (e.g., `public_html/archive`) to keep it accessible during testing:
     - In SSH:
       ```bash
       mv public_html public_html_archive
       mkdir public_html
       ```
- **Notes**:
  - Store backups securely on your local machine or a cloud service.
  - Do not delete the old site until the new site is fully tested.

## Step 3: Prepare the Development Environment

- **Objective**: Upgrade Laravel and test the application locally before deployment.
- **Actions**:

  1. **Set up the local environment**:
     - Ensure your Windows development machine has PHP 8.2, Composer, Node.js, and MariaDB 10.5 installed.
     - Use Visual Studio Code as your IDE.
     - Install DBeaver 25.03 and configure it to connect to your local MariaDB instance.
  2. **Upgrade Laravel from 11 to 12**:
     - Open your project in Visual Studio Code.
     - Update `composer.json`:
       - Change the Laravel framework dependency to `"laravel/framework": "^12.0"`.
       - Ensure other dependencies (e.g., `spatie/laravel-permission`, `livewire/livewire`) are compatible with Laravel 12 by checking their documentation.
     - Run:
       ```bash
       composer update
       ```
     - Check for breaking changes in Laravel 12 (refer to the [Laravel 12 upgrade guide](https://laravel.com/docs/12.x/upgrade)).
     - Update any deprecated code (e.g., middleware, configuration files) as per the guide.
  3. **Install and configure dependencies**:

     - Install PHP dependencies:
       ```bash
       composer require spatie/laravel-permission livewire/livewire
       ```
     - Install JavaScript dependencies:
       ```bash
       npm install bootstrap@5 jquery select2 vite typescript
       ```
     - Configure Vite for TypeScript:

       - Update `vite.config.js` to include TypeScript support:

         ```javascript
         import { defineConfig } from "vite";
         import laravel from "laravel-vite-plugin";

         export default defineConfig({
           plugins: [
             laravel({
               input: ["resources/css/app.css", "resources/js/app.ts"],
               refresh: true,
             }),
           ],
         });
         ```

       - Rename `resources/js/app.js` to `app.ts` if not already done.

     - Publish Spatie Laravel-Permission assets:
       ```bash
       php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
       ```
     - Publish Livewire assets:
       ```bash
       php artisan livewire:publish --config
       ```

  4. **Set up MariaDB locally**:
     - Create a new MariaDB database using DBeaver or the command line:
       ```bash
       mysql -u root -p
       CREATE DATABASE safe_families_test;
       ```
     - Update `.env` in your project:
       ```
       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=safe_families_test
       DB_USERNAME=[your_username]
       DB_PASSWORD=[your_password]
       ```
     - Run migrations and seeders:
       ```bash
       php artisan migrate --seed
       ```
  5. **Test the application locally**:
     - Start the Laravel development server:
       ```bash
       php artisan serve
       ```
     - Build frontend assets:
       ```bash
       npm run dev
       ```
     - Verify the application works as expected at `http://localhost:8000`.
     - Test key features (e.g., authentication, Spatie permissions, Livewire components, Select2 dropdowns).

- **Notes**:
  - Fix any issues (e.g., deprecated methods, TypeScript errors) before proceeding.
  - Ensure your `.env` file is not committed to version control.

## Step 4: Prepare the Application for Deployment

- **Objective**: Optimize and package the application for GoDaddy’s hosting environment.
- **Actions**:
  1. **Create a test environment configuration**:
     - Copy `.env` to `.env.testing` and update it with test-specific settings (e.g., `APP_ENV=testing`, `APP_DEBUG=true`).
     - Ensure the database name in `.env.testing` is unique (e.g., `safe_families_test`).
  2. **Optimize the application**:
     - Clear caches:
       ```bash
       php artisan config:clear
       php artisan route:clear
       php artisan view:clear
       ```
     - Cache configurations for performance:
       ```bash
       php artisan config:cache
       php artisan route:cache
       ```
     - Build production-ready frontend assets:
       ```bash
       npm run build
       ```
  3. **Prepare the codebase**:
     - Ensure `.gitignore` excludes `.env`, `node_modules`, and `vendor`.
     - Commit all changes to your version control system (e.g., Git).
     - Create a clean export of the project:
       ```bash
       git archive -o safe-families.zip HEAD
       ```
- **Notes**:
  - The `git archive` command creates a zip file without ignored files, making it ideal for deployment.

## Step 5: Deploy the Application to GoDaddy

- **Objective**: Upload and configure the new application in the `public_html` directory.
- **Actions**:
  1. **Upload the application**:
     - Connect to the server via SSH or cPanel’s File Manager.
     - If `public_html` is not empty (e.g., contains the archived site), move existing files to `public_html_archive` (as done in Step 2).
     - Upload the `safe-families.zip` file to `public_html`.
     - Unzip the file:
       ```bash
       unzip safe-families.zip -d public_html
       ```
     - Remove the zip file:
       ```bash
       rm safe-families.zip
       ```
  2. **Install dependencies on the server**:
     - Navigate to `public_html` via SSH:
       ```bash
       cd public_html
       ```
     - Install Composer dependencies:
       ```bash
       composer install --optimize-autoloader --no-dev
       ```
     - Install Node.js dependencies (if Vite assets need rebuilding):
       ```bash
       npm install
       npm run build
       ```
  3. **Configure the environment**:
     - Copy `.env.testing` to `public_html/.env`.
     - Update `.env` with GoDaddy-specific settings (e.g., database credentials, `APP_URL=https://bruce-nekich.net`).
     - Set file permissions:
       ```bash
       chmod -R 755 storage bootstrap/cache
       chown -R [cpanel_username]:[cpanel_username] .
       ```
  4. **Set up MariaDB on the server**:
     - In cPanel, go to “MySQL Databases.”
     - Create a new database (e.g., `[cpanel_username]_safe_families_test`).
     - Create a new database user and assign it to the database with full privileges.
     - Update `.env` with the database credentials:
       ```
       DB_CONNECTION=mysql
       DB_HOST=localhost
       DB_PORT=3306
       DB_DATABASE=[cpanel_username]_safe_families_test
       DB_USERNAME=[db_username]
       DB_PASSWORD=[db_password]
       ```
     - Run migrations on the server:
       ```bash
       php artisan migrate --seed
       ```
  5. **Configure the web server**:
     - Ensure the document root is set to `public_html/public` in cPanel’s “Domains” or “Addon Domains” section.
     - If `.htaccess` is missing in `public_html/public`, create it with Laravel’s default:
       ```
       <IfModule mod_rewrite.c>
           RewriteEngine On
           RewriteBase /
           RewriteRule ^index\.php$ - [L]
           RewriteCond %{REQUEST_FILENAME} !-f
           RewriteCond %{REQUEST_FILENAME} !-d
           RewriteRule . /index.php [L]
       </IfModule>
       ```
- **Notes**:
  - GoDaddy’s shared hosting uses MariaDB by default, so no explicit MySQL-to-MariaDB replacement is needed.
  - If SSH is unavailable, use cPanel’s “Git Version Control” or File Manager for file operations.

## Step 6: Test the Deployed Application

- **Objective**: Verify the test site works as expected.
- **Actions**:
  1. Visit `https://bruce-nekich.net` in a browser.
  2. Test key features:
     - Authentication (login/logout).
     - Spatie Laravel-Permission roles and permissions.
     - Livewire components.
     - Select2 dropdowns and TypeScript-powered features.
  3. Check logs for errors:
     - View `storage/logs/laravel.log` via SSH or File Manager.
  4. Use DBeaver to connect to the server’s MariaDB database (use cPanel’s “Remote MySQL” to allow your IP).
     - Verify database schema and data.
  5. Run Laravel’s built-in tests (if available):
     ```bash
     php artisan test
     ```
- **Notes**:
  - If issues arise, revert to the archived site by restoring `public_html_archive` to `public_html`.
  - Debug errors using `laravel.log` or enable `APP_DEBUG=true` temporarily.

## Step 7: Finalize and Document

- **Objective**: Ensure the test site is stable and document the setup for future reference.
- **Actions**:
  1. **Optimize performance**:
     - Re-run optimization commands:
       ```bash
       php artisan config:cache
       php artisan route:cache
       ```
  2. **Secure the site**:
     - Disable debugging in `.env`:
       ```
       APP_DEBUG=false
       ```
     - Generate a new application key if needed:
       ```bash
       php artisan key:generate
       ```
  3. **Document the setup**:
     - Save this deployment plan.
     - Note GoDaddy-specific configurations (e.g., database credentials, PHP version).
     - Document any manual changes made during deployment.
  4. **Plan for production**:
     - Identify differences between test and production environments (e.g., Ubuntu server).
     - Plan to replicate this process with production-specific settings (e.g., `APP_ENV=production`).
- **Notes**:
  - Keep the archived site and database backups until the test site is fully validated.
  - Consider setting up a subdomain (e.g., `test.bruce-nekich.net`) for future testing to avoid overwriting the main site.

## Rollback Plan

- **Objective**: Revert to the original site if deployment fails.
- **Actions**:
  1. Delete the new `public_html` contents:
     ```bash
     rm -rf public_html/*
     ```
  2. Restore the archived site:
     ```bash
     mv public_html_archive public_html
     ```
  3. Restore the database:
     - In phpMyAdmin, drop the test database.
     - Import the backed-up SQL file.
  4. Verify the restored site at `https://bruce-nekich.net`.
- **Notes**:
  - Test the restored site thoroughly to ensure no data loss.
