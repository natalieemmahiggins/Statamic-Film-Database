# Statamic Film Database

Built with SALT Stack (Statamic, Alpine.js, Livewire and Tailwind Css)

This site holds the 500 top rated films from the TMDB API. 

The api data is saved as film collection entries within Statamic and is editable from the admin. 

The results are displayed in a listing which can be searched, sorted and filtered using Livewire.

The site users (members) are stored in a database, separate to the Statamic /cp users.

The listing page is available to members only, while the home and about pages are visible to the public. 

On protected routes, users are redirected to the relevant login pages where unauthenticated (/cp/auth/login or /members-login)


## Usage

Clone the repo

Create .env (see .env.example)
Configure your local database e.g.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=statamic_film_database
DB_USERNAME=root
DB_PASSWORD=
```

And add your TMDB Bearer as ‘Bearer {bearertoken}’ e.g.
```
TMDB_BEARER='Bearer {bearertoken}'
```

Run the following commands in the terminal
```
composer install
npm install
npm run build
php artisan migrate
php artisan db:seed 
php artisan key:generate
```

Running Laravel Herd open http://statamic-film-database.test/ (or equivalent)
