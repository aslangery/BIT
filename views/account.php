<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 15.02.2018
 * Time: 12:39
 */
?>
<div>
    <span>Текущее состояние: <b><?php echo $vars['amount'];?></b></span>
</div>
<div>
    <form method="post" action="index.php?view=account&task=expence.pay">
    <input type="text" name="cost"/>
    <button type="submit" >Оплатить</button>
    </form>
</div>
<table>
    <?php
    foreach ($vars['expences'] as $expence){    ?>
    <tr>
        <td>-<?php echo $expence['cost'];?></td>
        <td><?php echo $expence['payment_date'];?></td>
    </tr>
    <?php }?>
</table>


