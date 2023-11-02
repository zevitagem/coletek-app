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

Se você já tiver executado as migrations antes, provavelmente as tabelas já estão criadas e a tabela "migrations" também,
impossibilitando então de executar novamente o comando como medida de segurança. Se precisar, por algum motivo, executar novamente
as migrations, você precisará excluir todas as tabelas, caso contrário, irá receber uma mensagem tipo:

```
Fatal error: Uncaught Exception: This script has already been executed, check your database. in /var/www/html/app/configuration.php:12
Stack trace:
#0 {main}
  thrown in /var/www/html/app/configuration.php on line 12
```

## Enjoy
Open your browser: http://localhost:8080/app/public

## Observations
An unforeseen event occurred as informed via WhatsApp and I will not be able, due to force majeure, to complete step 2.3.
(remembering that any questions about the lines implemented so far or the solution that would be implemented at this point, I am entirely available for clarification).

However, so that you can visualize the whole idea of how the inclusion of a request component in an external API would be done, I wrote the following classes:

- https://github.com/zevitagem/evolke-test/blob/main/core/requesters/HttpRequester.php
- https://github.com/zevitagem/evolke-test/blob/main/core/adapters/request/GuzzleRequestAdapter.php

Thus, the entire communication approach would be implemented in the external API.

Follow the link to generate a token and view how it works: http://localhost:8080/app/routes/process.php?action=token

## Static analyzer
```
$ vendor/bin/phpstan analyse core/

43/43 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
[OK] No errors
```

## Technologies and Libraries
- [Bootstrap] - https://getbootstrap.com
- [PHP] - https://www.php.net
- [NPM] - https://www.npmjs.com
- [Composer] - https://getcomposer.org
- [PHP Stan] - https://phpstan.org
