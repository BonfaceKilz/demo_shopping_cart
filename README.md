## Demo Shopping Cart
[![License](https://www.opensource.org/licenses/MIT)](https://www.opensource.org/licenses/MIT)

## Overview

A simple demo shopping cart and checkout implementation in PHP and mysql using no frameworks. This is based off a spec from an interview from Homechow. The spec is:

- List items(5 dummy items from a mysql table)
- Add/ Remove items from the cart
- List elements from the Cart
- Have a checkout page with the Total Price

I have avoided to use JavaScript to load/ remove/ view items to the Cart. Instead, I've opted to use SESSIONS as a quick and dirty way to do CRUD for this demo. The drawback for this is that writing automated tests is a pain.

Also, I've used some modern CSS3 features like `grid` and `css-variables`, so if you are using older or esoteric browsers, the layout may be broken.


## Setup

You need the following installed in your machine/ VM/ Container:

- Composer v1.9.0 or later
- PHP v7.2
- PHP72-mysqli(You need to have this extension enabled)
- Mysql v5.7 or later

Before setting up the project, you need to configure your database credentials properly. There's a `src/.env.example` file in `./src`. Move this file to `./src/.env` (`cd src && cp .env.example .env`). Here's an example of my `src/.env` configuration file:

```
DB_HOST="localhost"
DB_USER_NAME="root"
DB_NAME="democart"
DB_PASSWORD="oOKITJNH"
```

After setting up the database configuration variables, import the database schema in `./database/schemas.sql`. This schema creates the products table, and inserts 5 dummy electronics tables to your table.

After setting up your database, install all the required dependencies by running:

```bash
# Run this at the root of your project
composer install
```

To view the app, you can spin up the server by running:

```bash
sudo php -S localhost:8080
```

Now you can view the demo in your browser on `localhost:8080`

## Tests and Linting

To run the tests, run this from the project's root:

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/
```

This project sticks to PSR12 style guide. To run the linter on the php `src` directory, run this from project's root:

```bash
./vendor/bin/phpcs src/
```
