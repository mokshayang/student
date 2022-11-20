<?php include_once("api/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>修改學生資料</title>
    <style>
        form {
            height: 680px;
        }
    </style>
</head>

<body>
    <h1>修改學生資料</h1>
    <?php
    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM `students` WHERE `id`='{$_GET['id']}'";
        $student = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    } else {
        header("location:index.php?status=edit_error");
    }

    ?>
    <form action="api/edit_student.php" method="post">
        <label>學　　號 :
            <span><?= $student['school_num'] ?></span>
        </label>
        <label>姓　　名 :
            <input type="text" name="name" value="<?= $student['name'] ?>">
        </label>
        <label>生　　日 :
            <input type="date" name="birthday" value="<?= $student['birthday'] ?>">
        </label>
        <label>身分證號 :
            <input type="text" name="uni_id" value="<?= $student['uni_id'] ?>">
        </label>
        <label>住　　址 :
            <input type="text" name="addr" value="<?= $student['addr'] ?>">
        </label>
        <label>家長姓名 :
            <input type="text" name="parents" value="<?= $student['parents'] ?>">
        </label>
        <label>連絡電話 :
            <input type="text" name="tel" value="<?= $student['tel'] ?>">
        </label>
        <label>科　　別 :
            <select name="dept">
                <?php
                //從`dept`資料表中撈出所有的科系資料並在網頁上製作成下拉選單的項目
                $sql = "SELECT * FROM `dept`";
                $depts = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($depts as $dept) {
                    $selected = ($dept['id'] == $student['dept']) ? 'selected' : '';
                    echo "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
                }
                ?>
            </select>
        </label>
        <label>畢業國中 :
            <select name="graduate_at">
                <?php
                //從`graduate_school`t資料表中撈出所有的畢業學生資料並在網頁上製作成下拉選單的項目
                $sql = "SELECT * FROM `graduate_school` ";
                $grads = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($grads as $grad) {
                    $selected = ($grad['id'] == $student['graduate_at']) ? 'selected' : '';
                    echo "<option value='{$grad['id']}' $selected>{$grad['county']}{$grad['name']}</option>";
                }
                ?>
            </select>
        </label>
        <label>畢業情形 :
            <select name="status_code">
                <?php
                //從`status`資料表中撈出所有的畢業狀態並在網頁上製作成下拉選單的項目
                $sql = "SELECT * FROM `status`";
                $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                    $selected = ($row['code'] == $student['status_code']) ? 'selected' : '';
                    echo "<option value='{$row['code']}' $selected>{$row['status']}</option>";
                }
                ?>
            </select>
        </label>
        <label>班級名稱 :
            <select name="class_code">
                <?php
                //建立class_student 與 students 的單筆連結資料
                //class_student 與 classes 有相同的資料
                //`students`.`id`從form表單過來，要建立class_student與students的連結
                //相同欄位 >>> school_num <<< 
                $stu_class = $pdo->query("SELECT *  FROM `class_student`  WHERE `school_num`='{$student['school_num']}'")->fetch(PDO::FETCH_ASSOC);
                //這樣表單`class_student`與 一開始id過來的單筆資料 已產生連結 
                //兩張表格`class_student` and `students` 的column都抓得到了!!

                //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
                $sql = "SELECT `id`,`code`,`name` FROM `classes`";
                $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row) {
                    $selected = ($row['code'] == $stu_class['class_code']) ? 'selected' : '';
                    echo "<option value='{$row['code']}' $selected>{$row['name']}</option>";
                }
                ?>
            </select>
        </label>
        <label>座　　號 :
            <span>　<?= $stu_class['seat_num'] ?></span>
        </label>
        <!-- 建立 id 修改需用到 -->
        <input type="hidden" name="id" value="<?= $student['id'] ?>">
        <input type="submit" value="確認修改">
    </form>
    <a href="index.php?page=1" class="back">回列表</a>
    <?php
    if (isset($_GET['edit'])) {
        switch ($_GET['edit']) {
            case 'edit_success':
                echo "<div class='edit'>修改成功</div>";
                break;
            case 'edit_fail';
                echo "<div class='edit edit_err'>修改有誤或未修改</div>";
                break;
        }
    }
    ?>
</body>

</html>