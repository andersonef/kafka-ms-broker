docker-compose up -d
echo 'Preparing to install...'
sleep 3
docker-compose exec kafka-ms-broker php scripts/install.php
