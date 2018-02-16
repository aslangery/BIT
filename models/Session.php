<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 16.02.2018
 * Time: 18:34
 */

namespace Models;

use DB;

class Session
{
    protected $table = 'sessions';

    public $user_id = 0;

    public $session_id = '';

    public function get($session_id='')
    {
        if ($session_id!=='')
        {
            $query="SELECT user_id, session_id FROM ".$this->table." WHERE session_id='".$session_id."'";
            if($result=DB::query($query))
            {
                return $result->fetch_object('\Models\Session');
            }
            else
            {
                return false;
            }
        }
    }

    public function save()
    {
        $query="INSERT INTO ".$this->table." VALUES(".$this->user_id.", '".$this->session_id."')";
        return DB::query($query);
    }


}