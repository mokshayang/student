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

$sql = "SELECT * FROM `news` WHERE `id`='{$_GET['id']}'";
$news = $pdo->query($sql)->fetch();

?>
<div class="total">
    <h2><?= $news['subject'] ?></h2>
    <div class="timer">
        發布時間 : <?= $news['created_at'] ?>
    </div>
    <div class="type">[ <?= $news['type']  ?> ] : </div>
    <div class="content"><?= nl2br($news['content']) ?></div>
</div>