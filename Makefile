setup:
	composer install

run:
	php index.php

test:
	./vendor/bin/phpunit tests