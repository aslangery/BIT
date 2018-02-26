<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 19:36
 */
session_start();
session_write_close();

spl_autoload_register(function ($class) {
    $path=str_replace('\\','/', $class);
    include $path.'.php';
});
$app=new App();

$app->run();

echo $app->response();


