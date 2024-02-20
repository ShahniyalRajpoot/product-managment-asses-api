step-1 
clone the both projects (front end and backend apis) from github i have invited mahtab.ali@alquranclasses.com

Setep-2 
run (composer update) commmand on both project

step-3
change database name in .env file to (product-managment) and create db on your local host or any other serve you want   note: rename the .env file if its .env.example

this modification only for apis project 

Step-4
run command on apis project first (php artisan migrate:refresh --seed) i have created a seeder for test user with its dummy product after run this command 

then again run command php artisan serve and leave it    Note: maybe you need to run the command (php artisan generate:key) before artisan serve 

step-5 
goto the front end project and run command (php artisan serve --port=5000) now you got the login page Try with this email to login (test@example.com) password: 12345


Step-6 
Now you will be able to perform crud operation on products of the logged user, You can also create a new user if you want

Thank you 
Muhammad Shahniyal 
gmail: zeshansunny76@gmail.com