# _Shoe Store Database_

#### _This program keeps track of record of shoe stores and the brands they carry._

#### By _**Sean Peterson**_


## Description

_Shor Store Database allows a user to see all of the shoe stores in the database and which brands are carried by each store. Also the user can see which stores carry individual brands._

## Setup/Installation Requirements

* In terminal run the following commands:

1. _Fork and clone this repository onto your desktop from_ [gitHub](https://github.com/Sean-Peterson/shoes).
2. Open chrome and enter localhost:8888/phpmyadmin
3. Click on Import, Choose File, desktop/library-project/shoes.sql.zip
4. Ensure [composer](https://getcomposer.org/) is installed on your computer.
5. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
6. To run tests enter `composer test` in terminal.
7. Change the localhost number in the app.php page on line 14 to whichever port number your sql server is set to in your MAMP preferences.
8. Create a local server in the /web folder within the project folder using the command: `php -S localhost:8000` (assuming you are using macOS - commands are different on other operating systems).
9. Open the directory http://localhost:8000/ in any standard web browser.
10. Make sure MAMP is started and change the MySQL number in the src files to your computer's sql port number.

## Specifications

1. Homepage prompts users to select a store and the user is take to the store's page that display's their brands.

2. The user clicks on a brand and is taken to the brand page where the page lists out which stores carry that brand.

3. The user clicks on a store that carries that brand and is take to the store's page.

4. The user can add a brand from the database to the store's brand list.

5. The user can add a brand new brand to the database and to that store's list.

6. The user can alter the name of the store from it's original name to a new name.

7. The user can delete the store and it's store_brand pair in the database.


## Known Bugs

_None so far._

## Support and contact details

_Please contact seanpeterson11@gmail.com with concerns or comments._

## Technologies Used

* _HTML_
* _CSS_
* _PHP_
* _PHPUnit_
* _Composer_
* _Silex_
* _Twig_
* _MySQL_

### License

*MIT license*

Copyright (c) 2017 **_Sean Peterson_**


* Query Commands:
_create database shoes;
use database shoes
create table stores (store_name VARCHAR(255), id serial PRIMARY KEY);
create table brands (brand_name VARCHAR(255), id serial PRIMARY KEY);
create table stores_brands (store_id int, brand_id int, id serial PRIMARY KEY);_
