# crud-contacts


A Symfony project created on January 15, 2016, 2:13 pm.


## Drop && create de la base de donnée
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create

php bin/console doctrine:schema:update --force

php app/console generate:doctrine:crud

##start server
php bin/console server:run
