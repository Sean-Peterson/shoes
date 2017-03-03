create database shoes;
use database shoes
create table stores (store_name VARCHAR(255), id serial PRIMARY KEY);
create table brands (brand_name VARCHAR(255), id serial PRIMARY KEY);
create table stores_brands (store_id int, brand_id int, id serial PRIMARY KEY);
