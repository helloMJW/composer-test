<?php
require dirname(__DIR__) . '/vendor/autoload.php';
$mypack = new mypack\myclass\mypackclass();

echo $mypack->hellopack() . "\n";