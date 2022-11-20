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
        $url="location:../index.php?page={$_GET['page']}&code={$_GET['code']}";
    }else{
        $url="location:../index.php?page={$_GET['page']}";
    }
header($url);
?>