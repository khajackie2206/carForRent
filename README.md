# carForRent
A website for customer to rent a special car with reasonable cost.


## * PHP UNIT

#### + Download:

➜ composer require --dev phpunit/phpunit ^9

➜ ./vendor/bin/phpunit --version
PHPUnit 9.0.0 by Sebastian Bergmann and contributors.

#### + Test:

➜ ./vendor/bin/phpunit tests

## * PHPCBS 
➜  phpcbf --standard=PSR12 ./src

## * PSALM

####  The latest version of Psalm requires PHP >= 7.1 and Composer.

➜ composer require --dev vimeo/psalm

#### Generate a config file:

➜ ./vendor/bin/psalm --init

Psalm will scan your project and figure out an appropriate error level for your codebase.

#### Then run Psalm:

➜ ./vendor/bin/psalm
➜ ./vendor/bin/psalm --show-info=true
