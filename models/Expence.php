<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 23:20
 */

namespace Models;

class Expence extends Model
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
        parent::__construct();
    	$this->user_id=$user_id;
        $this->cost=$cost;
        $this->payment_date=date('Y-n-d H:i:s');
    }

    /**
     * @return boolean
     */
    public function save()
    {
        $query='INSERT INTO '.$this->table.' VALUES(:id, :cost, :payment)';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindParam(':id', $this->user_id,\PDO::PARAM_INT);
	    $this->statement->bindParam(':cost', $this->cost);
	    $this->statement->bindParam(':payment', $this->payment_date);
	    $result=$this->statement->execute();
	    unset($this->statement);
	    return $result;
    }
}