docker-compose build
docker-compose up -d
docker exec ARENA-nginx cp .env.example .env
docker exec ARENA-nginx composer install
docker exec ARENA-nginx npm install
docker exec ARENA-nginx php artisan migrate
