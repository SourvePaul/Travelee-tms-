<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
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
h3.wow.fadeInDown.animated.animated.animated {
    text-align: center!important;
}
		</style>
</head>
<body>
<!-- top-header -->
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
        Booking Payment History</h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Booking Payment History</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">

	<p>
	<table border="1" width="100%">
<tr style="text-align: center;">
<th>#</th>
<th>Package</th>
<th>Location</th>	
<th>Booking Date</th>
<th>Amount</th>
<th>Payment ID</th>
<th>Status</th>

</tr>
<?php 

$uemail=$_SESSION['login'];;
$sql = "SELECT pack.PackageName,pack.PackageLocation,book.FromDate,book.ToDate,ss.amount,ss.tran_id,book.status FROM tblbooking book
left join tbltourpackages pack on book.PackageId = pack.PackageId
left join sslcommerz_payment_info ss on book.BookingId = ss.book_id
where book.UserEmail = '$uemail';";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);


$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>
<tr align="center">
<td ><?php echo htmlentities($cnt);?></td>
<td width="200"><?php echo htmlentities($result->PackageName);?></td>
<td width="300"><?php echo htmlentities($result->PackageLocation);?></td>
<td width="300"><?php echo date('jS F, Y', strtotime($result->FromDate));?> - <?php echo date('jS F, Y', strtotime($result->ToDate));?></td>
<td><?php echo number_format($result->amount, 2);?> TK</td>
<td width="100"><?php echo htmlentities($result->tran_id);?></td>
<td width="100">
    <?php 
        if($result->status == 0){
            echo "Pending";
        }elseif($result->status == 1){
            echo "Confirmed";
        }else{
            echo "Canceled";
        }
    ?>
</td>
</tr>
<?php $cnt=$cnt+1; }} ?>
	</table>
		
			</p>
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
