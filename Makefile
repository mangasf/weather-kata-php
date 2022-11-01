install:
	composer install

.PHONY: tests
tests:
	./vendor/bin/phpunit

complexity:
	./vendor/bin/phpmetrics src/
