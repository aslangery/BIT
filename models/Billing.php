<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 23:01
 */

namespace Models;

use DB;

class Billing extends Model
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
        $query='SELECT user_id, amount FROM '.$this->table.' WHERE user_id= :id';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindParam('id', $user_id,\PDO::PARAM_INT);
	    if($this->statement->execute())
	    {
		    $result=$this->statement->fetchObject('Models\Billing');
		    unset($this->statement);
		    $this->amount=$result->amount;
		    $this->user_id=$result->user_id;
	    }
	    else
	    {
		    unset($this->statement);
		    return null;
	    }
    }

    /**
     * @return boolean
     */
    public function save()
    {
        $query='UPDATE '.$this->table.' SET amount= :amount WHERE user_id= :id';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindParam('id',$this->user_id,\PDO::PARAM_INT);
	    $this->statement->bindParam('amount',$this->amount);
	    $result=$this->statement->execute();
	    unset($this->statement);
	    return $result;
    }

    /**
     * @return array
     */
    public function getExpences()
    {
        $query='SELECT * FROM expences WHERE user_id=:id';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindParam('id',$this->user_id,\PDO::PARAM_INT);
	    if($this->statement->execute())
	    {
		    $result=$this->statement->fetchAll(\PDO::FETCH_CLASS,'Models\Expension');
		    unset($this->statement);
		    return $result;
	    }
	    else
	    {
		    unset($this->statement);
		    return null;
	    }
    }
}