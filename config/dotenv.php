<?php

/**
 * defined basic information
*/
define('APP_NAME', 'POMB');
define('ROOT_DIR', dirname(dirname(__FILE__)));
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'pomb_db');

/**
 * defined directories for static files
*/
define('CONTROLLER_DIR', ROOT_DIR.'/core/controllers');
define('MODEL_DIR', ROOT_DIR.'/core/models');
define('TRAIT_DIR', ROOT_DIR.'/core/traits');
define('LOG_DIR', ROOT_DIR.'/public/logs');
define('VIEW_DIR', ROOT_DIR.'/templates/views');

/**
 * defined directories for assets or media
*/
$http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
/**
 * when this project will be in root directory
 * no need to concate '/php_oop_mvc_boilerplate' with 'DOMAIN'
*/
define('DOMAIN', $http.'://'.$_SERVER['SERVER_NAME'].'/php_oop_mvc_boilerplate');
define('ASSET_DIR', DOMAIN.'/public/assets');
define('RESOURCE_DIR', DOMAIN.'/public/resources');
