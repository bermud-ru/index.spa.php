<?php
return (object) array(
    'view' => '../view/',
    'route' => function($params) use($config){
        return $params;
    },
    'pattern'=> function($param,  $value = 'index.phtml') use ($config) {
       return ($param) ? $param . '.phtml' : $value;
    }
);
?>