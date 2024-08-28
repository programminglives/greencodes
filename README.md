## Greencodes Technical Test

Initialized with readme

### Setup Instructions

- Clone the project on your local machine
- Run docker-compose up -d
- Run docker exec `your_container_id` cp .env.example .env
- docker exec `your_container_id` php artisan migrate --seed
- Open http://localhost on your browser

### Requirements
- Docker V27.0.3
