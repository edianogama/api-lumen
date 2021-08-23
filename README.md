# Requerimentos
- [Docker Desktop](https://docs.docker.com/docker-for-mac/install/)
- [NGrok](https://ngrok.com/)

## Forma automática

## Backend
Iniciando o projeto.
```bash
chmod +x ./install.sh && ./install.sh
```

Iniciando ambiente
```bash
docker-compose up
```

Parando o ambiente
```bash
docker-compose down
```
### User Demon
username: flamma
senha: senha22

### Forma manual
## Ativando container
docker-compose up -d

### copiar .env.example para .env
Entrar na pasta src e rodar o composer.
```bash
composer install
```
Ou via Docker
```bash
docker-compose exec api_gcursos bash -c "composer install --ignore-platform-reqs --no-ansi --no-interaction --no-progress"
```

###  Rodar migrate e seeds
php artisan migrate
php artisan db:seed

### Acessar:
- localhost:8080

### favor usar ngrok para expor a porta
Na pasta do arquivo
```bash
./ngrok http 8080
```

Recuperar a url para adicionar no baseURL do flutterAPP