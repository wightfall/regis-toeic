<?php 
session_start();
include 'connect.php';

$id = $_GET['id'];
$member_name = $_POST['txtmember_name'] ;
$member_password = $_POST['txtmember_password'] ;
$member_mail = $_POST['txtmember_mail'] ;
$member_card_id = $_POST['txtmember_card_id'] ;
$depcode =$_POST['txtdepcode'];


$sql = "Update tbl_member set  member_name = '$member_name' , member_password = '$member_password' , member_mail = '$member_mail', member_card_id = '$member_card_id'   where member_username like '$id'";


$result = $conn -> query($sql)  ;

if ($result) {
  print "<script>alert ('แก้ไขแล้วครับผม)</script>";
  print "<script>window.location='add_m.php';</script>";
}
else {
   echo $conn -> error ; 
   print "กรุณาติดต่อ ผู้ดูแลระบบ" ;
}
?>
