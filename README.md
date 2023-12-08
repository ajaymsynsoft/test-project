# Product Data Importer with User Interface

## Description

Develop a Laravel application to fetch and display products from DummyJSON.com API (https://dummyjson.com/products).

## Requirements

- PHP (>= 8.x)
- Composer
- Node.js and npm
- MySQL or any other database system
- Web server (e.g., Apache, Nginx)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/your-laravel-project.git

2. **Navigate to the project directory:**   
cd your-laravel-project

3. **Install PHP dependencies:**   
composer install

4. **Install JavaScript dependencies:**   
npm install

5. **Copy the .env file:**   
cp .env.example .env

6. **Generate application key:**   
php artisan key:generate

7. **Run database migrations:**   
php artisan migrate

8. **Compile assets:**   
npm run dev

9. **Serve the application:**   
php artisan serve
Visit http://127.0.0.1:8000 in your browser.

10. **Run database migrations:**   
php artisan migrate

11. **Configure the Task Scheduler:**   
Laravel's task scheduler needs to be configured to run periodically. You can do this by adding the following cron entry to your server:
* * * * * cd /path-to-your-laravel-project && php artisan schedule:run >> /dev/null 2>&1

12. **Test the Scheduler:**   
Finally, test your scheduler by running the following command in your terminal:
php artisan schedule:run

This command will manually run any due scheduled tasks. You should see the output of your fetch product command if the scheduler is set up correctly.

Usage
Explain how to use or run the project. Include any additional details or steps that are important for developers or users.

Additional Configuration
If there are additional configuration steps required, document them here.

Contributing
If you'd like to contribute to this project, please follow the Contributing Guidelines.

License
This project is licensed under the MIT License.