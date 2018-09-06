.MINO: agile
agile: clear
	./vendor/bin/phpunit --testdox

.MINO: test
test: clear
	./vendor/bin/phpunit --stop-on-failure

.MINO: clear
clear:
	clear

.MINO: coverage
coverage: clear
	./vendor/bin/phpunit --coverage-html /tmp/report
	open /tmp/report/index.html
