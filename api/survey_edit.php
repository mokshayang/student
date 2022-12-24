<?php include_once("../db/connect.php");
dd($_POST['subject']);//主題
dd($_POST['subject_id']);//選項
//1. 主題更新
// update("survey_subject",['subject'=>$_POST['subject']],$_POST['subject_id']);
dd($_POST['opt']);//資料表survey_options現有的內容 opt[]
dd($_POST['opt_id']);//資料表survey_options現有的id opt_id[]
foreach ($_POST['opt_id'] as $key => $value) {
    $option=find("survey_options",$value);
    // dd($option);
    echo "<div> 原本的選項 $value 資料 =>".$option['opt']."</div>";
    echo "<div> 表單傳送的 $value 資料 =>".$_POST['opt'][$key]."</div>";
    //2. 現有內容更新，就是資料表已有的內容
    update("survey_options",['opt'=>$_POST['opt'][$key]],$value);
}
    
    //3. 新增項目的insert into
    if(isset($_POST['optn'])){
        dd($_POST['optn']);
        foreach ($_POST['optn'] as $key => $value) {
            if($value != ''){
                $tmp=['opt'=>$value,
                      'subject_id'=>$_POST['subject_id'],//survey_edit.php survey_subject.id == survey_options.subject_id
                      'vote'=>0];
                    //   dd($tmp);
                insert("survey_options",$tmp);
            }
        }
    }

    to("../admin_center.php?do=survey");
?>