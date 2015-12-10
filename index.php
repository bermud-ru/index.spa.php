<?php
/**
 * index.php
 *
 * @category SPA
 * @author Андрей Новиков <bermud@nm.ru>
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
function get($pattern, array $options = array()){
    $path = '../view/'.$pattern;
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
    foreach ($_SERVER as $name => $value) {
        if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
            $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
}

$route = array_filter(explode("/", substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),1)));
$header = (function_exists('getallheaders')) ? getallheaders() : __getAllHeaders($_SERVER);
$params = array();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'PUT':
    case 'POST':
        parse_str(file_get_contents('php://input'), $params);
        $pattern = (($name = key($params)) ? $name . ".phtml" : "index.phtml");
        break;
    case 'GET':
    case 'DELETE':
    default:
        parse_str(parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY), $params);
        $pattern = (($name = end($route)) ? $name . ".phtml" : "index.phtml");
}
echo get($pattern, array('params'=> $params, 'header' => $header, 'route'=> $route));
exit(1);
?>