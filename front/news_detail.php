<style>
    .total{
        width: 72%;
        min-width:520px;
        margin: auto;
    }
    h2{
        margin: 10px;
        font-size: 36px;
    }
    .timer{
        text-align:right;
        padding-right:40px;
    }
    .type{
        margin: 10px auto;
        font-size: 24px;
    }
    .content{
        font-size: 20px;
        background-color: #eef;
        padding:20px 20px 40px;
        border-radius: 10px;
    }
</style>
<?php
// $max = $pdo->query($sql)->fetchColumn();
$sql = "SELECT * FROM `news` WHERE `id`='{$_GET['id']}'";
$sqlReaded=$pdo->query("SELECT `readed` FROM `news` WHERE `id`='{$_GET['id']}'")->fetchColumn();//查詢資料庫，當則新聞的點閱
 $addNew=$sqlReaded+1;//將點閱+1
$countNew="UPDATE  `news` SET `readed` = '{$addNew}' WHERE `id`='{$_GET['id']}'";//更新點閱+1
echo $sqlReaded ;
$news = $pdo->query($sql)->fetch();
$readed=$pdo->query($countNew)->fetch();//送出點閱+1，並更新資料庫


?>
<div class="total">
    <h2><?= $news['subject'] ?></h2>
    <div class="timer">
        發布時間 : <?= $news['created_at'] ?>
    </div>
    <div class="type">[ <?= $news['type']  ?> ] : </div>
    <div class="content"><?= nl2br($news['content']) ?></div>
</div>