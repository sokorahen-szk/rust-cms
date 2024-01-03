migrate:
	docker exec -i apache php artisan migrate:refresh --force
	docker exec -i apache php artisan db:seed

test:
	docker exec -i apache ./vendor/bin/pest -v

docker-build:
	docker-compose -f ./docker-compose.yml \
		--env-file ./rust-cms-infra/.local-env up

docker-destroy:
	docker-compose  -f ./docker-compose.yml \
		--env-file ./rust-cms-infra/.local-env down --rmi all -v \
		&& docker volume prune --force

npm-build:
	cd ./src && npm run dev
