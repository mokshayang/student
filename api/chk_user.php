<?php include_once("../db/connect.php");
session_start();
$acc=$_POST['acc'];
$pw=$_POST['pw'];
//顯查帳密是否符合db(dataBase)有的話 $chk=1
//$chk=1 表是有符合的資料
$sql="SELECT count(`id`) FROM `users` 
WHERE `acc`='$acc' && `pw`='$pw' ";
$chk=$pdo->query($sql)->fetchColumn();

if($chk==1){
    $sql="SELECT `id`,`acc`,`name`,`last_login` FROM `users` WHERE `acc`='$acc' && `pw`='$pw' ";
    $user=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    $_SESSION['login']=$user;
    header("location:../admin_center.php");
}else{
    if(isset($_SESSION['login_try'])){
        $_SESSION['login_try']++;
    }else{
        $_SESSION['login_try']=1;
    }
    header("location:../login.php?error=login");
}
//判定是否登入成功(dbData)，成功->登入，失敗返回定帶錯誤訊息回去
?>