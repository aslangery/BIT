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
        if ($cost!==0)
        {
            $expence=new Expence($billing->user_id,$cost);
            if ($expence->save())
            {
                $billing->amount-=$cost;
                if ($billing->save())
                {
                    header('Location: index.php?view=account&task=expence.listing');
                }
            }
        }
        return false;
    }
    public function listing($app)
    {
        $bill=new Billing($app->session->user_id);
        $result['amount']=$bill->amount;
        $result['expences']=$bill->getExpences();
        return $result;
    }
}