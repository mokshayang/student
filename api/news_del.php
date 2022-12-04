<?php
include_once "../db/connect.php";

$pdo->exec("DELETE FROM `news` WHERE `id`='{$_GET['id']}'");
header("location:../admin_center.php?do=news");

?>