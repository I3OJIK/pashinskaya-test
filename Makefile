env:
	cp .env.example .env
build:
	docker compose build
install:
	docker compose exec php composer install -o
up:
	docker compose up -d
down:
	docker compose down --remove-orphans
migrate:
	docker compose exec php php artisan migrate:fresh --seed
frontend:
	npm install
	npm run dev
setup:
	$(MAKE) env;
	$(MAKE) build;
	$(MAKE) up;
	$(MAKE) install;
	$(MAKE) migrate;
	$(MAKE) frontend;
	@echo "Setup complete"