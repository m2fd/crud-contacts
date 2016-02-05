# crud-contacts


A Symfony project created on January 15, 2016, 2:13 pm.


## Drop && create de la base de donnée
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create

php bin/console doctrine:schema:update --force

## Generate Getters/setters
php bin/console doctrine:generate:entities AppBundle:Country
php bin/console doctrine:generate:entities AppBundle:Region
php bin/console doctrine:generate:entities AppBundle:City
php bin/console doctrine:generate:entities AppBundle:Personne
php bin/console doctrine:generate:entities AppBundle


## Generate controllers
php bin/console generate:doctrine:crud --overwrite --with-write  --format=annotation --entity=AppBundle:Country
php bin/console generate:doctrine:crud --overwrite --with-write  --format=annotation --entity=AppBundle:Region
php bin/console generate:doctrine:crud --overwrite --with-write  --format=annotation --entity=AppBundle:City
php bin/console generate:doctrine:crud --overwrite --with-write  --format=annotation --entity=AppBundle:Personne
php bin/console generate:doctrine:crud --overwrite --with-write  --format=annotation --entity=AppBundle:Firm


##start server
php bin/console server:run


##Install

npm install --global gulp
npm install --save-dev gulp

npm install gulp-if
npm install gulp-uglify
npm install gulp-uglifycss
npm install gulp-less
npm install gulp-concat
npm install gulp-sourcemaps
