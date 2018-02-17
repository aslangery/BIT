<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 13.02.2018
 * Time: 21:42
 */
use Models\Session;
class App
{
    protected $view='';

    public $username='guest';

    public $request=array();

    public $session;

    public function __construct()
    {
        $args = array(
                'username'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
                'password'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
                'cost'=>FILTER_VALIDATE_FLOAT,
                'e-mail'=>FILTER_VALIDATE_EMAIL,
                'view'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
                'task'    => array('filter'    => FILTER_SANITIZE_STRING,
                    'flags'     => FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH,
                ),
            );
        $this->request['get']=filter_input_array(INPUT_GET,$args,TRUE);
        $this->request['post']=filter_input_array(INPUT_POST,$args,TRUE);
        $this->request['cookie']=filter_input_array(INPUT_COOKIE,$args,TRUE);

        $this->view=$this->getView('main');
    }
    public static function getView($name='', $vars='')
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
    public function render($view='',$position='content')
    {
        $pattern='/\{\{'.$position.'\}\}/';
        $this->view=preg_replace($pattern, $view, $this->view);
    }

    public function response()
    {
        return $this->view;
    }
    public function authorise()
    {
        $session=new Session();
        $this->session=$session->get(session_id());
        if ($this->session->session_id!=='')
        {
            return true;
        }
        return false;
    }
    public function run()
    {
        $vars='';
        if ($this->authorise()) {
            $user= \Models\User::get('id',$this->session->user_id);
            $this->username=$user->username;
            if ($this->request['get']['task'] !== null) {
                $task = $this->request['get']['task'];
                $args = explode('.', $task);
                $cname = '\\Controllers\\' . ucfirst($args[0]) . 'Controller';
                $controller = new $cname;
                $method = $args[1];
                $vars = $controller->$method($this);
                $vars['username']=$this->username;
            }
            if ($this->request['get']['view'] !== null) {
                $view = $this->request['get']['view'];
                $this->render($this->getView($view, $vars));
                $this->render($this->getView('logout',$vars),'auth');
            }
        }
        else
        {
            if($this->request['get']['task']=='user.login')
            {
                $controller=new \Controllers\UserController();
                $controller->login($this);
            }
            $this->render($this->getView('login'),'auth');
        }
    }
}