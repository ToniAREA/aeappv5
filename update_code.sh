#!/bin/bash
GREEN="\033[0;32m"
RESET="\033[0m"

# Clean screen
clear
# Cambia al directorio del repositorio
cd ~/MEGA/MisWebs/newAEAPPv5/aeappv5

# Run composer install
echo -e "${GREEN}Do you want to run: composer install? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, composer install..."
    # Your command goes here
    composer install
else
    echo "Command skipped."
fi

#Run migrations
echo -e "${GREEN}Do you want to run: php artisan migrate:fresh? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan migrate..."
    # Your command goes here
    php artisan migrate:fresh
else
    echo "Command skipped."
fi

#Run seeders
echo -e "${GREEN}Do you want to run: php artisan db:seed? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan db:seed..."
    # Your command goes here
    php artisan db:seed
else
    echo "Command skipped."
fi

#Run server
echo -e "${GREEN}Do you want to run: php artisan serve? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan serve..."
    # Your command goes here
    php artisan serve
else
    echo "Command skipped."
fi