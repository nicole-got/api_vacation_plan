### api_vacation_plan
Vacation Plan Management System for 2024

## Database
Create database mysql witch name "vacation_plan"

## Create the file .env in project root
Use exemple the file .env.example<br>
Update the variables:<br>
    - DB_HOST<br>
    - DB_USERNAME<br>
    - DB_PASSWORD<br>

## Api configuration
    composer install
    php artisan migrate
    php artisan key:generate

## Unit test
    php artisan test

## Start the api
    php artisan serve

## Documentation
    http://localhost:8000/api/documentation#/
