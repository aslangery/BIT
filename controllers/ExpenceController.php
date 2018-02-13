<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 14.02.2018
 * Time: 0:48
 */

namespace Controllers;


class ExpenceController
{
    public function pay($cost=0,$user_id)
    {
        if ($cost!==0)
        {
            $query='INSERT INTO expences VALUES('.$user_id.', '.$cost.', NOW())';
            if (DB::query($query))
            {
                $query='UPDATE billing SET amount=amount-'.$cost.' WHERE user_id='.(int)$user_id;
                if (DB::query($query))
                {
                    return true;
                }
            }
        }
        return false;
    }
}