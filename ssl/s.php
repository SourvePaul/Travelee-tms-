<?php
//$sessionkey=urlencode($_POST['sessionkey']);
//$store_id=urlencode("testbox");
//$store_passwd=urlencode("qwerty");


$sessionkey = urlencode("BA28B54788B2D3C46228AF94D5190782");
$store_id = urlencode("ventu610a60608e480");
$store_passwd = urlencode("ventu610a60608e480@ssl");


$requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?sessionkey=".$sessionkey."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");

$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

$result = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($code == 200 && !( curl_errno($handle)))
{

	# TO CONVERT AS ARRAY
	$result = json_decode($result, true);
	# $status = $result['status'];

	# TO CONVERT AS OBJECT
	//$result = json_decode($result);

	# TRANSACTION INFO
	//$status = $result->status;
	//$tran_date = $result->tran_date;
	//$tran_id = $result->tran_id;
	//$val_id = $result->val_id;
	//$amount = $result->amount;
	//$store_amount = $result->store_amount;
	//$bank_tran_id = $result->bank_tran_id;
	//$card_type = $result->card_type;

	# EMI INFO
	//$emi_instalment = $result->emi_instalment;
	//$emi_amount = $result->emi_amount;
	//$emi_description = $result->emi_description;
	//$emi_issuer = $result->emi_issuer;

	# ISSUER INFO
	//$card_no = $result->card_no;
	//$card_issuer = $result->card_issuer;
	//$card_brand = $result->card_brand;
	//$card_issuer_country = $result->card_issuer_country;
	//$card_issuer_country_code = $result->card_issuer_country_code;

	# API AUTHENTICATION
	//$APIConnect = $result->APIConnect;
	//$validated_on = $result->validated_on;
	//$gw_version = $result->gw_version;

    echo "<pre>";
    print_r($result);

} else {

	echo "Failed to connect with SSLCOMMERZ";
}



?>