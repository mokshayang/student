<?php include_once("../db/connect.php");
echo "<pre>";
print_r($_POST);
echo "</pre>";
$id=$_POST['id'];
//建立變數接收表單傳送過來的資料
$name =$_POST['name'];
$birthday =$_POST['birthday'];
$uni_id =$_POST['uni_id'];
$addr =$_POST['addr'];
$parents =$_POST['parents'];
$tel =$_POST['tel'];
$dept =$_POST['dept'];
$graduate_at =$_POST['graduate_at'];
$status_code =$_POST['status_code'];
$sql_students="UPDATE `students` 
            SET `name`='$name',
                `birthday`='$birthday',
                `uni_id`='$uni_id',
                `addr`='$addr',
                `parents`='$parents',
                `tel`='$tel',
                `dept`='$dept',
                `graduate_at`='$graduate_at',
                `status_code`='$status_code'               
                WHERE `id`='$id'";
//$id=$_POST['id']從add.php >>> edit.php(建立隱藏欄位) >>> this(edit_student.php)

//相關連動的資料表為 `class_student`
//相關欄位
//school_num  學號不做修改 ~~
//class_code  想辦法生出來
//stat_num    考慮到座號重複問題太複雜，先不做修改
//year        固定為2000，不要需修改
//$_POST['class_code']from `classes`

//學員所屬班級在另一張資料class_student
$class_code =$_POST['class_code'];
//建立相關表格------------------------------------------------
//因為`studends`.`school_num`並未傳送過來(當初用計算+1)，
//所以要建立，一旦建立，可以抓`class_student`.`{column}`
$school_num=$pdo->query("SELECT * FROM `students` WHERE `id`='$id'")
            ->fetch(PDO::FETCH_ASSOC);
//上述code，自己解釋 抓取students裡的所有表個，以id為主的那一行欄位
//$id=$_POST['id']從 add.php >>> edit.php(建立隱藏欄位) >>> this(edit_student.php)

//透過可以抓取`students`.`all_columns`，以查詢語法建立以 id 為主的 `class_student`相關資料
//其共同欄位是 `school_num`
$class= $pdo->query("SELECT * FROM `class_student` WHERE `school_num`='{$school_num['school_num']}'")
            ->fetch(PDO::FETCH_ASSOC);
//相關表格建立完成--------------------------------------------

$sql_class_student="UPDATE `class_student` SET `class_code`='$class_code' WHERE `id`='{$class['id']}'";
//$sql_class_student="UPDATE `class_student` SET `class_code`='$class_code' WHERE `school_num`='{$school_num['school_num']}'";
//更新相關資料表`class_student`裡的欄位`class_code`
//$class_code來自 `classes`.`id`
//條件 : 欄位名id = 
//$class['id']解釋為`students`.`school_num`(id帶過來的) 與 `class_student`.`school_num`同個相關連動的那行的`id`
//id 不修改，要改的是 `class_student`.`class_code`
//WHERE `id`='{$class['id']}' 可以改成 WHERE `school_num`='{$school_num['school_num']}'

echo $sql_students;
echo "<br>";
echo $sql_class_student;
echo "<br>";
$res1=$pdo->exec($sql_students);
$res2=$pdo->exec($sql_class_student);
echo "編輯成功 !!";
if($res1 || $res2){
    $edit='edit_success';
}else{
    $edit='edit_fail';
}
echo $edit;
header("location:../admin_center.php?do=edit&id=$id&edit=$edit");

?>