#!/bin/sh

echo "Doctrine update database"
php app/console doctrine:database:drop --force -e=dev
rm web/uploads/images/* --force
php app/console doctrine:database:create -e=dev
php app/console doctrine:schema:create -e=dev

echo "Loading all the data about geonames..."
echo "php app/console geonames:load:countries"
php app/console geonames:load:countries
echo "php app/console geonames:load:timezones"
php app/console geonames:load:timezones
echo "php app/console geonames:load:localities of Andorra for faster loading"
php app/console geonames:load:localities AD
echo "Geonames data loaded successfully!"

php app/console doctrine:fixtures:load -e=dev --no-interaction --append
