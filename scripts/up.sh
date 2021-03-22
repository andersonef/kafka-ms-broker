docker-compose up -d
sleep 1
docker-compose exec kafka-ms-broker composer install && composer dump-autoload
echo 'Preparing to install...'
sleep 3
docker-compose exec kafka-ms-broker php scripts/install.php
