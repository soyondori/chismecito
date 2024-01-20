# 🤫 Chismecito 

A tiny project for **echar el chismecito**. Simply create your account and start to write some juicy **chismes**

## 🧑🏻‍💻 Running the project
Be sure to have installed a laravel environment before.
After cloning the project simply run the next commands. 

```shell
## Create your DB
> php artisan migrate

## Seed data to generate some chismes
> php artisan db:seed

## Run it!
> php artisan serve
```

## 🛠️ About the project
-  This project follows a straightforward monolithic architecture that incorporates a server-side rendered (SSR) web component and a REST API. The Swagger API documentation can be accessed at /api/documentation.

- The codebase architecture adheres to Laravel's standard composition, integrating a 'man in the middle' layer known as Contexts to facilitate interactions with models. This approach draws inspiration from Elixir Contexts.

- By default, SQLite is configured as the database, and the .env file has been intentionally omitted from the .gitignore to streamline the setup process for a quicker deployment.

- This project aligns with the requirements outlined in the [Koltin Challenge](https://github.com/Koltin-Dev/php-laravel-challenge) and effectively implements all the specified features.

