<?php

session_start();

function get($route, $controller, $method)
{
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        route($route, $controller, $method);
    }
}

function post($route, $controller, $method)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        route($route, $controller, $method);
    }
}

function put($route, $controller, $method)
{
    if ($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        route($route, $controller, $method);
    }
}

function patch($route, $controller, $method)
{
    if ($_SERVER['REQUEST_METHOD'] == 'PATCH')
    {
        route($route, $controller, $method);
    }
}

function delete($route, $controller, $method)
{
    if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        route($route, $controller, $method);
    }
}

function any($route, $controller, $method)
{
    route($route, $controller, $method);
}

function route($route, $controller, $method)
{
    $location = CONTROLLER_DIR."/$controller.php";
    if (!file_exists($location))
    {
        return;
    }
    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?');
    $request_url_parts = explode('/', $request_url);
    $route_parts = explode('/', $route);
    /**
     * when this project will be in root directory, array_slice 'start' will be 1
     * of array_slice($request_url_parts, 2, count($request_url_parts))
    */
    $request_url_parts = array_slice($request_url_parts, 2, count($request_url_parts));
    $route_parts = array_slice($route_parts, 1, count($route_parts));
    $parameters = [];
    if ($route_parts[0] == '' && count($request_url_parts) == 0)
    {
        run($controller, $location, $method, $parameters);
    }
    if (count($request_url_parts) != count($route_parts))
    {
        return;
    }
    for ($_i = 0; $_i < count($route_parts); $_i ++)
    {
        $route_part = $route_parts[$_i];
        if (preg_match('/^[$]/', $route_part))
        {
            $route_part = ltrim($route_part, '$');
            array_push($parameters, $request_url_parts[$_i]);
            $route_part = $request_url_parts[$_i];
        } 
        elseif ($route_parts[$_i] != $request_url_parts[$_i])
        {
            return;
        }
    }
    run($controller, $location, $method, $parameters);
    return;
}

function run($controller, $location, $method, $parameters)
{
    require_once($location);
    $namespace = "Core\\Controllers\\".$controller;
    $reflection = new ReflectionClass($namespace);
    if ($reflection->hasMethod($method))
    {
        $arguments = $reflection->getMethod($method)->getParameters();
        if (count($arguments) == count($parameters))
        {
            $controller_class = new $namespace;
            call_user_func_array(array($controller_class, $method), $parameters);
            $GLOBALS['undefined_route'] = false;
            exit;
        }        
    }
    return;
}

function set_csrf()
{
    if (!isset($_SESSION['csrf']))
    {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    echo '<input type="hidden" name="csrf" value="'.$_SESSION['csrf'].'">';
}

function is_csrf_valid()
{
    if (!isset($_SESSION['csrf']) || !isset($_POST['csrf']))
    {
        return false;
    }
    if ($_SESSION['csrf'] != $_POST['csrf'])
    {
        return false;
    }
    return true;
}
