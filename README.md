# BULETIN

## Instructions (for XAMPP on Windows)

1. Clone this repository by running:

    ```sh
    git clone https://github.com/Ao-Re/buletin
    ```

2. Move the downloaded folder to `C:/xampp/htdocs`
3. Open the project directory and copy `define.example.php` to `preload/define.php`
4. In `define.php`, change the recaptcha keys into yours

    ```php
    //
    define('RECAPTCHA_SECRET_KEY', 'xxxxx');
    define('RECAPTCHA_SITE_KEY', 'xxxxx');
    //
    ```

5. Still in `define.php`, change the database options accordingly

    ```php
    //
    define('DB_HOST', 'localhost');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'buletin');
    define('DB_USER', 'user');
    //
    ```

6. Open `localhost/phpmyadmin` in your browser.
7. Create a new database called `buletin`.
8. From the ***Import*** tab, import `buletin.sql`. Leave the other options as is.
9. Access the site from `127.0.0.1/buletin` (accessing from `localhost/buletin` won't work).