## 🤫 Chismecito 

A tiny project for **echar el chismecito**. Simply create your account and start to write some juicy **chismes**

## 🧑🏻‍💻 Running the project
Be sure to have installed a laravel environment before.
After cloning the project simply run the next commands. 

```shell
%% Create your DB
> php artisan migrate

%% Seed data to generate some chismes
> php artisan db:seed

%% Run it!
> php artisan serve
```

## 🛠️ About the project
- This project follows a simple monolithic architecture which contains a SSR web and a REST API.
- You can find the Swagger API documentation in **/api/documentation**
- The codebase architecture use an standar composition as Laravel stablishes adding a *man in the middle*  layer named **Contexts** to interact with the models. Something inspired from Elixir Contexts
- By default Sqlite is configured as DB and the .env has been ommitted from the .gitignore in order to run a fast setup
- This project is based on the requirements established in [Koltin Challenge](https://github.com/Koltin-Dev/php-laravel-challenge) and well implement all the features