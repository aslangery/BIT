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
        $args = array(
                'name'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
                'e-mail'=>FILTER_VALIDATE_EMAIL,
            );
            $get=filter_input_array(INPUT_GET,$args,TRUE);
            $post=filter_input_array(INPUT_POST,$args,TRUE);
            $cookie=filter_input_array(INPUT_COOKIE,$args,TRUE);
        $this->request=array_merge($get,$post,$cookie);
        $this->view=$this->getView('main');
    }
    public static function getView($name='', $var='')
    {
        ob_start();
        $file='views/'.$name.'.php';
        if (file_exists($file)){
            include($file);
            $view=ob_get_contents();
            ob_end_clean();
            return $view;
        }
        ob_end_clean();
        return false;
    }
    public function render($view='')
    {
        $this->view=preg_replace('/\{\{content\}\}/', $view, $this->view);
    }

    public function response()
    {
        return $this->view;
    }
    public function authorise()
    {
        if($_SESSION['user_id']==0)
        {
            $usercontroller=new \Controllers\UserController();
            if($usercontroller->authorise($this->request))
            {
                $_SESSION['user_id']=$this->request['user_id'];
                return true;
            }
        }
        if ((int)$_SESSION['user_id']!==0)
        {
            return true;
        }
        return false;
    }

}