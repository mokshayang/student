<?php include_once("../db/connect.php");

//subject
//建立資料陣列
$subject=['subject'=>$_POST['subject'] ,
          'type'=>1 ,
          'vote'=>0 ,
          'active'=>0 
];
////使用insert 函式，寫入資料
insert('survey_subject',$subject);

//新增加的主題 
//find 屬一維陣列 `subject`=form.name.subject後面+的id 主要是對應 option 的subject_id
//上方的insert('survey_subject',$subject);寫入後 下方的，$subject_id就能找到了
$subject_id=find('survey_subject',['subject'=>$_POST['subject']])['id'];
// dd($subject_id);

//back.survey_add.php.form 將選項的值存入陣列中 : 再傳送過來
//$abc=$_POST['opt']; EX:[0=>aa0,1=>aa1, 2=>aa2, 3=>''];
//dd($abc);
//使用foreach 將值取出  在 SQL : C 到 sruvey_options
//先判斷
if(isset($_POST['opt'])){
    foreach($_POST['opt'] as $option){
        //建立資料陣列
        $tmp=['subject_id'=>$subject_id,//透過主題新增後的id，處理相關資料表
              'opt'=>$option,//子選項的內容
              'vote'=>0//參予人數一開始為0
        ];
        dd($tmp);
        insert('survey_options',$tmp);
    }
}
to("../admin_center.php?do=survey");
?>