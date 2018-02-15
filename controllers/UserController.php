<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 23:41
 */

namespace Controllers;

use Models\User;
use DB;

class UserController
{
    public function authorise($request)
    {
        if (isset($request['username'])){
            $user=User::get('username',$request['username']);
            if (md5($request['password'])==$user->password)
            {
                $_SESSION['user_id']=$user->id;
                return true;
            }
        }
        return false;
    }
}