<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
$eid=intval($_GET['editbid']);	
if(isset($_POST['submit']))
{
    $eid= $_SESSION['editbid'];
    $brand=$_POST['brand'];
    $update=date('Y/m/d');
    $sql4="update tblbrands set BrandName=:brand,UpdationDate=:update where id=:eid";
    $query=$dbh->prepare($sql4);
    $query->bindParam(':brand',$brand,PDO::PARAM_STR);
    $query->bindParam(':update',$update,PDO::PARAM_STR);
    $query->bindParam(':eid',$eid,PDO::PARAM_STR);
    $query->execute();
    if ($query->execute())
    {
        echo '<script>alert("updated successfuly")</script>';
    }else{
        echo '<script>alert("update failed! try again later")</script>';
    }
}
?>

<div class="grid-form1">

<?php 
$eid=intval($_GET['editbid']);
$sql = "SELECT * from tblbrands where id=:eid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':eid', $eid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

							<form class="form-horizontal" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Brand Name</label>
									<div class="col-sm-8">
                                    <input type="text" name="brand" id="brand" class="form-control" value="<?php  echo $row->BrandName;?>" required />
									</div>
								</div>
</form>

    <?php 
        }
    } ?>

</div>
<?php 
}
?>