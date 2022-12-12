<?php include "./layouts/link_css.php";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
{
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
{
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
?>

<h3>調查列表</h3>
<div class=add_head>
    <a href="admin_center.php?do=survey_add">新增調查主題</a>
</div>

<div class="table_list">
    <div class="table_head">
        <div>主題</div>
        <div>參與數</div>
        <div>操作</div>
    </div>
    <?php
    $surveys = all("survey_subject", ['active' => 1]);
    //   dd($surveys);
    foreach ($surveys as $survey) {

    ?>
        <div class="items">
            <div><?= $survey['subject'] ?></div>
            <div><?= $survey['vote'] ?></div>
            <div>
                <a href="./index.php?do=survey_item&id=<?= $survey['id'] ?>" class="btn btn-sm btn-success mx-1 ">投票</a>
                <a href="index.php?do=survey_result&id=<?= $survey['id']; ?>" class="btn btn-sm btn-info mx-1">結果</a>

            </div>
        </div>
    <?php }; ?>
</div>