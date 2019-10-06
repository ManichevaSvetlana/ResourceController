<p align="center">
<img src="https://i.ibb.co/vXPcD6F/2019-09-21-17-07-19.png">
</p>

## Features

- Resource Controller (backend) with CRUD actions with access policies -> suitable for user access models and admin access models;
- API for CRUD actions under: 
  1. models without user id (admin access),
  2. models with user id (user & admin access),
  3. models with user model id - access through user id in user model (user & admin access);
- API auth (JWT);  
- SPA: dashboard for admin and user with CRUD actions under models(frontend), login view.

## Technology stack

- Laravel (PHP Framework)
- Vue.js (Javascript Framework)

- Spatie Laravel Permissions
- JWT Auth
- VUEX ORM (core + axios plugin)
- Ant Design Vue

## Installation

~~~~ 
git clone https://github.com/ManichevaSvetlana/ResourceController.git 
k	
~~~~

Inside the application folder:

~~~~ 
composer install	
~~~~

Duplicate ".env.example" file from the root directory with the new name ".env". 
Replace lines with database information with real data.
Then run:

~~~~ 
php artisan key:generate
~~~~
~~~~ 
php artisan migrate	--seed
~~~~
~~~~ 
npm install
~~~~
~~~~ 
npm run dev
~~~~
~~~~ 
php artisan run 
~~~~

Open http://127.0.0.1:8000/login in your browser. You should see login view:

<p align="center">
<img src="https://i.ibb.co/KWJQKRq/2019-09-21-17-36-31.png">
</p>

Credentials for user:
email - `user@test.test`
password - `password`

Credentials for admin user:
email - `admin@test.test`
password - `password`

Dashboard view:
<p align="center">
<img src="https://i.ibb.co/vXPcD6F/2019-09-21-17-07-19.png">
</p>

You can delete and update records.

## TODO

- Add middleware for frontend
- Add AdminModel to Admin dashboard
- Add "Create a new model" button do dashboard
