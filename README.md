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
Query [0] executed in 0.04138 ms
Query [1] executed in 0.032468 ms
Query [2] executed in 0.033158 ms
Query [3] executed in 0.042618 ms
Query [4] executed in 0.034529 ms
Query [5] executed in 0.033079 ms
...
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
