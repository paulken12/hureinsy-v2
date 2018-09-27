# hureinsy
Laravel Project

- git clone https://github.com/paulken12/hureinsy.git

- cd to the project directory and run the command


    >composer install 

    >copy .env.example .env 

    >php artisan key:generate

- create database xampp/wamp : database_name - collations : utf8mb4_unicode_ci

- open .env file and modify the database connection


    ```dotenv
    DB_DATABASE=database_name
    DB_USERNAME=root
    DB_PASSWORD=
    ```

- copy the csv files in the google drive and paste to hureinsy>database>seeds>csv


    >php artisan migrate

    >php artisan db:seed --class=DatabaseSeeder

    >npm install

    >npm run dev

- open terminal and cd to the project directory and run the command
    
    
    >php artisan serve

--------------------------------------------------------------

##### Image 

- To fix the broken image 


    >php artisan storage:link
    
    
    
--------------------------------------------------------------

##### Mail 

- For the mailing, create an account in mailtrap.io and update the .env file


    ```dotenv
    MAIL_DRIVER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME= username
    MAIL_PASSWORD= password
    ```
   
    
 - for offline change MAIL_DRIVER smtp to log
    and locate your logs App > Storage > logs > laravel.log
    scroll down, find the mail URI and paste into your browser 
   
    ```dotenv
       MAIL_DRIVER=log
    ```
   
    
    