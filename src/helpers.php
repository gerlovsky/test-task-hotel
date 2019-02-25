<?php

function debug(...$args)
{
    $nl = php_sapi_name() == 'cli' ? "\n" : '<br>';

    echo php_sapi_name() != 'cli' ? '<pre>' : '';
    echo $nl;
    echo print_r($args, true);
    echo $nl;
    echo php_sapi_name() != 'cli' ? '</pre>' : '';
}

function dd(...$args)
{
    debug($args);
    die();
}