<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    $paystatus=$_POST['pay_status'];
    $amount=$_POST['amount'];
    echo $amount;
    echo $paystatus;
    //you can get all parameter from post request
	echo "<pre>";
    print_r($_POST);
	echo "</pre>";
}
?>