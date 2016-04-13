<?php
    require_once dirname(__FILE__) .'/bootstrap.php';

    if (count($argv) <= 2) {
        exit("php phpTool.php PhpTool\Charset\Convert utf8_esc '天'");
    }

    $class = $argv[1];
    $method = $argv[2];

    if (!class_exists($class)) {
        exit("$argv[1] not found");
    }
    if (!method_exists($class, $method)) {
        exit("$argv[2] not found");
    }

    $param = array_slice($argv, 3);
    echo call_user_func_array(array($class,$method), $param);
