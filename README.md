# Remember The Milk API client for PHP

[![Build Status](https://secure.travis-ci.org/bartosz-maciaszek/php-rtm.png)](http://travis-ci.org/bartosz-maciaszek/php-rtm)

## Basic information

This library is created to simplify communication with Remember The Milk API. It provides simple, object-oriented interface for PHP programmers. For list of Remember The Milk API methods see [here](https://www.rememberthemilk.com/services/api/methods/). Each group of methods has its own service class located in `src/Rtm/Service/` directory.

## Installation

The easiest way to use php-rtm library is to add it as requirement do your composer.json file:

```
"bartosz-maciaszek/php-rtm": "dev-master"
```

Alternatively, you can clone this repo manually:

```
git clone git://github.com/bartosz-maciaszek/php-rtm.git
```

## Basic usage

To call any method from API you simply need to create `Rtm` class instance and service object and then push some basic information like your API key and secret.

```php
<?php

use Rtm\Rtm;

$rtm = new Rtm;
$rtm->setApiKey('your api key');
$rtm->setSecret('your secret');
$rtm->setAuthToken('your auth token from RTM');

$taskService = $rtm->getService(Rtm::SERVICE_TASKS);
$taskList = $taskService->getList();
```

Response from API is wrapped in handy class "Rtm\DataContainer" which gives you ability to make method chains like `$response->getUser()->getName()` as it supports recurrency. To review its code and unit tests see `src/Rtm/DataContainer.php` and `tests/RtmTest/DataContainerTest.php`. You can easily convert this object into an array or json string by invoking `toArray()` or `toJson()` method, respectively.

Before you can call any API methods, you also need to acquire auth token. To do that, user has to authorize your app. See `sample-app/rtm.php` file for details, it is explained step by step.

## Unit tests

All unit tests are located in `tests/` directory. You can run them all by invoking command `phpunit` in main directory (where `phpunit.xml` is located) or individually, by invoking `phpunit tests/path/to/test/class`, eg. `phpunit tests/RtmTest/RtmTest.php`.

## Sample application

Sample application that uses this library is available in `sample-app/` directory.
