install:
	composer install --ignore-platform-reqs

.PHONY: tests
tests:
	./vendor/bin/phpunit

complexity:
	./vendor/bin/phpmetrics src/
