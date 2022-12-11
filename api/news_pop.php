<?php
include_once "../db/connect.php";
$sqlReaded=$pdo->query("SELECT `readed` FROM `news` WHERE `id`='{$_GET['id']}'")->fetchColumn();//查詢資料庫，當則新聞的點閱
$addNew=$sqlReaded+1;//將點閱+1
$countNew="UPDATE  `news` SET `readed` = '{$addNew}' WHERE `id`='{$_GET['id']}'";//更新點閱+1

$readed=$pdo->query($countNew)->fetch();//送出點閱+1，並更新資料庫
to("../index.php?do=news_detail&id={$_GET['id']}");

?>