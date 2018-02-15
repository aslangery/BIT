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
    public function pay(Billing $billing, $cost=0)
    {
        if ($cost!==0)
        {
            $expence=new Expence($billing->user_id,$cost);
            if ($expence->save())
            {
                $billing->amount-=$cost;
                if ($billing->save())
                {
                    return true;
                }
            }
        }
        return false;
    }
}