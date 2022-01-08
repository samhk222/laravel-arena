# Git clone
https://github.com/samhk222/laravel-arena

cd laravel-arena/
docker-compose build && docker-compose up -d
docker exec ARENA-nginx cp .env.example .env
docker exec ARENA-nginx composer install
docker exec ARENA-nginx npm install && npm run prod
docker exec ARENA-nginx migrate


# Copy .env.example to .env
# drun
# /etc/hosts - sudo nano /etc/hosts 
    127.0.0.1 laravel-arena.local
 
# Melhorar
tabela status
