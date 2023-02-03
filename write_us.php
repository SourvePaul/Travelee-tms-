<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}

if(isset($_POST['submit']))
{
$issue       = $_POST['issue'];
$description = $_POST['description'];
$booking_id  = $_POST['booking_id'];
$email       = $_SESSION['login'];
$sql         = "INSERT INTO  tblissues(UserEmail,Issue,Description,booking_id) VALUES(:email,:issue,:description,:booking_id)";
$query       = $dbh->prepare($sql);
$query->bindParam(':issue',$issue,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':booking_id',$booking_id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$_SESSION['msg']="Info successfully submited ";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
else 
{
$_SESSION['msg']="Something went wrong. Please try again.";
echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
}
}


else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Travelee</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tourism Management System In PHP" />
<!-- Favicons -->
<link href="images/logo.png" rel="icon">
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>

  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>
<body>
<!-- top-header -->
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Write Us Your Problem</h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Write Us Your Problem</h3>
		
        <form name="help" method="post">
										<h4>HOW CAN WE HELP YOU</h4>
											<ul>
												
												<li class="na-me">
													<select id="country" name="issue" class="frm-field required sect" required="">
														<option value="">Select Issue</option> 		
														<option value="Booking Issues">Booking Issues</option>
														<option value="Cancellation"> Cancellation</option>
														<option value="Refund">Refund</option>
														<option value="Other">Other</option>														
													</select>
												</li>
                                                <br>
                                                <li class="na-me">
													<select id="booking_id" name="booking_id" class="frm-field required sect" required="">
														<option value="">Select Booking</option> 		
                                                <?php 
                                                    $uemail=$_SESSION['login'];;
                                                    $sql = "SELECT book.BookingId,pack.PackageName,pack.PackageLocation,book.FromDate,book.ToDate,book.RegDate,ss.amount,ss.tran_id,book.status FROM tblbooking book
                                                    left join tbltourpackages pack on book.PackageId = pack.PackageId
                                                    left join sslcommerz_payment_info ss on book.BookingId = ss.book_id
                                                    where book.UserEmail = '$uemail' and book.status in (1,0);";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);            
            
                                                    $cnt=1;
                                                    foreach($results as $result){
                                                        ?>
                                                            <option value="<?php echo $result->BookingId; ?>"><?php echo $result->PackageName; ?> (<?php echo $result->RegDate ?>)</option>  
                                                        <?php 

                                                    }
                                                ?>
                                                </select>
												</li>
<br>
                                                
											
												<li class="descrip">
									                

													<textarea class="special from-control" name="description" placeholder="Write description.." required="" style="padding: 8px 0px!important; height:50px; width:525px; color: rgba(158, 158, 158,69); margin-top: 0px; border: none; font-size: 18px; border-bottom: 1px solid rgba(0,0,0,.12); vertical-align: middle; outline: none;"></textarea>

								</li>
													<div class="clearfix"></div>
											</ul>
											<div class="sub-bn">
												<form>
													<button type="submit" name="submit" class="subbtn">Submit</button>
												</form>
											</div>
								</form>

		
	</div>
</div>
<!--- /privacy ---->
<!--- footer-top ---->
<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>
</body>
</html>
<?php } ?>
