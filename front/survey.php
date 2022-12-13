<?php include "./layouts/link_css.php";

if (!empty($_SERVER['HTTP_CLIENT_IP'])) //check ip from share internet
{
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
{
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
?>
<style>
    .selected{
        color: #ccc;
    }
</style>
<h3>調查列表</h3>


<div class="table_list">
    <div class="table_head">
        <div>主題</div>
        <div>參與數</div>
        <div>操作</div>
    </div>
    <?php
    $surveys = all("survey_subject", ['active' => 1]);
    $ip_log = all("survey_log", ['ip' => $ip]);
    // dd($ip_log);
    $tmp=[];
    foreach($ip_log as $val){
        $tmp[]=$val['subject_id'];
    }
    $result_tmp = array_unique($tmp);//重複的value 刪除g
    $result_subject=array_values($result_tmp);//重排key值
    // dd($result);
    // dd($surveys);
    // dd($surveys);
        foreach ($surveys as $key => $survey) {
            if (in_array($survey['id'],$result_subject)) {
    ?>
                <div class="items selected">
                    <div><?= $survey['subject'] ?></div>
                    <div>已投過 !!</div>
                    <div>
                       
                        <a href="index.php?do=survey_result&id=<?= $survey['id']; ?>" class="btn btn-sm btn-outline-secondary mx-1">看結果</a>

                    </div>
                </div>
            <?php
            } else {                
            ?>
            <div class="items">
                    <div><?= $survey['subject'] ?></div>
                    <div><?= $survey['vote'] ?></div>
                    <div>
                        <a href="./index.php?do=survey_item&id=<?= $survey['id'] ?>" class="btn btn-sm btn-success mx-1 ">投票</a>
                        <a href="index.php?do=survey_result&id=<?= $survey['id']; ?>" class="btn btn-sm btn-outline-success mx-1">結果</a>

                    </div>
                </div>
    <?php
            }
        }
    

    ?>
</div>