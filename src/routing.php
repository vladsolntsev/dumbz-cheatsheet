<?php
/**
 * This file dispatch routes.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routeParts = explode('/', ltrim($_SERVER['REQUEST_URI'], '/') ?: HOME_PAGE);
$controller = 'App\Controller\\' . ucfirst($routeParts[0] ?? '') . 'Controller';
$method = $routeParts[1] ?? '';
$vars = array_slice($routeParts, 2);
/*
$cutmethod = explode('?',$method);
$method = $cutmethod[0] === '' ? HOME_PAGE : $cutmethod[0];
var_dump($method);die;
*/

if (class_exists($controller) && method_exists(new $controller(), $method)) {
    echo call_user_func_array([new $controller(), $method], $vars);

} else {
    header("HTTP/1.0 404 Not Found");
    echo '404 - Page not found';
    exit();
}
