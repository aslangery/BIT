<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 27.02.2018
 * Time: 22:31
 */

namespace Models;

class Model
{
	protected $pdo=null;

	protected $statement=null;

	public function __construct()
	{
		$this->pdo=new \PDO(DSN,USER,PASS);
	}
}