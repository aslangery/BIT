<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 23:01
 */

namespace Models;

use DB;

class Billing
{
    protected $table='billing';

    public $user_id='';

    public $amount=0;

    /**
     * Billing constructor.
     * @param int $user_id
     */
    public function __construct($user_id)
    {
        $query='SELECT user_id, amount FROM '.$this->table.' WHERE user_id='.(int)$user_id;
        $result=DB::query($query);
        $array=$result->fetch_array();
        $this->user_id=$user_id;
        $this->amount=$array['amount'];
    }

    /**
     * @return boolean
     */
    public function save()
    {
        $query='UPDATE '.$this->table.' SET amount='.$this->amount.' WHERE user_id='.(int)$this->user_id;
        return DB::query($query);
    }

    /**
     * @return array
     */
    public function getExpences()
    {
        $query="SELECT * FROM expences WHERE user_id=".$this->user_id;
        if($result=DB::query($query))
        {
            foreach ($result as $row)
            {
                $expences[]=$row;
            }
        }
        return $expences;
    }
}