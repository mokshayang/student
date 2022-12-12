<?php
$subject = find("survey_subject", $_GET['id']);
$options = all("survey_options", ["subject_id" => $_GET['id']]);
// dd($subject);
// dd($options);
//SQL : R $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); 用最多的
//all($table,...$args)//二微陣列 fetchAll(PDO::FETCH_ASSOC);
//型式 : all('students'," where `dept`='2'");//str
//型式 : all('students',['name'=>'宋時雨']); //array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]);//array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]," ORDER BY `id` desc");//array+$args[1]

?>
<style>
    .total{
        text-align: center;
        font-size: 18px;
        margin-bottom: 10px;
        color: #f20;
        font-weight: bold;
    }
</style>
<h3>調查結果</h3>
<h3 class="text-primary text-center"><?= $subject['subject']; ?></h3>
<div class="total">目前共 <?=$subject['vote']?> 人投票</div>
<ul class="list-group col-10 mx-auto">
    <?php
    foreach ($options as $option) {
        $division = ($subject['vote'] == 0) ? 1 : $subject['vote'];//預防分母為0
        $width = round(($option['vote'] / $division) * 100, 1);
    ?>
        <li class="d-flex list-group-item list-group-item-light list-group-item-action">
            <div class="col-4"><?= $option['opt']; ?></div>
            <div class="col-2"><?= $option['vote']; ?> 人</div>
            <div class="col-5 d-flex align-items-center">
                <div class="col-5 bg-primary rounded" style="width:<?= $width; ?>%">&nbsp;</div>
                <div class="col-1">&nbsp;<?= $width; ?>%</div>
            </div>
        </li>
    <?php
    }
    ?>
</ul>
<div class="text-center mt-4">

    <a href="index.php?do=survey" class="btn btn-warning mx-1">返回</a>
</div>