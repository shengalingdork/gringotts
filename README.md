
# Gringotts

Inspired from the wizarding world's bank, Gringotts is an app that acts as your vault to store records of monthly transactions and loans.

### Features

- Manage categories and scheme groups
- Monitor progress of schemes and loans
- Alert on unbalanced transaction

## Tech Stack

- PHP 7.4.13
- Composer 2.0.8
- MySQL 5.7.32

## Installation

```bash
  git clone https://github.com/shengalingdork/gringotts/
  cd gringotts
  composer install
  npm install
  cp .env.example .env
  // create new schema and update db details
  php artisan key:generate
  php artisan migrate:fresh
  php artisan db:seed
```

## Run Locally

Start the server

```bash
  php artisan serve
```
