<<<<<<< HEAD
![Guzzle](.github/logo.png?raw=true)

# Guzzle, PHP HTTP client

[![Latest Version](https://img.shields.io/github/release/guzzle/guzzle.svg?style=flat-square)](https://github.com/guzzle/guzzle/releases)
[![Build Status](https://img.shields.io/github/workflow/status/guzzle/guzzle/CI?label=ci%20build&style=flat-square)](https://github.com/guzzle/guzzle/actions?query=workflow%3ACI)
=======
Guzzle, PHP HTTP client
=======================

[![Latest Version](https://img.shields.io/github/release/guzzle/guzzle.svg?style=flat-square)](https://github.com/guzzle/guzzle/releases)
[![Build Status](https://img.shields.io/travis/guzzle/guzzle.svg?style=flat-square)](https://travis-ci.org/guzzle/guzzle)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
[![Total Downloads](https://img.shields.io/packagist/dt/guzzlehttp/guzzle.svg?style=flat-square)](https://packagist.org/packages/guzzlehttp/guzzle)

Guzzle is a PHP HTTP client that makes it easy to send HTTP requests and
trivial to integrate with web services.

- Simple interface for building query strings, POST requests, streaming large
  uploads, streaming large downloads, using HTTP cookies, uploading JSON data,
  etc...
- Can send both synchronous and asynchronous requests using the same interface.
- Uses PSR-7 interfaces for requests, responses, and streams. This allows you
  to utilize other PSR-7 compatible libraries with Guzzle.
<<<<<<< HEAD
- Supports PSR-18 allowing interoperability between other PSR-18 HTTP Clients.
=======
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
- Abstracts away the underlying HTTP transport, allowing you to write
  environment and transport agnostic code; i.e., no hard dependency on cURL,
  PHP streams, sockets, or non-blocking event loops.
- Middleware system allows you to augment and compose client behavior.

```php
$client = new \GuzzleHttp\Client();
$response = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');

<<<<<<< HEAD
echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

// Send an asynchronous request.
=======
echo $response->getStatusCode(); # 200
echo $response->getHeaderLine('content-type'); # 'application/json; charset=utf8'
echo $response->getBody(); # '{"id": 1420053, "name": "guzzle", ...}'

# Send an asynchronous request.
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
$request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
$promise = $client->sendAsync($request)->then(function ($response) {
    echo 'I completed! ' . $response->getBody();
});

$promise->wait();
```

## Help and docs

<<<<<<< HEAD
We use GitHub issues only to discuss bugs and new features. For support please refer to:

- [Documentation](http://guzzlephp.org/)
- [Stack Overflow](http://stackoverflow.com/questions/tagged/guzzle)
- [#guzzle](https://app.slack.com/client/T0D2S9JCT/CE6UAAKL4) channel on [PHP-HTTP Slack](http://slack.httplug.io/)
=======
- [Documentation](http://guzzlephp.org/)
- [Stack Overflow](http://stackoverflow.com/questions/tagged/guzzle)
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
- [Gitter](https://gitter.im/guzzle/guzzle)


## Installing Guzzle

The recommended way to install Guzzle is through
<<<<<<< HEAD
[Composer](https://getcomposer.org/).
=======
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Guzzle:
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

```bash
composer require guzzlehttp/guzzle
```

<<<<<<< HEAD
=======
After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

You can then later update Guzzle using composer:

 ```bash
composer update
 ```

>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                | Docs                | PSR-7 | PHP Version |
|---------|------------|---------------------|--------------|---------------------|---------------------|-------|-------------|
| 3.x     | EOL        | `guzzle/guzzle`     | `Guzzle`     | [v3][guzzle-3-repo] | [v3][guzzle-3-docs] | No    | >= 5.3.3    |
| 4.x     | EOL        | `guzzlehttp/guzzle` | `GuzzleHttp` | [v4][guzzle-4-repo] | N/A                 | No    | >= 5.4      |
| 5.x     | EOL        | `guzzlehttp/guzzle` | `GuzzleHttp` | [v5][guzzle-5-repo] | [v5][guzzle-5-docs] | No    | >= 5.4      |
<<<<<<< HEAD
| 6.x     | Bugfixes   | `guzzlehttp/guzzle` | `GuzzleHttp` | [v6][guzzle-6-repo] | [v6][guzzle-6-docs] | Yes   | >= 5.5      |
| 7.x     | Latest     | `guzzlehttp/guzzle` | `GuzzleHttp` | [v7][guzzle-7-repo] | [v7][guzzle-7-docs] | Yes   | >= 7.2      |
=======
| 6.x     | Latest     | `guzzlehttp/guzzle` | `GuzzleHttp` | [v6][guzzle-6-repo] | [v6][guzzle-6-docs] | Yes   | >= 5.5      |
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1

[guzzle-3-repo]: https://github.com/guzzle/guzzle3
[guzzle-4-repo]: https://github.com/guzzle/guzzle/tree/4.x
[guzzle-5-repo]: https://github.com/guzzle/guzzle/tree/5.3
<<<<<<< HEAD
[guzzle-6-repo]: https://github.com/guzzle/guzzle/tree/6.5
[guzzle-7-repo]: https://github.com/guzzle/guzzle
[guzzle-3-docs]: http://guzzle3.readthedocs.org
[guzzle-5-docs]: http://docs.guzzlephp.org/en/5.3/
[guzzle-6-docs]: http://docs.guzzlephp.org/en/6.5/
[guzzle-7-docs]: http://docs.guzzlephp.org/en/latest/
=======
[guzzle-6-repo]: https://github.com/guzzle/guzzle
[guzzle-3-docs]: http://guzzle3.readthedocs.org
[guzzle-5-docs]: http://guzzle.readthedocs.org/en/5.3/
[guzzle-6-docs]: http://guzzle.readthedocs.org/en/latest/
>>>>>>> 53677bf7ba8144810ee62f4fb8e72e6c6587dfc1
