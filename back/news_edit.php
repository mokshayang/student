<?php

$news=$pdo->query("SELECT * FROM `news` WHERE `id`='{$_GET['id']}'")->fetch();

?>
<style>
    .serch{
       width: 100%;
       height: 60px;
       display: grid;
       grid-template-columns: repeat(3,1fr) 4fr;
       align-items: center;
       justify-items: center;
    }
</style>
<h2 class="text-center">編輯消息</h2>
<main class="container">
<form action="./api/news_edit.php" method="POST">
   <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">主題</label>
        <input  type="text" 
               class="form-control col-md-10" 
                name="subject" 
               value='<?=$news['subject'];?>'>
   </div>
   <div class="d-flex">
    <div  class="serch">
        <span >置頂</span>
        <div >
            <input  type="radio" name="top" value='1' <?=($news['top']==1)?'checked':'';?>>
            <label class="col-form-label">Yes</label>
        </div>
        <div >
            <input  type="radio" name="top" value='0' <?=($news['top']==0)?'checked':'';?>>
            <label class="col-form-label">No</label>
        </div>
        <div >
            <label >觀看數
            <input  type="number" name="readed" style="width:72px;" value="<?=$news['readed'];?>">
            </label>
        </div>
    </div>
   </div>
   <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">內容</label>
        <textarea class="form-control col-md-10" 
                  name="content" 
                  style="height:400px"><?=$news['content'];?></textarea>
   </div> 
   <div class="form-group row">
        <label class="col-form-label col-md-2 text-right">類別</label>
        <input type="text" 
              class="form-control col-md-10" 
               name="type" 
               value="<?=$news['type'];?>">
   </div>
   <div class="text-right text-secondary" style="margin:20px;text-align:right;">現在時間:<?=date("Y-m-d H:i:s");?></div>
   <div class="text-center">
        <input type="hidden" name="id" value="<?=$news['id'];?>">
        <input class="btn btn-primary mx-2" type="submit" value="確定修改">
        <input class="btn btn-warning mx-2" type="reset" value="重置">
   </div> 
</form>
</main>