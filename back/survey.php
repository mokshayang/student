<h3 >調查列表</h3>
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
    $surveys = all("survey_subject");
    //  dd($surveys);
    
    foreach ($surveys as $survey) {
    ?>
        <div class="items">
            <div><?= $survey['subject'] ?></div>
            <div><?= $survey['vote'] ?></div>
            <div>
                <?php
                $activeBg = ($survey['active'] == 1) ? "btn-primary" : "btn-secondary";
                $activeText = ($survey['active'] == 1) ? "啟用" : "關閉";
                ?>
                <a href="./api/survey_active.php?id=<?= $survey['id'] ?>" class="btn btn-sm mx-1 <?= $activeBg ?> "><?= $activeText ?></a>
                <a href="./admin_center.php?do=survey_edit&id=<?=$survey['id'];?>" class="btn btn-sm btn-success mx-1">編輯</a>
                <a href="./api/survey_del.php?id=<?=$survey['id']?>" class="btn btn-sm btn-info mx-1">刪除</a>
            </div>
        </div>
    <?php }; ?>
</div>
<style>
    .err{
        text-align: center;
        margin: 40px auto;
        color: red;
        font-weight: bold;
        font-size: 20px;
    }
</style>
<?php
(isset($_GET['error']))?$_GET['error']:$_GET['error']='';
echo "<div class=err>";
echo $_GET['error'];
echo "</div>";
?>