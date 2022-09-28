<h2>Book Store Test</h2>

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This backend project was developed using Laravel 9. I used Laravel in the backend with Mysql or SQLITE in the database, we can be changed by any other without problems.

	
## Technologies
Project created with:
* Laravel versão: ^8.75
* PHP: ^7.3|^8.0 
	
## Setup
To run this project locally:

```
$ cd ../bookstore-backend
$ composer update
$ touch database/database.sqlite
$ cp .env.example .env
$ sudo nano .env, alter DB_CONECTION... for: 
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_USERNAME=root
#DB_PASSWORD=

$ php artisan key:generate
$ php artisan config:clear
$ php artisan config:cache
$ php artisan migrate
$ php artisan serve



```

## API Endpoints
#### Register User
```http
POST /api/auth/register
```
#### Login
```http
POST /api/auth/login
```
#### Logot
```http
POST /api/auth/logout
```
#### Create Book
```http
POST /api/books
```
#### Show Books
```http
GET /api/books
```
#### Restore Book by ID
```http
POST /api/books/restore/{book_id}
```
#### Delete Book by ID
```http
DELETE /api/books/delete/{book_id}
```
#### Force delete Book by ID
```http
DELETE /api/books/force-delete/{book_id}
```
#### Search
```http
GET /api/books/search/{query}
```

