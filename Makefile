CONTAINER_NAME=sample-api
PORT=8000
DOCKER_EXEC=docker exec -it ${CONTAINER_NAME}

.PHONY: install

install: update migrate serve

build-image-php:
	- docker build --network=host -t php-localy:1.0.0 .

update: stack-up
	- ${DOCKER_EXEC} composer update

serve: stack-up
	- ${DOCKER_EXEC} php -S localhost:${PORT} -t public

test: stack-up
	- ${DOCKER_EXEC} php vendor/bin/phpunit --coverage-html report
	- sensible-browser ${PWD}/sample-api/report/index.html

queue-work: stack-up
	- ${DOCKER_EXEC} php artisan queue:listen

queue-retry: stack-up
	- ${DOCKER_EXEC} php artisan queue:retry all

migrate: stack-up
	- ${DOCKER_EXEC} composer dump-autoload
	- ${DOCKER_EXEC} php artisan migrate:fresh --seed

stack-up:
	- docker-compose up -d

stack-restart:
	- docker-compose restart

stack-stop:
	- docker-compose stop