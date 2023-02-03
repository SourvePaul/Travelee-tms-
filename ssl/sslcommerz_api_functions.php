<?php
include '../database_connection.php';
include 'sslcommerz_api_information.php';

date_default_timezone_set('Asia/Dhaka');



function generateRandomString($length = 10)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} //========== end -:- generateRandomString() method ==========//


function sslcommerzPaymentInitiateAPI($connect, $email)
{
    $company_sql = "SELECT id,email,package_id,name FROM companies WHERE email = '$email' LIMIT 1";
    $company_query = mysqli_query($connect, $company_sql);
    $company_data = mysqli_fetch_assoc($company_query);
    if (empty($company_data)) {
        return array(
            'success' => false,
            'error' => true,
            'message' => 'Email Not Exist In Company By ' . $company_data['email'],
        );
    }
    $package_id = $company_data['package_id'];
    $company_name = $company_data['name'];
    $company_id = $company_data['id'];

    $package_sql = "SELECT package_price_bdt FROM package_info WHERE sl = '$package_id' LIMIT 1";
    $package_query = mysqli_query($connect, $package_sql);
    $package_data = mysqli_fetch_assoc($package_query);
    if (empty($package_data)) {
        return array(
            'success' => false,
            'error' => true,
            'message' => 'Package Not Exist In Package Info By ' . $package_id,
        );
    }

    $package_price_bdt = $package_data['package_price_bdt'];

    $user_sql = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
    $user_query = mysqli_query($connect, $user_sql);
    $user_data = mysqli_fetch_assoc($user_query);
    if (empty($user_data)) {
        return array(
            'success' => false,
            'error' => true,
            'message' => 'Email Not Exist In User By ' . $user_data['email'],
        );
    }


    $post_data = array();
    $created_at = date('Y-m-d H:i:s');
    $payment_type = PAYMENT_TYPE;

    $store_id = STORE_ID;
    $store_passwd = STORE_PASSWD;
    $package_price = $package_price_bdt;
    $currency = 'BDT';
    $tran_id = 'EM-' . generateRandomString();

    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $link = "https";
    } else {
        $link = "http";
    }
    // Here append the common URL characters.
    $link .= "://";
    // Append the host(domain name, ip) to the URL.
    $link .= $_SERVER['HTTP_HOST'];
    #$host = $_SERVER['DOCUMENT_ROOT'];
    $host = $link;
    $project_name = 'ezy-meeting';
    $path_url = 'sslcommerz';
    $target_folder = $host . '/'  . $project_name . '/'  . $path_url;

    $success_url = $target_folder . '/' . 'success.php?tran_id=' . $tran_id;
    $fail_url = $target_folder . '/' . 'fail.php?tran_id=' . $tran_id;
    $cancel_url = $target_folder . '/' . 'cancel.php?tran_id=' . $tran_id;



    $cus_name = $company_name;
    $cus_email = $email;
    $cus_add1 = 'Dhaka';
    $cus_add2 = 'Dhaka';
    $cus_city = 'Dhaka';
    $cus_state = 'Dhaka';
    $cus_postcode = '1000';
    $cus_country = 'Bangladesh';
    $cus_phone = '01905199337';
    $cus_fax = '';


    $post_data['store_id'] = $store_id;
    $post_data['store_passwd'] = $store_passwd;
    $post_data['total_amount'] = $package_price;
    $post_data['currency'] = $currency;
    $post_data['tran_id'] = $tran_id;
    $post_data['success_url'] = $success_url;
    $post_data['fail_url'] =  $fail_url;
    $post_data['cancel_url'] = $cancel_url;
    //$post_data['ipn_url'] = "";
    $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE
    # CUSTOMER INFORMATION
    $post_data['cus_name'] = $cus_name;
    $post_data['cus_email'] = $cus_email;
    $post_data['cus_add1'] = $cus_add1;
    $post_data['cus_add2'] = $cus_add2;
    $post_data['cus_city'] = $cus_city;
    $post_data['cus_state'] = $cus_state;
    $post_data['cus_postcode'] = $cus_postcode;
    $post_data['cus_country'] = $cus_country;
    $post_data['cus_phone'] = $cus_phone;
    $post_data['cus_fax'] = $cus_fax;
    # SHIPMENT INFORMATION
    $post_data['shipping_method'] = "NO";
    //$post_data['ship_name'] = "Store Test";
    //$post_data['ship_add1 '] = "Dhaka";
    //$post_data['ship_add2'] = "Dhaka";
    //$post_data['ship_city'] = "Dhaka";
    //$post_data['ship_state'] = "Dhaka";
    //$post_data['ship_postcode'] = "1000";
    //$post_data['ship_country'] = "Bangladesh";
    # OPTIONAL PARAMETERS
    //$post_data['value_a'] = "ref001";
    //$post_data['value_b '] = "ref002";
    //$post_data['value_c'] = "ref003";
    //$post_data['value_d'] = "ref004";
    # EMI STATUS
    $post_data['emi_option'] = "1";
    # Product Information
    $post_data['product_name'] = "ezy-meeting";
    $post_data['product_category'] = "software";
    $post_data['product_profile'] = "non-physical-goods";
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


    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v4/api.php";

    $handle = curl_init();

    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC

    $response = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {
        curl_close($handle);
        //$sslcommerzresponse = $response;
    } else {
        curl_close($handle);
        return array(
            'success' => false,
            'error' => true,
            'message' => 'FAILED TO CONNECT WITH SSLCOMMERZ API',
        );
    }

    // Convert To Array
    $sslcommerz_response = json_decode($response, true);

    $sessionkey = $sslcommerz_response['sessionkey'];
    $redirectGatewayURL = $sslcommerz_response['redirectGatewayURL'];
    parse_str($redirectGatewayURL, $parse_url_ssl_id);
    $ssl_id = $parse_url_ssl_id['ssl_id'];
    $GatewayPageURL = $sslcommerz_response['GatewayPageURL'];
    $status = $sslcommerz_response['status'];

    # Insert payment Information Into Database.
    $payment_sql = "INSERT INTO `sslcommerz_payment_info` (`tran_id`, `sessionkey`, `ssl_id`, `email`, `phone`, `company_id`, `package_id`, `initiate_response`, `payment_type`, `created_at`) VALUES ('$tran_id', '$sessionkey', '$ssl_id', '$email', '$cus_phone', '$company_id', '$package_id', '$response', '$payment_type', '$created_at')";
    $payment_query = mysqli_query($connect, $payment_sql);
    if ($payment_query == true) {
        // wire here something
    } else {
        return array(
            'success' => false,
            'error' => true,
            'message' => 'Failed To Store Payment Information.',
        );
    }
    # Insert payment Information Into Database.

    //$sslcommerzresponse = json_decode($response, true);

    if (isset($sslcommerz_response['GatewayPageURL']) && $sslcommerz_response['GatewayPageURL'] != "") {
        if ($sslcommerz_response['status'] == 'SUCCESS') {
            return array(
                'success' => true,
                'error' => false,
                'tran_id' => $tran_id,
                'gatewaypageurl' => $sslcommerz_response['GatewayPageURL'],
                'message' => 'Payment Initiate Successfully',
            );
        } else {
            return array(
                'success' => false,
                'error' => true,
                'tran_id' => $tran_id,
                'message' => 'API Connectivity Status FAILED',
            );
        }
    } else {
        return array(
            'success' => false,
            'error' => true,
            'message' => 'JSON DATA PARSING ERROR !',
        );
    }
}//========== end -:- sslcommerzPaymentInitiateAPI() method ==========/
