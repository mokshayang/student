<style>
    .group ,.list{
        width: 68%;
        margin: auto;
        display: grid;
        grid-template-columns: 8fr 2fr;
        align-items: center;
    }
    .group{
        justify-items: center;
        font-size: 24px;
        background-color: #33e;
        height: 48px;
        color: #eee;
        border-radius: 15px 15px 0 0;
    }
    .list{
        grid-auto-rows: 40px;
        font-size: 20px;
    }
    .list:nth-child(2n+1){
        background-color: #f5f5ff;
    }
    li div:nth-child(1){
        padding-left:20px ;
        color: #f00;
        text-shadow: 1px 1px 1px #f00;
    }
    li div:nth-child(2){
        justify-self:center;
    }
    li a{
        color: #00e;
        text-decoration: none;
    }
    li a:hover{
        color: #f00;
        
    }
    h1{
        margin-bottom: 10px;
    }
</style>
<h1>最新消息</h1>
<ul>
<li class="group">
    <div class="subject">標 題</div>
    <div class="people">人 氣</div>
</li>

<?php
$all_news="SELECT * FROM `news` ORDER BY `top` DESC, `readed` DESC";
$rows=$pdo->query($all_news)->fetchALL(PDO::FETCH_ASSOC);
// echo "<pre>";
// print_r($rows[0]);
// echo "</pre>";
//點閱數量查詢的正排序 :
$hot=$pdo->query("SELECT `id` FROM `news` ORDER BY `readed` DESC")->fetchColumn();

foreach($rows as $row){
    echo "<li class='list'>";
        echo "<div class='title'>";
            echo ($row['top']==1)?"TOP&nbsp;&nbsp;":'';
            echo ($row['id']==$hot)?"HOT&nbsp;&nbsp;":'';
            echo "<a href='./api/news_pop.php?id={$row['id']}'>";
            echo $row['subject'];
            echo "</a>";
        echo "</div>";
        echo "<div>";
            echo $row['readed'];
        echo "</div>";
    echo "</li>";
//     echo "<pre>";
// print_r($row);
// echo "</pre>";
}

?>
</ul>