echo "Starting the Docker containers"
docker-compose build --no-cache
docker-compose up --force-recreate --no-deps -d

#instalar dependecias
rm -Rf ./src/vendor ./src/node_modules ./src/.env
cp ./src/.env.example ./src/.env

docker-compose exec api_gcursos bash -c "composer install --ignore-platform-reqs --no-ansi --no-interaction --no-progress"

docker-compose exec app api_gcursos -c "chmod 777 -Rf ./storage/"
docker-compose exec api_gcursos bash -c "php artisan migrate"
docker-compose exec api_gcursos bash -c "php artisan db:seed"
