<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 16.02.2018
 * Time: 18:34
 */

namespace Models;

class Session extends Model
{
    protected $table = 'sessions';

    public $user_id = 0;

    public $session_id = '';

	/**
     * @param string $session_id
     * @return null|object
     */
    public function get($session_id='')
    {
        if ($session_id!=='')
        {
            $query='SELECT user_id, session_id FROM '.$this->table.' WHERE session_id= :id';
            $this->statement=$this->pdo->prepare($query);
            $this->statement->bindParam('id',$session_id,\PDO::PARAM_STR, 32);
            if($this->statement->execute())
            {
                $result=$this->statement->fetchObject('Models\Session');
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

    /**
     * @return bool
     */
    public function save()
    {
        $query='INSERT INTO '.$this->table.' VALUES( :user, :session)';
	    $this->statement=$this->pdo->prepare($query);
	    $this->statement->bindParam('user',$this->user_id,\PDO::PARAM_INT);
	    $this->statement->bindParam('session',$this->session_id, \PDO::PARAM_STR, 32);
	    $result=$this->statement->execute();
	    unset($this->statement);
	    return $result;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $query='DELETE FROM '.$this->table.' WHERE session_id=:id';
        $this->statement=$this->pdo->prepare($query);
        $this->statement->bindParam('id',$this->session_id, \PDO::PARAM_STR,32);
		$result=$this->statement->execute();
        unset($this->statement);
        return $result;
    }


}