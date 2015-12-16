<?php
/**
 * index.php
 *
 * @category SPA
 * @author Андрей Новиков <andrey@novikov.be>
 * @data 07/12/2015
 *
 */
namespace Application;

/**
 * Шаблонизатор
 * @param $pattern
 * @param array $options
 * @return string
 */

$config = require('../config.php') || new \stdClass();

function get($pattern, array $options = array())
{
    global $config;
    $path = $config->view . $pattern;
    extract($options); ob_start(); @require($path);
    return ob_get_clean();
}

/**
 * Если нет getallheaders()
 * @param $params
 * @return array
 */
function __getAllHeaders($params)
{
    $headers = array();
    foreach ($_SERVER as $name => $value)
        if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH'))
            $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
    return $headers;
}

$route =  $config->route(array_filter(explode("/", substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),1))));
$header = (function_exists('getallheaders')) ? getallheaders() : __getAllHeaders($_SERVER);
$params = array();
switch ($_SERVER['REQUEST_METHOD'])
{
    case 'PUT':
    case 'POST':
        parse_str(file_get_contents('php://input'), $params);
        $pattern = $config->pattern($name = key($params));
        break;
    case 'GET':
    case 'DELETE':
    default:
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
        $pattern = $config->pattern(current($route));
}
if ($pattern) echo get($pattern, array(
    'params' => $params,
    'header' => $header,
    'route' => $route,
    'config' => $config,
    'json' => function (array $params){
        echo json_encode($params);
        exit(1);
    }));
exit(1);
?>