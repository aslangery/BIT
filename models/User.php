<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 22:17
 */

namespace Models;

use DB;

class User
{
    protected static $table='users';

    public $id=0;

    public $username='guest';

    public $email='';

    public $password='';


    /**
     * @param string $key
     * @param string $value
     * @return User|object|\stdClass
     */
    static public function get($key='', $value='')
    {
        if ($key!=='' && $value!=='')
        {
            $query="SELECT * FROM users WHERE ".$key."='".$value."'";
            $user=DB::query($query);
            return $user->fetch_object('Models\User');
        }
        else
        {
            return new User();
        }
    }
}