<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 23:41
 */

namespace Controllers;

use Models\User;
class UserController
{
    public function authorise($request)
    {
        if (isset($request['username'])){
            $user=User::get('username',$request['username']);
            if (md5($request['password'])==$user->password)
            {
                $query='INSERT INTO sessions(user_id,session_id) VALUES('.$user->id.', '.session_id().')';
                if(DB::query($query))
                {
                    return true;
                }
            }
        }
        return false;
    }
}