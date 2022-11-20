<?php
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');

$school_num=$_POST['school_num'];
$name=$_POST['name'];
$birthday=$_POST['birthday'];
$uni_id=$_POST['uni_id'];
$addr=$_POST['addr'];
$parents=$_POST['parents'];
$tel= $_POST['tel'];
$dept=$_POST['dept'];
$graduate_at=$_POST['graduate_at'];
$status_code=$_POST['status_code'];

$class=$_POST['classes'];
$year=2000;

// $seat_num=;

$sql="INSERT INTO `students` 
(`id`, `school_num`, `name`, 
 `birthday`, `uni_id`, `addr`,
 `parents`, `tel`, `dept`, 
 `graduate_at`, `status_code`) VALUES 

(NULL, '$school_num', '$name', 
 '$birthday', '$uni_id', '$addr', 
 '$parents', '$tel', $dept, 
 $graduate_at, '$status_code')";

//  $sql_calss=INSERT INTO `class_student` (`school`,`class`,``,`year`)
//  AVLUES('','','','');
 echo $sql;
// $res=$pdo->exec($sql);//送出指令
// echo "<pre>";
// print_r($res);
// echo "</pre>";
//echo "新增結果 : ".$res;
// echo "新增成功 : ".$res;

?>