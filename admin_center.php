<?php
include_once("db/connect.php");
// $sql = "SELECT * FROM `students`";
// $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//new PDO('mysql:host=localhost;charset=utf8;dbname=school','root(帳號)','(密碼)')->query("SELECT *    FROM `students` LIMIT 18")為已連線資料庫
//fetchALL(PDL::FETCH_NUM(or ASSOC or NAMED))拿取資料 fetchALL->全拿 
// echo "<pre>";
// print_r($rows);
// echo "</pre>";

//$_SERVER['HTTP_REFERER']會成功都是下方判斷式
//以及logout.php裡的 unset($_SESSION['login']);
//還有header("location:".$_SERVER['HTTP_REFERER']);
//這三個造成的
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php include "./layouts/link_css.php" ?>
    <title>後臺管理系統</title>
    <style>
        nav {
            display: grid;

            height: 28px;
        }

        .item,
        .studentDate {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
        }
    </style>

</head>

<body>
    <?php include_once "layouts/header.php" ?>
    <?php //include_once "front/students_list.php" 
    ?>
    <?php
    $do = $_GET['do'] ?? 'main';
    $file = "./back/" . $do . ".php";
    if (file_exists($file)) {
        include_once $file;
    } else {
        include_once "./back/main.php";
    }
    ?>
    <?php
    if (isset($_GET['del'])) {
        echo "<div class='del-msg'>";
        echo $_GET['del'];
        echo "</div>";
        unset($_GET['del']);
    }
    ?>
<?php include "./layouts/scripts.php";?>
</body>

</html>