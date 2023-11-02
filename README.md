## Installation
Access the PHP server and run:
```
$ composer install
$ cp .env.example .env
```

## Migrations
Go to the folder called `routes` and run:
```
$ php ../configuration.php 
```

```
Query [0] executed in 0.028375 ms
Query [1] executed in 0.022754 ms
Query [2] executed in 0.023745 ms
Query [3] executed in 0.023922 ms
Query [4] executed in 0.046516 ms
Query [5] executed in 0.046761 ms
Query [6] executed in -0.933017 ms
Query [7] executed in 0.056102 ms
Query [0] executed in 0.01223 ms
...
```

If you have already run the migrations before, the tables are probably already created and the "migrations" table too,
making it impossible to execute the command again as a security measure. If you need, for any reason, to run again
migrations, you will need to delete all tables, otherwise you will receive a message like:

```
Fatal error: Uncaught Exception: This script has already been executed, check your database. in /var/www/html/app/configuration.php:12
Stack trace:
#0 {main}
  thrown in /var/www/html/app/configuration.php on line 12
```

## Enjoy
If you are using Docker left as a template, you will be able to access your application through:

- **Application** -> http://localhost:8080/app/public
- **Database** -> http://localhost:3305 (example using PHPMyAdmin)

## Static analyzer
```
$ vendor/bin/phpstan analyse -l 0 core/

43/43 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
[OK] No errors
```

You can still configure the PHP Stan execution level, follow the link:
https://phpstan.org/user-guide/rule-levels

## Technologies and Libraries
- [Bootstrap] - https://getbootstrap.com
- [PHP] - https://www.php.net
- [NPM] - https://www.npmjs.com
- [Composer] - https://getcomposer.org
- [PHP Stan] - https://phpstan.org
