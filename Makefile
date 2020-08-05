DOCKER_RUN=docker run --rm --net=host -it -v "${PWD}"/sample-api:/app -w /app php:7.3

build-php-image:
	- docker build --network=host -t php:7.3 -f ./php/Dockerfile ./php

update:
	- ${DOCKER_RUN} composer update

serve: stack-up
	- ${DOCKER_RUN} php -S localhost:8000 -t public

migrate: stack-up
	- composer dump-autoload
	- ${DOCKER_RUN} php artisan migrate:fresh --seed

stack-up:
	- docker-compose up -d

stack-stop:
	- docker-compose stop