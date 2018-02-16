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
    public function login($request)
    {
        if ($request['post']['username']!==null){
            $user=User::get('username',$request['post']['username']);
            if (md5($request['post']['password'])==$user->password)
            {
                $session=new Session();
                $session->user_id=$user->id;
                $session->session_id=session_id();
                if($session->save())
                {
                    header('Location: index.php?view=account&task=expence.listing');
                }
            }
        }
        return false;
    }
}