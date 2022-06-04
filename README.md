# 🥇About the project
**The car for rent project**  is a website for customer to rent a special car with reasonable cost.

# 🎉 Getting started
## Setup Environment

- Follow this article to install Nginx in Ubuntu
  20.04: [Click here](https://www.digitalocean.com/community/tutorials/how-to-install-nginx-on-ubuntu-20-04)
- Create an account to use the S3 service in AWS.

### PHPUNIT
```bash
composer require --dev phpunit/phpunit ^9

./vendor/bin/phpunit --version
PHPUnit 9.0.0 by Sebastian Bergmann and contributors.
 ```
## TEST
```bash
 ./vendor/bin/phpunit tests
 XDEBUG_MODE=coverage ./vendor/bin/phpunit tests --coverage-html coverage
```
## PHPCBF 
```bash
phpcbf --standard=PSR12 ./src
```
## PSALM

####  The latest version of Psalm requires PHP >= 7.1 and Composer.
```bash
composer require --dev vimeo/psalm
```
#### Generate a config file:
```bash
./vendor/bin/psalm --init
````
Psalm will scan your project and figure out an appropriate error level for your codebase.
#### Then run Psalm:
```bash
 ./vendor/bin/psalm
 ./vendor/bin/psalm --show-info=true
```
