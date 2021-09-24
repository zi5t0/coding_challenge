# Fashionette Coding Challenge

----------

# Getting started

## Requirements
- Docker
- PHP >= 7.4
  - php-xml
  - php-mbstring
  - php-cli
- Composer 2
## Installation


These installation instructions are for building the project with [Docker](#docker), you can also install it by yourself using LAMP, XAMPP or MAMP. 

Clone the repository

    git clone https://github.com/zi5t0/fashionette_coding_challenge.git
    
Switch to the repo

    cd fashionette_coding_challenge
    
Install all the dependencies using composer

    composer install
    

Copy the example env file (already preconfigure) in the .env file

    cp .env.example .env

Configuring the DB:

    docker-compose exec mysql mysql -uroot
    CREATE USER 'sail'@'%' IDENTIFIED BY 'password';
    CREATE DATABASE fashionette_challenge;
    GRANT ALL PRIVILEGES ON *.* TO 'sail'@'%';
    FLUSH PRIVILEGES
    QUIT;

Run the database migrations

    php artisan migrate
    
Finally, get the server up

    ./vendor/bin/sail up
    

# Future improvements and changes
- Disengage the repository from the Eloquent implementation
- Use faker generator for test data
- Use a cache system like REDIS
- Improves search by allowing the movie to contain the word to be searched and not have to be exactly the same
- Improve some tests by using dependency injection
- More tests controlling more scenarios.
- Make API DOC
- Save external ID Film API MAZE, execute call to UPDATES periodically and update films
- Make a request queuing system so as not to crash the TVMaze API (RabbitMQ)
