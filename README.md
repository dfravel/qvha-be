### QVHA Directory Back End

This application is a work in progress. It's ultimate goal is to create a Laravel/VueJS web application for managing the Quashnet Valley Homeowners Association directory. This will include:

-   addresses
-   contacts at the address
-   phone numbers
-   email address
-   preferred communication method
-   secondary/seasonal addresses
-   emergency contact information
-   dues management (each house in the HOA pays $200/year)
-   committee membership (there are 3 neighborhood committees including the Board)

### To Get Started with the Backend:

-   clone this repo
-   Run composer install
-   Run npm install
-   Create your local database
-   Create the .env file `cp .env.example .env`
-   Update the .env file with your local database credentials
-   Generate the application key `php artisan key:generate`
-   Run the database migration: `php artisan migrate`
-   Run the database seed: `php artisan migrate:refresh --seed`
