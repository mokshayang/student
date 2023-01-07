<?php
if (isset($_GET['id'])) {
    $survey = find("survey_subject", $_GET['id']); //取得主題
    $options = all("survey_options", ['subject_id' => $_GET['id']]); //取的選項資料
    //  dd($options);
} else {
    $error = "請回到問卷首頁選擇正確的題目來進行";
}
// echo $_GET['ip'];
?>
<style>
    form {
        width: 68%;
        margin: 32px auto;
    }

    .items {
        display: grid;
        grid-template-columns: 3fr 1fr 6fr 3fr;
        justify-items: end;
    }

    .radio {
        width: 38px;
        height: 38px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #eef;
        text-align: center;
        line-height: 38px;
    }

    @media only screen and (max-width: 780px) {
        form {
            width: 90%;
        }
    }
</style>
<h3><?= $survey['subject'] ?></h3>
<form action="./api/survey_vote.php" method="post">
    <div class="items">
        <?php
        if (isset($error)) {
            echo "<span style='color:red'>" . $error . "</span>";
        } else {
            foreach ($options as $key => $option) {
                $checked = ($key == 0) ? "checked" : "";
        ?>
                <!-- 項目列表 -->
                <div></div>
                <div class="radio">
                    <input type="radio" name="option" <?= $checked ?> value="<?= $option['id'] ?>">
                </div>
                <div class="form-control">
                    <?= $option['opt']; ?>
                </div>
                <div></div>
        <?php
            }
        }
        ?>
    </div>
    <?php if (!isset($error)) {; ?>
        <div class="text-center col-12 mt-3">
            <a href="index.php?do=survey" class="btn btn-warning mx-1">取消返回</a>
            <input class="btn btn-primary mx-1" type="submit" value="投票">
        </div>
    <?php } ?>
</form>