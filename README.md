
## QuickStart

1. Clone The Repository
2. Go to the folder application using `cd` command on your cmd or terminal
3. Open terminal and Run `composer install`
4. Copy `.env.example` file to `.env` on the root folder. You can type `copy .env.example .env` on Windows or `cp .env.example .env` on linux/Mac
5. Create A MySQL Database
6. Open your .env file and change the database name (`DB_DATABASE`) to whatever you have, username (`DB_USERNAME`) and password (`DB_PASSWORD`) field correspond to your configuration.

    > By default, the username is **root** and you can leave the password field empty. **(This is for Xampp)**

    > By default, the username is **root** and password is also **root**. **(This is for Lamp)**

7. Open terminal and Run `php artisan key:generate`
8. Run `php artisan migrate --seed`
9. Run `php artisan serve`
