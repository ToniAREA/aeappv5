#!/bin/bash
GREEN="\033[0;32m"
RESET="\033[0m"

# Clean screen
clear
# Cambia al directorio del repositorio
cd ~/MEGA/MisWebs/newAEAPPv5/aeappv5

# Find all files containing "_copy" in their name, in the current directory and sub-directories
find . -type f -name '*_copy*' | while read src; do
    # Generate the destination filename by replacing "_copy" with ""
    dest="${src/_copy/}"
    
    # Copy the file FROM the destination without "_copy"
    cp "$dest" "$src"
    
    # Print the action
    echo  "Copied: $dest -> $src"
done


# Recupera los cambios más recientes del repositorio remoto
echo -e "${GREEN}Fetching changes from remote repository...${RESET}"
git fetch origin master

# Compara el HEAD local con el HEAD remoto
LOCAL=$(git rev-parse @)
REMOTE=$(git rev-parse @{u})

# Si no son iguales, hay cambios en el repositorio remoto
if [ $LOCAL != $REMOTE ]; then
    echo "Hay cambios en el repositorio remoto, actualizando..."
    git pull
else
    echo "El repositorio local ya está actualizado."
fi

# Copy *copy files to...
echo -e "${GREEN}Do you want to copy *copy files to...? (y/n)${RESET}"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, copy *copy files to..."
    # Your command goes here
    find . -type f -name '*_copy*' | while read src; do
        # Generate the destination filename by replacing "_copy" with ""
        dest="${src/_copy/}"
        
        # Copy the file FROM the destination without "_copy"
        cp "$src" "$dest"
        
        # Print the action
        echo "Copied: $src -> $dest"
    done
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