<?php

$fullname     = $_GET['fullname'];
$MobileNumber = $_GET['MobileNumber'];
$price        = $_GET['price'];
$book_id      = $_GET['book_id'];
$email        = $_GET['email'];

function generateRandomString($length = 10) {
	$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}# end -:- generateRandomString
 $post_data = array();
 
 $post_data['store_id']     = "ventu610a60608e480";
 $post_data['store_passwd'] = "ventu610a60608e480@ssl";
 $post_data['total_amount'] = "{$price}";
 $post_data['currency']     = "BDT";
 $post_data['tran_id']      = 'EM-'.generateRandomString();
            $tran_id        = $post_data['tran_id'];
 $post_data['success_url']  = "http://localhost/Travelee/tms/ssl/success.php?tran_id=".$tran_id;
 $post_data['fail_url']     = "http://localhost/Travelee/tms/ssl/fail.php?tran_id=".$tran_id;
 $post_data['cancel_url']   = "http://localhost/Travelee/tms/ssl/cancel.php?tran_id=".$tran_id;
 //$post_data['ipn_url'] = "";
 $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE
 $post_data['emi_option'] = "1"; # EMI INFO
 
 $post_data['cus_name']  = "{$fullname}";
 $post_data['cus_email'] = "dev.samiulh4@gmail.com";
 $post_data['cus_add1']  = "Dhaka";
 //$post_data['cus_add2'] = "Dhaka";
 $post_data['cus_city']     = "Dhaka";
 $post_data['cus_state']    = "Dhaka";
 $post_data['cus_postcode'] = "1207";
 $post_data['cus_country']  = "Bangladesh";
 $post_data['cus_phone']    = "{$MobileNumber}";
//$post_data['cus_fax'] = "";

$post_data['shipping_method'] = "NO";
//$post_data['ship_name'] = "Customer Name";
//$post_data['ship_add1'] = "Dhaka";
//$post_data['ship_add2'] = "Dhaka";
//$post_data['ship_city'] = "Dhaka";
//$post_data['ship_state'] = "Dhaka";
//$post_data['ship_postcode'] = "1000";
//$post_data['ship_country']= "Bangladesh";
 



// $post_data['product_name']     = "ezy-meeting";
// $post_data['product_category'] = "software";
// $post_data['product_profile']  = "non-physical-goods";

$post_data['product_name']     = "Travelee";
$post_data['product_category'] = "Tour-Management";
$post_data['product_profile']  = "non-physical-goods";

//$post_data['hours_till_departure'] = "";
//$post_data['flight_type'] = "";
//$post_data['pnr'] = "";
//$post_data['journey_from_to'] = "";
//$post_data['third_party_booking'] = "";
//$post_data['hotel_name'] = "";
//$post_data['length_of_stay'] = "";
//$post_data['check_in_time'] = "";
//$post_data['hotel_city'] = "";
//$post_data['product_type'] = "";
//$post_data['topup_number'] = "";
//$post_data['country_topup'] = "";
//$post_data['cart'] = "";
//$post_data['vat'] = "";
//$post_data['discount_amount'] = "";
//$post_data['convenience_fee'] = "";

# Customized or Additional Parameters
//$post_data['value_a'] = "ref001_A"; # string (255). Extra parameter to pass your meta data if it is needed. Not mandatory
//$post_data['value_b'] = "ref002_B"; # string (255). Extra parameter to pass your meta data if it is needed. Not mandatory
//$post_data['value_c'] = "ref003_C"; # string (255). Extra parameter to pass your meta data if it is needed. Not mandatory
//$post_data['value_d'] = "ref004_D"; # string (255). Extra parameter to pass your meta data if it is needed. Not mandatory


  



 
 
 



 



    

//echo '<pre>';
//print_r($post_data);
# REQUEST SEND TO SSLCOMMERZ
$direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

$handle = curl_init();

curl_setopt($handle, CURLOPT_URL, $direct_api_url );
curl_setopt($handle, CURLOPT_TIMEOUT, 30);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($handle, CURLOPT_POST, 1 );
curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

$content = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

//echo $code;

if($code == 200 && !(curl_errno($handle))) {
    curl_close($handle);
    $sslcommerzResponse = $content;

	$fullname     = $_GET['fullname'];
	$MobileNumber = $_GET['MobileNumber'];
	$price        = $_GET['price'];
	$book_id      = $_GET['book_id'];
	$email        = $_GET['email'];

	insertPaymentInformationIntoDatabase($tran_id, $sslcommerzResponse, $MobileNumber, $price, $book_id, $email);
	//echo '<pre>';
	//print_r(json_decode($sslcommerzResponse, true));
} else {
    curl_close($handle);
    echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
    die();
}


# PARSE THE JSON RESPONSE
$sslcz = json_decode($sslcommerzResponse, true);
//echo '<pre>';
//print_r($sslcz);






if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
    # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
	# header("Location: ". $sslcz['GatewayPageURL']);
    echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
    die();
} else {
    echo "JSON Data parsing error!";
}


function insertPaymentInformationIntoDatabase($tran_id, $response,  $MobileNumber, $price, $book_id, $email)
{
	# PARSE THE RESPONSE INTO JSON.
	$response_data = json_decode($response, true);
	
	$sessionkey = $response_data['sessionkey'];
	$redirectGatewayURL = $response_data['redirectGatewayURL'];
	parse_str($redirectGatewayURL, $parse_url_data);
	$ssl_id = $parse_url_data['ssl_id'];
	
	# INSERT RESPONSE INTO DATABASE
	date_default_timezone_set("Asia/Dhaka");
	$conn = mysqli_connect('localhost', 'root', '', 'tms');
	mysqli_set_charset($conn,"utf8");
	if (!$conn) {
		die("Database connection failed.");
	}
	$sql = "INSERT INTO sslcommerz_payment_info (tran_id, sessionkey, ssl_id, initiate_response, email, phone, book_id, amount) VALUES ('$tran_id', '$sessionkey', '$ssl_id', '$response', '$email', '$MobileNumber', '$book_id', '$price')";
	if ($conn->query($sql) === TRUE) {
	  //echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  die();
	}
	$conn->close();
	# INSERT RESPONSE INTO DATABASE
}// end -:- insertPaymentInformationIntoDatabase		
?>