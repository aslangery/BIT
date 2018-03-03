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
	 * @param \App $app
	 */
	public function pay(\App $app)
    {
        $cost=$app->request->post['cost'];
        $billing=new Billing($app->session->user_id);
	    //Сумма оплаты не может быть меньше 0 и больше баланса
        if ($cost>0 && $cost<=$billing->amount)
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
	 * @param \App $app
	 *
	 * @return mixed
	 */
	public function listing(\App $app)
    {
    	$bill=new Billing($app->session->user_id);
        $result['amount']=$bill->amount;
        $result['expences']=$bill->getExpences();
        return $result;
    }
}