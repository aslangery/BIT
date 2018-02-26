<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 23:41
 */

namespace Controllers;

use Models\User;
use Models\Session;

class UserController
{
    /**
     * @param $app
     * @return bool
     */
    public function login($app)
    {
        if ($app->request['post']['username']!==null){
            $user=User::get('username',$app->request['post']['username']);
            if (md5($app->request['post']['password'])==$user->password)
            {
            	session_start();
	            if(session_regenerate_id())
	            {
		            session_write_close();
	            	$session             = new Session();
		            $session->user_id    = $user->id;
		            $session->session_id = session_id();
		            if ($session->save())
		            {
			            $host = $_SERVER['HTTP_HOST'];
			            header('Location: http://' . $host . '/index.php?view=account&task=expence.listing');
		            }
	            }
            }
        }
        return false;
    }

    /**
     * @param $app
     */
    public function logout($app)
    {
        if($app->session->delete())
        {
            //unset($app->session);
            $host  = $_SERVER['HTTP_HOST'];
            session_destroy();
            header('Location: http://'.$host.'/');
        }
    }
}