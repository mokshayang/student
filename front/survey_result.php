<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.18/c3.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.20/c3.min.css">
<?php
$subject = find("survey_subject", $_GET['id']);
$options = all("survey_options", ["subject_id" => $_GET['id']]);

// dd($options);
// dd($sum);
// dd($subject);
// dd($options);
//SQL : R $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); 用最多的
//all($table,...$args)//二微陣列 fetchAll(PDO::FETCH_ASSOC);
//型式 : all('students'," where `dept`='2'");//str
//型式 : all('students',['name'=>'宋時雨']); //array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]);//array
//型式 : all('students',['dept'=>1,'graduate_at'=>1]," ORDER BY `id` desc");//array+$args[1]
// $result=[];
// foreach($options as $option){
//     $result[]=['option'=>$option['opt'],'vote'=>$option['vote']];
// }
// $response = json_encode($result);
// echo $response;


?>
<style>
    .total {
        text-align: center;
        font-size: 18px;
        margin-bottom: 10px;
        color: #f20;
        font-weight: bold;
    }

    #chart {
        width: 300px;
        height: 300px;
        margin: auto;
    }
</style>
<h3 class="text-primary text-center"><?= $subject['subject']; ?></h3>
<div id="chart"></div>
<div class="total">目前共 <?= $subject['vote'] ?> 人投票</div>
<ul class="list-group col-10 mx-auto">
    <?php
    foreach ($options as $option) {
        $division = ($subject['vote'] == 0) ? 1 : $subject['vote']; //預防分母為0
        $width = round(($option['vote'] / $division) * 100, 1);
    ?>
        <li class="d-flex list-group-item list-group-item-light list-group-item-action">
            <div class="col-4 voted-result" data-vote="<?= $option['vote'] ?>"><?= $option['opt']; ?></div>
            <div class="col-2"><?= $option['vote']; ?> 人</div>
            <div class="col-5 d-flex align-items-center">
                <div class="col-5 bg-primary rounded" style="width:<?= $width; ?>%">&nbsp;</div>
                <div class="col-1">&nbsp;<?= $width; ?>%</div>
            </div>
        </li>
    <?php
    }
    ?>
</ul>
<div class="text-center mt-4">

    <a href="index.php?do=survey" class="btn btn-warning mx-1">返回</a>
</div>
<style>
/* c3.donut.totle.fontSize */
.c3-chart-arcs-title {
  font-weight: bold;
  font-size: 18px;
  color:#f00;
  }
</style>
<script>
    //拉JSON資料進來
    // axios.get("./api/survey_result_api.php?id=14")
    // .then(res=>{
    //     //成功的話會到這邊,response會存到res變數,將資料去function渲染畫面
    //     c3Chart(res.data);
    // })
    // .catch(error=>{
    //     //如果執行錯誤會到這
    //     console.log(error);
    // });

    //抓DOM
    const columns = document.querySelectorAll(".voted-result")
    let voteData = {};
    columns.forEach((item) => {
        voteData[item.textContent] = item.dataset.vote;
    })
    //套圖表
    c3Chart(voteData);

    function c3Chart(data) {
        // 這裡開始把資料塞到套件
        let chart = c3.generate({
            //綁定要顯示圖表的DOM,binto後的值為css選取器
            bindto: '#chart',
            data: {

                json: data,
                type: 'donut'
            },
            donut: {
                title: "調查結果",
                width: '65',
                padAngle: '.02'
            },
            gauge: {
                units: '<?= $option['vote']; ?>'
            }
        })
    }
</script>