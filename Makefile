server:
	@php -S 0.0.0.0:3000 /home/php/app/src/index.php

test:
	@ENV=test phpunit --colors tests/integration/

test-cov:
	@XDEBUG_MODE=coverage phpunit \
		--coverage-filter ./src/services \
		--coverage-filter ./src/repositories \
		--coverage-clover ./clover.xml \
		--coverage-html cover/ \
		./tests/integration/
	@coverage-check ./clover.xml 70 --only-percentage

exec:
	@docker container exec -it backend bash

exec-root:
	@docker container exec -it -u root backend bash

ci-cd:
	@gh extension exec act --job ci

cs-fix:
	@php-cs-fixer fix --config .php-cs-fixer.dist.php src/