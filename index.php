<?php
include_once("db/connect.php");
// $sql = "SELECT * FROM `students`";
// $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//new PDO('mysql:host=localhost;charset=utf8;dbname=school','root(帳號)','(密碼)')->query("SELECT *    FROM `students` LIMIT 18")為已連線資料庫
//fetchALL(PDL::FETCH_NUM(or ASSOC or NAMED))拿取資料 fetchALL->全拿 
// echo "<pre>";
// print_r($rows);
// echo "</pre>";
$_SESSION['login_try'] = 0;//登入錯誤次數重整
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>學生管理系統</title>
    <style>

    </style>
</head>

<body>
    <?php include_once "layouts/header.php" ?>
    <?php //include_once "front/students_list.php" ?>
    <?php
        $do=$_GET['do']??'main';
        $file="./front/".$do.".php";
        if(file_exists($file)){
            include_once $file;
        }else{
            include_once "./front/main.php";
        }
    ?>
    <?php include_once "layouts/class_nav.php"; ?>   
</body>

</html>