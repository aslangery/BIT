<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 0:48
 */

namespace Controllers;

use Models\Expence;
use Models\Billing;

class ExpenceController
{

    /**
     * @param Billing $billing
     * @param double $cost
     * @return bool
     */
    public function pay($app)
    {
        $cost=$app->request['post']['cost'];
        $billing=new Billing($app->session->user_id);
        if ($cost!=0)
        {
            $expence=new Expence($billing->user_id,$cost);
            if ($expence->save())
            {
                $billing->amount-=$cost;
                $billing->save();
            }
        }
        $host  = $_SERVER['HTTP_HOST'];
        header('Location: http://'.$host.'/index.php?view=account&task=expence.listing');
    }

    /**
     * @param $app
     * @return mixed
     */
    public function listing($app)
    {
        $bill=new Billing($app->session->user_id);
        $result['amount']=$bill->amount;
        $result['expences']=$bill->getExpences();
        return $result;
    }
}