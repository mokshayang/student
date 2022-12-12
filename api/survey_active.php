<?php include_once "../db/connect.php";
$subject=find("survey_subject",$_GET['id']);//取的survey.php active 啟用是一維陣列 : 
dd($subject);
$subject['active']=($subject['active']+1)%2;
update('survey_subject',$subject,$_GET['id']);

//SQL : U return $pdo->exec($sql);  WHERE ... (必須)
//最麻煩 三個參數 :
//UPDATE "表格" 參數 $table 
//SET "欄位1" = [值1], "欄位2" = [值2] 參數 $col 必定是array 的形式
//WHERE "條件"; 參數 $args 可以 array 也可以 字串
//給定條件 更新資料 UPDATE table SET `a`='a1' WHERE ... (必須)
//update($table,$col,...$args) $col必定為一為陣列
//型式 : update('students',['name'=>'劉勤永','dept'=>'2','graduate_at'=>'3']);
to("../admin_center.php?do=survey");

?>