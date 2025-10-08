# David Test

Here we are with David Test

## Description

📋 To-Do — Gestione Prodotti e Categorie

* Creazione Modello Product con campi `price`, `color` e `category_id`
* Creazione Modello Category con campo `name` (Per generarli puoi utilizzare un piccolo seeder)
* Realizzazione FE (non serve curare lo stile) con lista dei prodotti e filtri dinamici su `color` e `category` (Mi piacerebbe usassi alpine anche in CDN, hai piena autonomia)
* Piccolo form di creazione/aggiornamento prodotto
* Creazione di un paio di test (ce gia installato phpunit, ma puoi usare anche pest)

## Startup

### Start DDEV

```shell
ddev start
```

### Install php dependencies

```shell
ddev composer install
```

### Run database migration

The project uses two database:

* For `local` environment: `db`
* For `testing` environment: `db_test`

Migrations on `db_test` are not required since `RefreshDatabase` trait is used.
See [Resetting The Database After Each Test](https://laravel.com/docs/5.7/database-testing#resetting-the-database-after-each-test)
for more information.

```shell
ddev php artisan migrate
```

### Run seeders

```shell
ddev php artisan db:seed
```

To set up a fresh version of database and run seeders at the same time:

```php
ddev php artisan migrate:fresh --seed
```

## Styles and static analyzers

Run checks prior to commit

```shell
ddev composer test-style
```

Fix style in project with PHP CS Fixer:

```shell
ddev exec ./vendor/bin/php-cs-fixer fix
```

Fix style in project with PHP Code Beautifier and Fixer :

```shell
ddev exec ./vendor/bin/phpcbf
```

To run Php Insights with verbose output:

```shell
ddev exec ./vendor/bin/phpinsights -v
```

## Testing

Run tests with:

```shell
ddev php artisan test
```

or:

```shell
ddev exec ./vendor/bin/phpunit
```

### Local Development

```
https://david-test.ddev.site/coverage
```

### Test

During tests, queues are sync since in  `phpunit.xml` there is:

```xml

<server name="QUEUE_CONNECTION" value="sync"/>
```
