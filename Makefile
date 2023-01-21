docker-build:
	docker-compose -f ./infra/docker-compose.yml \
		--env-file ./infra/.local-env up

docker-destroy:
	docker-compose  -f ./infra/docker-compose.yml \
		--env-file ./infra/.local-env down --rmi all -v \
		&& docker volume prune --force