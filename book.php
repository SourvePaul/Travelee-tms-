<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');

echo "<pre>";
print_r($_POST);

$useremail  = $_SESSION['login'];
$fromdate   = date('Y-m-d', strtotime($_POST['fromdate']));
$todate     = date('Y-m-d', strtotime($_POST['todate']));
$price      = $_POST['price'];
$package_id = $_POST['package_id'];
$comment    = $_POST['comment'];
$status     = 0;

$sql = "SELECT * FROM `tblusers` where EmailId='$useremail'";
$query = $dbh->prepare($sql);
$query->execute();
$results      = $query->fetchAll(PDO::FETCH_OBJ);
$FullName     = $results[0]->FullName;
$MobileNumber = $results[0]->MobileNumber;


$sql       = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
$query     = $dbh->prepare($sql);
$query->bindParam(':pid',$package_id,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':comment',$comment,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$book_id = $dbh->lastInsertId();

header("location:ssl/payment.php?fullname={$FullName}&MobileNumber={$MobileNumber}&price={$price}&book_id={$book_id}&email={$useremail}");

