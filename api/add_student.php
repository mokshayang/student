<?php include_once("connect.php");
echo "<pre>";
print_r($_POST);
echo "</pre>";
//建立變數接收表單傳送過來的資料
$school_num = $_POST['school_num'];
$name = $_POST['name'];
$birthday = $_POST['birthday'];
$uni_id = $_POST['uni_id'];
$addr = $_POST['addr'];
$parents = $_POST['parents'];
$tel = $_POST['tel'];
$dept = $_POST['dept'];
$graduate_at = $_POST['graduate_at'];
$status_code = $_POST['status_code'];

//相關的資料表 `class_student`裡的 
//school_num, class_code, seat_num， year 
//也都要變動，所以要找出來，並且更新!!

//來自form.`classes`.`id`
$class_code = $_POST['class_code']; 

//透過SQL語法從class_student資料表中找出某班級的最大座號並加1做為新增的學生的座號
//先找出最大班級座號(`class_student`.`seat_num`) 
$sql_num = "SELECT max(`seat_num`) FROM `class_student` WHERE `class_code`='$class_code'";
$max_num = $pdo->query($sql_num)->fetchColumn();
//最大座號並加1做為新增的學生的座號
$seat_num = $max_num + 1;

//預設年度都是2000年
$year = 2000;
//echo $seat_num;

//建立新增學生資料到students資料表的語法並帶入相關的變數
//標單接收的in `students`
$sql = "INSERT INTO `students` 
    (`id`,`school_num`,`name`,
     `birthday`,`uni_id`,`addr`,
     `parents`,`tel`,`dept`,
     `graduate_at`,`status_code`) VALUES 
    (NULL,'$school_num','$name',
    '$birthday','$uni_id','$addr',
    '$parents','$tel','$dept',
    '$graduate_at','$status_code')";

//建立新增學生所屬班級資料到class_student資料表的語法，並帶入相關的變數
//$school_num來自FORM in `students`
//$class_code來自FORM(from(`classes`)) in `class_student
//$seat_num來自上方的計算 $max+1 from `class_student`
//$year固定的
$sql_class = "INSERT INTO `class_student` (`school_num`, `class_code`, `seat_num`, `year`) VALUES
('$school_num', '$class_code', '$seat_num', '$year')";

//測試階段可以印出sql語法來確認表單傳送過來的值和處理過的資料是否正確
// echo $sql;
// echo "<br>";
// echo $sql_class;

//$pdo->query($sql);
//分別執行兩個新增的語法，如果新增成功，會回傳受影響的資料數，一個新增語法執行成功會回傳1。
$res1 = $pdo->exec($sql);
$res2=$pdo->exec($sql_class);

header("location:../admin_center.php");
