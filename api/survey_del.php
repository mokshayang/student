<?php include_once("../db/connect.php");
//調查主題的id
$id=$_GET['id'];
//關聯的選項的id
// $options=all("survey_options",['subject_id'=>$id]);
// dd($options);

del("survey_subject",$id);
del("survey_options",['subject_id'=>$id]);

to("../admin_center.php?do=survey");
?>