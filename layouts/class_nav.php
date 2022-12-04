<!-- 班級 GET code -->
<!-- $_GET['code'] 來自 `classes`.`code` -->
<div class="classes">
    <?php
    $sql = "SELECT `code`,`name` FROM `classes`";
    $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $code = (isset($_GET['code'])) ? $_GET['code'] : 1;
    foreach ($classes as $class) {
        if ($code == $class['code']) {
            echo "<div >";
            echo "<a href='?do=students_list&code={$class['code']}' style='background-color:#00e;color:#eee;'>{$class['name']}</a>";
            echo "</div>";
        } else {
            echo "<div>";
            echo "<a href='?do=students_list&code={$class['code']}'>{$class['name']}</a>";
            echo "</div>";
        }
    }
    ?>
</div>
<style>
    .totalSat a {
        display: block;
        width: 200px;
        height: 40px;
        font-size: 24px;
        margin: 10px auto;
        text-align: center;
        line-height: 40px;
        border-radius: 10px;
        text-decoration: none;
        background-color: #aaf;
        color: #333;
        font-weight: bold;
    }

    .totalSat a:hover {
        background-color: #00e;
        color: #eee;
    }
</style>
<!-- 全體學生按鈕 -->
<?php
if (isset($_GET['page']) && !isset($_GET['code'])) {
?>
    <div class="totalSat"><a href="?do=students_list&page=<?=1?>" style='background-color: #00e;color: #eee;'>全體學生</a></div>
<?php } else {; ?>
    <div class="totalSat"><a href="?do=students_list&page=<?=1?>">全體學生</a></div>
<?php }; ?>