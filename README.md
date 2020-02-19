# Acquia EPE API client

A library that allows access to the Acquia EPE API.

## Table of contents

* [Pre-requisites](#pre-reqs)
* [Installation](#install)
* [Usage](#usage)

## Prerequisites<a name="pre-reqs"></a>

You will need the following to develop:

- PHP 7.1
- [Composer](https://getcomposer.org)

## Installation<a name="install"></a>

Acquia EPE API client can be included via [Composer](https://getcomposer.org):

```json
{
    "require": {
        "stmixnovich/epe-api-client": "dev-master"
    },
    "repositories": [
        {
            "type": "git",
            "url": "git@github.com:stmixnovich/epe-api-client.git"
        }
    ]
}
```

## Usage<a name="usage"></a>

Basic client usage using OAuth2 Client Credentials flow for authentication:

```php
<?php

use Acquia\Epe\Api\Client\Oauth2ClientFactory;

$client_id = 'abcd1234-0d18-42d5-a13e-6635f67aca32';
$secret    = '1ABCDeAT0P$3CR3TaglizkUBCQaiZp5+K2wcH+2SZ6wqCr3a=';
$client    = Oauth2ClientFactory::createUsingClientCredentials($client_id, $secret);

// Retrieve the applications that you have access to.
$applications = $client->getPing();
```

## Additional information
