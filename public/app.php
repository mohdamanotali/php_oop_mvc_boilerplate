<?php

require_once(dirname(dirname(__FILE__)).'/config/dotenv.php');
require_once(ROOT_DIR.'/config/router.php');
$GLOBALS['undefined_route'] = true;

/**
 * defined 'ROUTE' is to call any route more easily throughout the project
*/
define('ROUTE', [
    '/' => DOMAIN.'/',
    'list' => DOMAIN.'/list',
    'create' => DOMAIN.'/create',
    'update' => DOMAIN.'/update',
    'delete' => DOMAIN.'/delete',
]);

/**
 * defined available routes
 * other than these, it will return undefined route
*/
get('/', 'RankController', 'list');
get('/list', 'RankController', 'list');
post('/create', 'RankController', 'create');
post('/update', 'RankController', 'update');
any('/delete/$id', 'RankController', 'delete');

if ($GLOBALS['undefined_route'])
{
    echo '<h1>undefined route</h1>';
    exit;
}
