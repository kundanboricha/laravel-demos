
Test User
7:41 PM (1 hour ago)
to me

Task	Command
Create a controller	php artisan make:controller MyController
Create a model	php artisan make:model MyModel
Create a model + migration	php artisan make:model MyModel -m
Create a model + migration + factory + seeder + controller	php artisan make:model MyModel -a
Create a migration	php artisan make:migration create_table_name_table
Create a resource controller	php artisan make:controller MyController --resource
Create a request class (validation)	php artisan make:request StoreMyModelRequest
Create a seeder	php artisan make:seeder MySeeder
Create a factory	php artisan make:factory MyModelFactory
Create a middleware	php artisan make:middleware MyMiddleware
Create a policy	php artisan make:policy MyPolicy
Create a command (CLI)	php artisan make:command MyCommand
Create a job	php artisan make:job MyJob
Create an event	php artisan make:event MyEvent
Create a listener	php artisan make:listener MyListener
Create a notification	php artisan make:notification MyNotification
Create a service provider	php artisan make:provider MyServiceProvider







Task	Command
Run all migrations	php artisan migrate
Rollback last migration batch	php artisan migrate:rollback
Refresh DB (rollback & migrate)	php artisan migrate:refresh
Drop all tables & migrate fresh	php artisan migrate:fresh
Seed the database	php artisan db:seed
Run a specific seeder	php artisan db:seed --class=MySeeder





Task	Command
Clear config cache	php artisan config:clear
Clear route cache	php artisan route:clear
Clear view cache	php artisan view:clear
Clear application cache	php artisan cache:clear
Optimize (optional in Laravel 9+)	php artisan optimize




Task	Command
Install Sanctum	composer require laravel/sanctum + publish/migrate
Install Passport	composer require laravel/passport + install/migrate


php artisan make:controller ProductController -r

Use -a with model to auto-create migration, factory, seeder, controller:

bash
CopyEdit
php artisan make:model Product -a