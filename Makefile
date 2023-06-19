COMPOSER_BIN := composer
PHP := php

vendor: composer.json composer.lock
	$(COMPOSER_BIN) install
	touch vendor

var:
	mkdir -p var

update:
	$(COMPOSER_BIN) update
	$(COMPOSER_BIN) bump
	touch vendor
.PHONY: update

check: composer-validate test
.PHONY: check

test: var vendor
	$(PHP) vendor/bin/phpunit
.PHONY: test

composer-validate:
	$(COMPOSER_BIN) validate --strict --no-check-publish
.PHONY: composer-validate