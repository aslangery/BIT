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
var_dump($app);
if ($app->authorise())
{
    $view=$app->request['view'];

}
else
{
    $app->render($app->getView('login'));
}
echo $app->response();
session_write_close();


