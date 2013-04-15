<?php

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/../src/');

spl_autoload_register(function($class) {
    require_once str_replace('\\', DIRECTORY_SEPARATOR, $class . '.php');
});
