<?php include_once("connect.php");
session_start();
$acc=$_POST['acc'];
$pw=$_POST['pw'];
//顯查帳密是否符合db(dataBase)有的話 $chk=1
//$chk=1 表是有符合的資料
$sql="SELECT count(`id`) FROM `users` WHERE `acc`='
$acc' && `pw`='$pw'";
$chk=$pdo->query($sql)->fetchColumn();

if($chk==1){
    $sql="SELECT `id`,`acc`,`name`,`last_login` FROM `users` WHERE `acc`=$acc";
}

?>