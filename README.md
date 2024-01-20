#AEAPP, Area Electronica

## Next steps to achieve:

1- Feed of clients, boats, marinas & wlist & wlogs. DONE
2-
3-
4-
5-

## Steps from QuickAdminPanel MODIFICATION...

1- MODIFY on QAP, menus or CRUDS

2- PUSH to GitHub via QAP.

3- MERGE on GitHub account to MASTER branch.

4- PULL branch MASTER in local machine. 
    Asegurar que estamos en CUSTOM con `git checkout custom`.
    Primero hacer commit en CUSTOM, con `git add .` seguido de `git commit -m "Mensaje"` para guardar cualquier cambio. 
    Después hacer MERGE desde MASTER a CUSTOM con `git merge master`. Reparar conflictos si hay.

5- In local, `composer install`

6- In local, `php artisan migrate:fresh --seed`

7- In local, `php artisan key:generate`, only first time

8- In local, `php artisan storage:link`, only first time

9- 

## From VScode MODIFICATION - MERGE from CUSTOM to PRODUCTION

1- Hacer commit en CUSTOM, con `git add .` seguido de `git commit -m "Mensaje"`

2- Cambiar a rama PRODUCTION `git checkout production`

3- Comprobar que no hay cambios en PRODUCTION con `git pull`

4- Realizar el MERGE con la rama CUSTOM con `git merge custom`

5- Empujar cambios a PRODUCTION con `git push`

6- Volver a rama CUSTOM con `git checkout custom`

##  Ahora ir a CLOUDWAYS to pull repo and...

## To serve the page:
> php artisan serve