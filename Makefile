.DEFAULT_GOAL := control

analyse:
	./vendor/bin/phpstan analyse

coverage:
	XDEBUG_MODE=coverage ./vendor/bin/pest --coverage -p --min=80

test:
	./vendor/bin/pest -p

control: analyse test
