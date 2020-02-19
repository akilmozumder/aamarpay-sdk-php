<?php
$currency = $_POST['currency'];
$store_id = ""; //provided by aamarpay
$signature_key = ""; //provided by aamarPay
$tran_id = $_POST['tran_id'];
$amount = $_POST['amount'];
$cus_name = $_POST['cus_name'];
$cus_email = $_POST['cus_email'];
$cus_add1 = $_POST['cus_add1'];
$cus_add2 = $_POST['cus_add2'];
$cus_city = $_POST['cus_city'];
$cus_state = $_POST['cus_state'];
$cus_postcode = $_POST['cus_postcode'];
$cus_country = $_POST['cus_country'];
$cus_phone = $_POST['cus_phone'];
$cus_fax = $_POST['cus_fax'];
$desc = $_POST['desc'];
$success_url = $_POST['success_url'];
$fail_url = $_POST['fail_url'];
$cancel_url = $_POST['cancel_url'];


$data = array(
    'currency' => $currency,
    'store_id' => $store_id,
    'app_id' => '', //provided by aamarpay
    'signature_key' => $signature_key,
    'cus_name' => $cus_name,
    'cus_email' => $cus_email,
    'cus_phone' => $cus_phone,
    'amount' => $amount,
    'tran_id' => $tran_id,
    'desc' => $desc,
    'success_url' => 'http://localhost/aamarpay/success.php',
    'fail_url' => 'http://localhost/aamarpay/fail.php'


);
# Create a connection
$url = 'https://sandbox.aamarpay.com/sdk/index.php';
$ch = curl_init($url);
# Form data string
$postString = http_build_query($data, '', '&');
# Setting our options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
# Get the response
$response = curl_exec($ch);
curl_close($ch);

// echo "<pre>";
// print_r($response);
// echo "</pre>";

$data=(array) json_decode($response);
$track=$data['track']; 
$store_id = $data['storeinfo']->storeid;

$length=sizeof($data['cards']); //check array length
$i=0;
$length;

  
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>Merchant Name: </td>
            <td><?php echo $store_id;?></td>
        </tr>
    </table>
    <table>
        <tr>
            <th>card_type</th>
            <th>sdk_text</th>
            <th>img_medium</th>
            <th>url</th>
        </tr>
        <?php while($i < $length){ ?> 
        <tr>
                <td><?php echo $data['cards'][$i]->card_type; ?></td>
                <td><?php echo $data['cards'][$i]->sdk_text; ?></td>
                <td><img src="<?php echo $data['cards'][$i]->img_medium;?>" alt="default.jpg"></td>
                <td><a href="<?php echo $data['cards'][$i]->url; ?>">Pay now</a></td>
        </tr>
        <?php $i++; } ?>

    </table>
</body>
</html>