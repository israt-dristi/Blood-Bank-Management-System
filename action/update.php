<?php
session_start();
include('../include/conn.php');
if(isset($dbh)){
//connection check
if(isset($_POST['submit'])){
//
$newimage = $_FILES["dimage"]["name"];
//file check
if($newimage != null){
	$oldfile = $_POST['oldfile'];
	unlink($oldfile);
	$sql = "UPDATE `doner update` SET `dname`= :dname,`ddunation`= :ddunation, `ddescription`= :ddescription, `dimage`= :dimage, `is_active`= :is_active where id = :id";
	//fatch image
	$target_dir = "../assets/img/doner/";
	$target_file = $target_dir . basename($_FILES["dimage"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$cimage = $target_file;
	move_uploaded_file($_FILES["dimage"]["tmp_name"], $target_file);
}
else{
	$sql = "UPDATE `doner update` SET `dname`= :dname,`ddunation`= :ddunation, `ddescription`= :ddescription, `is_active`= :is_active where id = :id";
}
$stmt = $dbh->prepare($sql);
//insert File
//bindParam
$stmt->bindParam(':dname', $cname);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':ddunation', $ddunation);
$stmt->bindParam(':ddescription', $ddescription);
if($newimage != null){
	$stmt->bindParam(':dimage', $dimage);
}
$stmt->bindParam(':is_active', $is_active);

//Fatch data user form

$id = $_POST['id'];
$dname = $_POST['dname'];
$ddunation = $_POST['ddunation'];
$ddescription = $_POST['ddescription'];
$is_active = $_POST['is_active'];
//checkpassword
if($stmt->execute()){
$message="Update Doner Scuccess";
header("Location:../search-doner.php");
}
else{
$message="Doner Update Fail!";
// header("Location:../deletedoner.php");
}
}
}