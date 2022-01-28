.PHONY: start
start: erase build up composer-install key-gen db-init

.PHONY: restart
restart: stop up

.PHONY: up
up: ## Start environment
		docker-compose up -d

.PHONY: stop
stop: ## stop environment
		docker-compose stop

.PHONY: erase
erase: stop## Stop and delete containers, clean volumes.
		docker-compose rm -v -f

.PHONY: build
build: ## Build environment and initialize composer and project dependencies
		docker-compose build

.PHONY: composer-install
composer-install: ## Run composer install
		docker-compose exec app sh -lc 'composer install'

.PHONY: key-gen
key-gen: ## Run php artisan key:generate
		docker-compose exec app sh -lc 'php artisan key:generate'

.PHONY: db-reset
db-reset: ## Run migrations
		docker-compose exec app sh -lc 'php artisan migrate:reset'

.PHONY: db-migrate
db-migrate: ## Run migrations
		docker-compose exec app sh -lc 'php artisan migrate'

.PHONY: db-rollback
db-rollback: ## Run rollback migrations
		docker-compose exec app sh -lc 'php artisan migrate:rollback'

.PHONY: db-seed
db-seed: ## Run migrations
		docker-compose exec app sh -lc 'php artisan db:seed'

.PHONY: db-init
db-init: db-reset db-migrate db-seed

.PHONY: phpunit
phpunit: ## execute project unit tests
		docker-compose exec app sh -lc './vendor/bin/phpunit'

.PHONY: app
app: ## Go inside php container
		docker-compose exec app bash
