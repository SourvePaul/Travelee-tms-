<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {	
header('location:index.php');
    } else {
if(isset($_POST['submit'])) {

    $brandname=$_POST['brandname'];
    $sql="insert into tblbrands(BrandName)values(:brandname)";
    $query=$dbh->prepare($sql);
    $query->bindParam(':brandname',$brandname,PDO::PARAM_STR);
    $query->execute();
    $LastInsertId=$dbh->lastInsertId();
    if ($LastInsertId>0) 
    {
      echo '<script>alert("Registered successfully")</script>';
      echo "<script>window.location.href ='brand.php'</script>";
    }
    else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
if(isset($_GET['del'])) {
    $id=$_GET['del'];
    $sql = "delete from tblbrands  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> execute();
    echo "<script>alert('brand record deleted.');</script>"; 
  
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Travelee | Admin Package Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- Favicons -->
<link href="images/logo.png" rel="icon">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<!-- tables -->
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<link rel="stylesheet" type="text/css" href="css/basictable.css" />
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
<div class="page-container">

   	<!--/content-inner-->
    <div class="left-content">
	   	<div class="mother-grid-inner">
              
	   	    <!--header start here-->
			<?php include('includes/header.php');?>
				<div class="clearfix"> </div>	

	    </div>
		    <!--heder end here-->
		    <ol class="breadcrumb">
        	    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Create Band</li>
            </ol>

	<!--grid-->
 	<div class="grid-form">
  	<div class="grid-form1">
  	    <h3>Create Package</h3>
  	    <?php if($error){?>
            <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> 
            </div>
        <?php } else if($msg){?>
            <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
            </div>
        <?php }?>

  	    <div class="tab-content">
			<div class="tab-pane active" id="horizontal-form">
				<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">

                    <div class="form-group ">
						<label for="exampleInputName1" class="col-sm-2 control-label">Band Name</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="brandname" id="brandname" placeholder="Enter Band.." required>
							</div>
					</div>

					<div class="row">
			            <div class="col-sm-8 col-sm-offset-2">
				            <button type="submit" name="submit" class="btn-primary btn">Create</button>
                            <button type="reset" class="btn-inverse btn">Reset</button>
			            </div>
		            </div>	
				

                </form>
            </div>
 	    </div>
 	<!--end of grid-->

    <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <!--  start  modal -->
                <div id="editData4" class="modal fade">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Brand details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body" id="info_update4">
                                    <?php include("edit_brand.php");?>
                                </div>
                                <div class="modal-footer ">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                                <!-- /.modal-content -->
                        </div>
                                <!-- /.modal-dialog -->
                    </div>
                                <!-- /.modal -->
                </div>
                                <!--   end modal -->
            </div>
    </div>


    <div class="agile-grids">	
	<!-- tables -->
	<div class="agile-tables">
		<div class="w3l-table-info">
			<h3>Manage Band</h3>
				<table id="table" class="table align-items-center table-flush table-hover table-bordered">
					<thead>
					<tr>
					<th>#</th>
                    <th>Brand Name</th>
                    <th>Creation Date</th>
                    <th>Updation date</th>
                    <th>Action</th>
					</tr>
                    </thead>
                        <tbody>
                        <?php
                            $sql = "SELECT * from  tblbrands ";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0) {
                                foreach($results as $result) {     
                        ?>
                    <tr>
                    <td><?php echo htmlentities($cnt);?></td>
                    <td><?php echo htmlentities($result->BrandName);?></td>
                    <td><?php  echo htmlentities(date("d-m-Y", strtotime($result->CreationDate)));?></td>
                    <td><?php  echo htmlentities(date("d-m-Y", strtotime($result->UpdationDate)));?></td>
                    <td class=" text-center">
                        <a href="#"  class=" edit_data4" id="<?php echo  ($result->id); ?>" title="click to edit">
                        <buttom style="color:#fff; font-weight:bold; background-color:#004580e0; text-align:center;"> Edit </bottom>
                        </a>&nbsp;&nbsp;
                        <a href="brand.php?del=<?php echo $result->id;?>" onclick="return confirm('Do you want to delete');">
                        <buttom style="color:#fff; font-weight:bold; background-color:#004580e0; text-align:center;"> Delete </bottom>
                        </a>
                        </td>

                    </tr>
                          <?php 
                          $cnt=$cnt+1;
                            }
                            } ?>
                        </tbody>
                </table>
            </div>
        </div>
        </div>


    <!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		var navoffeset=$(".header-main").offset().top;
			$(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
			}else{
					$(".header-main").removeClass("fixed");
				}
			});
			 
		});
	</script>
    <!-- end script-for sticky-nav -->

    <!--copy rights start here-->
        <?php include('includes/footer.php');?>
    <!--COPY rights end here-->

    </div>
    </div>
    <!--End content-inner-->

	<!--/sidebar-menu-->
	    <?php include('includes/sidebarmenu.php');?>
		<div class="clearfix"></div>		
		</div>

		<script>
		var toggle = true;
		$(".sidebar-icon").click(function() {                
			if (toggle) {
				$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
				$("#menu span").css({"position":"absolute"});
						} else {
							    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								    $("#menu span").css({"position":"relative"});
								    }, 400);
							  }
								toggle = !toggle;
						});
		</script>
        <script type="text/javascript">
            $(document).ready(function(){
            $(document).on('click','.edit_data4',function(){
                var edit_id4=$(this).attr('id');
            $.ajax({
                url:"edit_brand.php",
                type:"post",
                data:{edit_id4:edit_id4},
                success:function(data){
            $("#info_update4").html(data);
            $("#editData4").modal('show');
            }
            });
            });
            });
        </script>


<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?>