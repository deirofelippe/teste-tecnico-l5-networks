server:
	@php -S 0.0.0.0:3000 /home/php/app/src/index.php

test:
	@ENV=test phpunit --colors tests/integration/

test-cov:
	@XDEBUG_MODE=coverage phpunit \
		--coverage-filter ./src/services \
		--coverage-clover ./clover.xml \
		--coverage-html cover/ \
		./tests/integration/
	@coverage-check ./clover.xml 80 --only-percentage

test-cov-ci:
	@XDEBUG_MODE=coverage ENV=ci ./vendor/bin/phpunit \
		--coverage-filter ./src/services \
		--coverage-clover ./clover.xml \
		./tests/integration/
	@./vendor/bin/coverage-check ./clover.xml 80 --only-percentage

exec:
	@docker container exec -it app bash

exec-root:
	@docker container exec -it -u root app bash

ci-cd:
	@gh extension exec act --job ci

cs-fix:
	@php-cs-fixer fix --config .php-cs-fixer.dist.php src/
	@php-cs-fixer fix --config .php-cs-fixer.dist.php tests/

docker-test-cov:
	@docker container exec -it app bash -c "make test-cov"