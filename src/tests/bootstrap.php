<?php
namespace Apix;

define('UNIT_TEST', true);

define('APP_TOPDIR', realpath(__DIR__ . '/../php'));
define('APP_TESTDIR', realpath(__DIR__));

require APP_TOPDIR . '/Apix/Autoloader.php';

Autoloader::init(
    array(APP_TOPDIR, APP_TESTDIR)
);