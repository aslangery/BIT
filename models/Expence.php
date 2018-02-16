<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 23:20
 */

namespace Models;

use DB;

class Expence
{
    protected $table='expences';

    public $user_id=0;

    public $cost=0;

    public $payment_date;

    /**
     * Expence constructor.
     * @param int $user_id
     * @param double $cost
     */
    public function __construct($user_id=0, $cost=0)
    {
        $this->user_id=$user_id;
        $this->cost=$cost;
        $this->payment_date=date('Y-n-d H:i:s');
    }

    /**
     * @return boolean
     */
    public function save()
    {
        $query="INSERT INTO ".$this->table." VALUES(".$this->user_id.", '".$this->cost."', '".$this->payment_date."')";
        return DB::query($query);
    }
}