#PABI MEMBERSHIP

## How to install
1. Clone this repository
2. Run Composer Install
    ```
    composer install
    ```
3. Copy .env.ods to .env and set ods database information
4. Migrate the migrations in ods/utils/migrations
    ```
   php artisan migrate --path=app/ods/utils/migrations
    ```
5. Serve the server
    ```
   php artisan serve
    ```
