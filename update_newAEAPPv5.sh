#!/bin/bash
GREEN="\033[0;32m"
RESET="\033[0m"

# Clean screen
clear
# Cambia al directorio del repositorio
cd ~/MEGA/MisWebs/newAEAPPv5/aeappv5

# UPDATE repo from QAP merged to MASTER and going to CUSTOM
echo -e "${GREEN}Do you want to UPDATE from already MERGED branch from QuickAdminPanel with MASTER to CUSTOM? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "make sure we're in CUSTOM branch and it's up to date..."
    # Your command goes here
    git checkout custom
    git pull origin custom
    git checkout master
    git pull
    git checkout custom
    git merge master -m "Merged MASTER into CUSTOM branch done by BASH script"
    git push origin custom
else
    echo "Command skipped."
fi

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