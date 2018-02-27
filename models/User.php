<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 22:17
 */

namespace Models;

class User extends Model
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
    public function get($key='', $value='')
    {
        if ($key!=='' && $value!=='')
        {
	        $query           = 'SELECT * FROM users WHERE :key = :value';
	        $this->statement = $this->pdo->prepare($query);
	        $this->statement->bindParam('key', $key, \PDO::PARAM_STR);
	        $this->statement->bindParam('value', $value, \PDO::PARAM_STR);
	        if ($this->statement->execute())
	        {
		        $result = $this->statement->fetchObject('Models\User');
		        unset($this->statement);

		        return $result;
	        }
        }
        else{
        	return $this;
        }
    }
}