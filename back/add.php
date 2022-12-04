<?php include_once("db/connect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>新增學生</title>
    <style>
        form{
            justify-items: start;
            min-width:520px;
        }
           form label{
            margin-left: 40px;
        }
    </style>
</head>

<body>
    <h1>新增學生</h1>
    <?php
    $sql = "SELECT max(`school_num`) FROM `students`";
    $max = $pdo->query($sql)->fetchColumn();
            /*
                $rows=$pdo->query($sql)->fetchAll();
                $row=$pdo->query($sql)->fetch();
                echo "<pre>";
                echo "<hr>";
                echo "fetchColumn";
                echo "<br>";
                print_r($max);
                echo "<hr>";
                echo "fetchAll";
                print_r($rows);
                echo "<hr>";
                echo "fetch";
                print_r($row);
                print_r($row);
                echo "</pre>"; 
            */
    ?>
    <form action="api/add_student.php" method="post">
        <label>
            <!--將最大的學號+1後做為要新增的下一位學生的學號-->
            <div>學　　號 :　<?= $max + 1 ?></div>
            <input type="hidden" name="school_num" value="<?= $max + 1 ?>">
        </label>
        <label>姓　　名 :
            <input type="text" name="name" required>
        </label>
        <label>生　　日 :
            <input type="date" name="birthday">
        </label>
        <label>身分證號 :
            <input type="text" name="uni_id" required>
        </label>
        <label>住　　址 :
            <input type="text" name="addr">
        </label>
        <label>家長姓名 :
            <input type="text" name="parents" required>
        </label>
        <label>連絡電話 :
            <input type="text" name="tel" required>
        </label>
        <label>科　　別 :
            <select name="dept" required>
                <?php
                //從`dept`資料表中撈出所有的科系資料並在網頁上製作成下拉選單的項目
                $sql="SELECT * FROM `dept`";
                $depts=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($depts as $dept){
                    echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
                }
                ?>
            </select>
        </label>
        <label>畢業國中 :
            <select name="graduate_at">
                <?php
                //從`graduate_school`t資料表中撈出所有的畢業學生資料並在網頁上製作成下拉選單的項目
                $sql="SELECT * FROM `graduate_school` ";
                $grads=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($grads as $grad){
                    echo "<option value='{$grad['id']}'>{$grad['county']}{$grad['name']}</option>";
                }
                ?>
            </select>
        </label>
        <label>畢業情形 :
            <select name="status_code">
                <?php
                //從`status`資料表中撈出所有的畢業狀態並在網頁上製作成下拉選單的項目
                $sql="SELECT * FROM `status`";
                $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
                    echo "<option value='{$row['code']}'>{$row['status']}</option>";
                }
                ?>
            </select>
        </label>
        <label>班級名稱 :
            <select name="class_code">
                <?php
                //從`classes`資料表中撈出所有的班級資料並在網頁上製作成下拉選單的項目
                $sql="SELECT `id`,`code`,`name` FROM `classes`";
                $rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
                foreach($rows as $row){
                    echo "<option value='{$row['code']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </label>
        <input type="submit" value="確認新增">
    </form>
    <?php
if(isset($_GET['status'])){
    switch($_GET['status']){
        case 'add_success' :
            echo "<div>";
            echo "新增成功";
            echo "</div>";
            break;
        case 'add_fail' :
            echo "<div>";
            echo "新增失敗";
            echo "</div>";
            break;
    }
}
?>
</body>

</html>