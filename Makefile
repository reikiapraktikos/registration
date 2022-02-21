init:
	docker-compose build --force-rm --no-cache
	make up
up:
	docker-compose up -d
	docker exec backend composer install
sh:
	docker exec -it backend sh
