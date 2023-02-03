<?php
error_reporting(0);
include '../database_connection.php';
include 'sslcommerz_api_information.php';
date_default_timezone_set('Asia/Dhaka');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Document Title -->
    <title>Ezy Meeting</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../landing-assets/fav.png">

    <!--==== Bootstrap css file ====-->
    <link rel="stylesheet" href="../landing-assets/css/bootstrap.min.css">

    <!--==== Font-Awesome css file ====-->
    <link rel="stylesheet" href="../landing-assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../landing-assets/css/swiper.min.css">

    <!-- Owl Carusel css file -->
    <link rel="stylesheet" href="../landing-assets/plugins/owl-carousel/owl.carousel.min.css">

    <!-- ====video poppu css==== -->
    <link rel="stylesheet" href="../landing-assets/plugins/Magnific-Popup/magnific-popup.css">

    <!--==== Style css file ====-->
    <link rel="stylesheet" href="../landing-assets/css/style.css">

    <!--==== Responsive css file ====-->
    <link rel="stylesheet" href="../landing-assets/css/responsive.css">

    <!--==== Custom css file ====-->
    <link rel="stylesheet" href="../landing-assets/css/custom.css">

    <style>
        .about p {
            text-align: justify;
            color: #000;
        }

        .featureinfo .box {

            padding: 30px 100px;
        }

        .featureinfo .box h5 {
            color: #000;
            font-size: 30px;
            margin-top: 0px !important;
            font-weight: 400;
        }

        .featureinfo .box img {
            margin: -55px auto 11px auto;
        }

        @media (max-width: 540px) {
            .featureinfo .box {

                padding: 30px;
            }
        }
    </style>
    <style>
        .featureinfo {
            margin-top: 0;
        }

        #features {
            padding-top: 19px;
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preLoader">
        <div class="preload-inner">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
    </div>
    <!-- End Of Preloader -->

    <!-- Main header -->
    <?php include_once '../header.php'; ?>
    <!-- End of Main header -->
    <section class="single-page">
        <img src="../landing-assets/banner/success.jpg" class="fullwidth" alt="">
        <section class="featureinfo" id="features">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12 about mt-40">
                        <div class="box">
                            <img src="../landing-assets/img/icons/ic9.png" alt="" width="70px">
                            <h5 class="text-success">Success Page</h5>
                            <?php

                            if (isset($_GET['tran_id'])) {
                                echo '<div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Success!</strong> Payment Successfully.
                                      </div>';
                                $sslcommerzpayment_sql = "SELECT * FROM sslcommerz_payment_info WHERE tran_id = '$tran_id' LIMIT 1";
                                $sslcommerzpayment_query = mysqli_query($connect, $sslcommerzpayment_sql);
                                $sslcommerzpayment_data = mysqli_fetch_assoc($sslcommerzpayment_query);
                                if (!empty($sslcommerzpayment_data)) {
                                    return array(
                                        'success' => false,
                                        'error' => true,
                                        'message' => 'Email Not Exist In Company By ' . $company_data['email'],
                                    );
                                }else{
                                    echo '<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>Success!</strong> Payment Successfully.
                                    </div>';
                                }
                            } else {
                                echo '<div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Error ! </strong>Transaction ID Not Included.
                                      </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--/.container-->
        </section>
    </section>
    <?php include  '../footer.php'; ?>
    <script>
        var div = document.createElement('div');
        div.className = 'fb-customerchat';
        div.setAttribute('page_id', '103714791329300');
        div.setAttribute('ref', '');
        document.body.appendChild(div);
        window.fbMessengerPlugins = window.fbMessengerPlugins || {
            init: function() {
                FB.init({
                    appId: '1678638095724206',
                    autoLogAppEvents: true,
                    xfbml: true,
                    version: 'v3.3'
                });
            },
            callable: []
        };
        window.fbAsyncInit = window.fbAsyncInit || function() {
            window.fbMessengerPlugins.callable.forEach(function(item) {
                item();
            });
            window.fbMessengerPlugins.init();
        };
        setTimeout(function() {
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        }, 0);
    </script>



    <!-- JS Files -->
    <!-- ==== JQuery 3.3.1 js file==== -->
    <script src="../landing-assets/js/jquery-3.3.1.min.js"></script>

    <!-- ==== Bootstrap js file==== -->
    <script src="../landing-assets/js/bootstrap.bundle.min.js"></script>

    <!-- ==== JQuery Waypoint js file==== -->
    <script src="../landing-assets/plugins/waypoints/jquery.waypoints.min.js"></script>

    <!-- ==== Parsley js file==== -->
    <script src="../landing-assets/plugins/parsley/parsley.min.js"></script>

    <!-- ==== parallax js==== -->
    <script src="../landing-assets/plugins/parallax/parallax.js"></script>

    <!-- ==== Owl Carousel js file==== -->
    <script src="../landing-assets/plugins/owl-carousel/owl.carousel.min.js"></script>

    <!-- ==== Menu  js file==== -->
    <script src="../landing-assets/js/menu.min.js"></script>

    <!-- ===video popup=== -->
    <script src="../landing-assets/plugins/Magnific-Popup/jquery.magnific-popup.min.js"></script>

    <!-- ====Counter js file=== -->
    <script src="../landing-assets/plugins/waypoints/jquery.counterup.min.js"></script>

    <!-- ==== Script js file==== -->
    <script src="../landing-assets/js/scripts.js"></script>
    <script src="../landing-assets/js/swiper.min.js"></script>

    <!-- ==== Custom js file==== -->
    <script src="../landing-assets/js/custom.js"></script>
    <script>
        $('.log').click(function() {
            $('#registerModal').modal('hide');
        });
        $('.reg').click(function() {
            $('#loginModal').modal('hide');
        });

        $('.header-menu li a').click(function() {
            $('.header-menu li').removeClass('active');
            $(this).parent('li').addClass('active');
        });
    </script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 30,
            freeMode: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                260: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
                1120: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
</body>

</html>











<?php
die();
include 'sslcommerz_cridential.php';
if (isset($_GET['tran_id'])) {
    $tran_id = trim($_GET['tran_id']);

    $conn = mysqli_connect('localhost', 'root', '', 'ezy_meeting_demo_presentation');
    mysqli_set_charset($conn, "utf8");
    if (!$conn) {
        die("Database connection failed.");
    }
    $sql = "SELECT * FROM sslcommerz_payment_info WHERE tran_id = '$tran_id' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($query);
    //$data = mysqli_fetch_array($query);

    //echo "<pre>";
    //print_r($data);

    if (!empty($data)) {
        $sessionkey = $data['sessionkey'];
        $val_id = $data['val_id'];
        $session_response = $data['session_response'];
        $session_response = json_decode($session_response, true);
        if (empty($val_id)) {
            $sessionkey_response = transactionQueryBySessionKeyAPI($tran_id, $sessionkey);
            $val_id =  $sessionkey_response['val_id'];
        }
        orderValidationAPI($tran_id, $sessionkey, $val_id);
        echo "<pre>";
        print_r($session_response);
    } else {
        echo 'data is empty';
    } // data empty checking.



    $conn->close();
} else {
    echo 'tran_id not included';
}

function transactionQueryBySessionKeyAPI($tran_id, $sessionkey)
{
    $sessionkey = urlencode($sessionkey);
    $store_id = urlencode(STORE_ID);
    $store_passwd = urlencode(STORE_PASSWD);

    $requested_url = ("https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php?sessionkey=" . $sessionkey . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

    $response = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

    if ($code == 200 && !(curl_errno($handle))) {

        # TO CONVERT AS ARRAY
        $result = json_decode($response, true);

        # TO CONVERT AS OBJECT
        //$result = json_decode($response);

        $val_id = $result['val_id'];

        $conn = mysqli_connect('localhost', 'root', '', 'ezy_meeting_demo_presentation');
        mysqli_set_charset($conn, "utf8");
        if (!$conn) {
            die("Database connection failed.");
        }
        $sql = "UPDATE sslcommerz_payment_info SET val_id='$val_id', session_response='$response' WHERE tran_id = '$tran_id'";
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        //echo "<pre>";
        //print_r($result);

        return $result;
    } else {
        echo "Failed To Connect With SSLCOMMERZ. [Transaction Query API By Session ID]";
    }
} // end -:- transactionQueryBySessionKey

function orderValidationAPI($tran_id, $sessionkey, $val_id)
{
    $val_id = urlencode($val_id);
    $store_id = urlencode(STORE_ID);
    $store_passwd = urlencode(STORE_PASSWD);

    $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC

    $response = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);


    if ($code == 200 && !(curl_errno($handle))) {
        # TO CONVERT AS ARRAY
        $result = json_decode($response, true);

        # TO CONVERT AS OBJECT
        //$result = json_decode($response);

        $conn = mysqli_connect('localhost', 'root', '', 'ezy_meeting_demo_presentation');
        mysqli_set_charset($conn, "utf8");
        if (!$conn) {
            die("Database connection failed.");
        }
        $sql = "UPDATE sslcommerz_payment_info SET val_id='$val_id', validation_response='$response' WHERE tran_id = '$tran_id'";
        if ($conn->query($sql) === TRUE) {
            //echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // echo "<pre>";
        // print_r($result);
    } else {
        echo "Failed To Connect With SSLCOMMERZ. [Order Validation API]";
    }
} // end -:- OrderValidationAPI
?>