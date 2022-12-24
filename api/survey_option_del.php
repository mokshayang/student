<?php include_once("../db/connect.php");
// echo $_GET['id'];
$subject_id=find("survey_options",$_GET['id'])['subject_id'];
// dd($subject_id);
del("survey_options",$_GET['id']);
to("../admin_center.php?do=survey_edit&id=$subject_id");

?>