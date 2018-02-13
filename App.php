<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 21:42
 */

class App
{
    protected $view='';

    protected $user=0;

    public $request;

    public function __construct()
    {
        session_start();
        $args = array(
                'name'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
                'e-mail'=>FILTER_VALIDATE_EMAIL,
            );

        $this->request= filter_input_array(INPUT_REQUEST,$args,TRUE);
        $this->view=$this->getView('main');
    }
    public static function getView($name='')
    {
        return file_get_contents('views/'.$name.'.php');
    }

    public function response()
    {
        return $this->view;
    }

}