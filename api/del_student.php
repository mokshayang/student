<?php include_once("connect.php");
    $sql_student="DELETE FROM `students` WHERE `id`='{$_GET['id']}'";
    // echo "$sql_student";
    //先建立變數 $student 要與 班級相連的(單筆)
    $student=$pdo->query("SELECT * FROM `students` WHERE `id`='{$_GET['id']}'")->fetch(PDO::FETCH_ASSOC);
    //班級的相關
    $sql_class="DELETE FROM `class_student` WHERE `school_num`='{$student['school_num']}'";
    $res_student=$pdo->exec($sql_student);
    $res_class=$pdo->exec($sql_class);

    if(isset($_GET['code'])){
        $url="location:../admin_center.php?page={$_GET['page']}&code={$_GET['code']}&del=已成功刪除學生{$student['name']}的所有資料！！";
    }else{
        $url="location:../admin_center.php?page={$_GET['page']}&del=已成功刪除學生{$student['name']}的所有資料！！";
    }
header($url);
?>