docker-compose build
docker-compose up -d
docker exec -it api_gcursos /bin/bash

#instalar lumen
#composer create-project laravel/lumen .
# php -r "echo password_hash(uniqid(), PASSWORD_BCRYPT).\"\n\";"