<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 19:36
 */
session_start();
spl_autoload_register(function ($class) {
    $path=str_replace('\\','/', $class);
    include $path.'.php';
});

$app=new App();
//var_dump($app);
$app->run();

echo $app->response();
session_write_close();


