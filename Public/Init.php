<?php
require sprintf('%s/../vendor/autoload.php', __DIR__);

define('BASE_DIR', sprintf('%s/../', __DIR__));
define('STAGING', (!getenv('STAGING') ? 'production': 'development'));
const DEV = (STAGING === 'development');

if (PHP_SAPI === 'cli') {
	return;
}

ob_start();

require './Routing.php';
