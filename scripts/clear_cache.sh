echo "Dont use this in production, its dangerous"
php app/console cache:clear -e=dev
sudo chmod -R 777 /dev/shm/symfony/cache
sudo chmod -R 777 /dev/shm/symfony/logs/