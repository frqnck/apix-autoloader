<?php

/**
 *
 * This file is part of the Apix Project.
 *
 * (c) Franck Cassedanne <franck at ouarz.net>
 *
 * @license     http://opensource.org/licenses/BSD-3-Clause  New BSD License
 *
 */

namespace Apix;

define('UNIT_TEST', true);

define('APP_TOPDIR', realpath(__DIR__ . '/../php'));
define('APP_TESTDIR', realpath(__DIR__));

require APP_TOPDIR . '/Apix/Autoloader.php';

Autoloader::init(
    array(APP_TOPDIR, APP_TESTDIR)
);
