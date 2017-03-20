<?php
/**
 * Part of the Laradic PHP Packages.
 *
 * Copyright (c) 2017. Robin Radic.
 *
 * The license can be found in the package and online at https://laradic.mit-license.org.
 *
 * @copyright Copyright 2017 (c) Robin Radic
 * @license   https://laradic.mit-license.org The MIT License
 */


function run()
{
    $content = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '.curl-output');
    if ($content === false) {
        return 3;
    }
    $content = json_decode($content, true);
    $state   = $content[ 'build' ][ 'state' ];
    if ($state === 'failed' || $state === 'canceled') {
        return 1;
    } elseif ($state === 'passed') {
        return 0;
    } else {
        return 2;
    }
}

echo run();