# Dependencies
install:
	composer install

# Tests
.PHONY: tests
tests:
	./vendor/bin/phpunit

# Complexity
complexity:
	./vendor/bin/phpmetrics src/
