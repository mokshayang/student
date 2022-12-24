<?php
if (isset($_GET['id'])) {
    $subject = find('survey_subject', $_GET['id']);
    $options = all('survey_options', ['subject_id' => $_GET['id']]);
} else {
    to("./admin_center.php?do=survey&error=請指定項目編輯");
}

?>
<style>
    .add {
        font-size: 18px;
        margin-bottom: 4px;
    }

    form {
        width: 68%;
        margin: 32px auto;
    }

    /* .min a {
        display: block;
        border-radius: 10px;
    } */
</style>
<h3>編輯調查 <button id="optionAdd" class="btn btn-outline-success btn-sm add" data-toggle="tooltip" data-placement="top" title="增加選項">+</button></h3>

<form action="./api/survey_edit.php" method="post" class="col-5 mx-auto  flex-wrap justify-content-center">
    <div class="input-group mb-3">
        <label class=" input-group-text ">&nbsp; 主 題 : &nbsp; </label>
        <input type="text" name="subject" value="<?= $subject['subject'] ?>" class="form-control ">
        <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
    </div>
    <div>
        <!-- 選項區 -->
        <?php
        foreach ($options as $idx => $option) {
            if($idx==0){
        ?>
            <div class="input-group mb-3 col-10" id="options">
                <label class=" input-group-text ">選項 :&nbsp;<span><?= $idx + 1; ?></span></label>
                <!-- 將選項內容裝入array->opt[] -->
                <input type="text" name="opt[]" value="<?= $option['opt'] ?>" class="form-control ">
                <a href="#" class="btn btn-primary" role="button" style='border-radius:4px;'>-</a>
                <!-- 將survey_options id 內容裝入array->opt_id[] -->
                <input type="hidden" name="opt_id[]" value="<?= $option['id'] ?>">
            </div>
            <?php }else{ ?>
                <div class="input-group mb-3 col-10" id="options">
                <label class=" input-group-text ">選項 :&nbsp;<span><?= $idx + 1; ?></span></label>
                <!-- 將選項內容裝入array->opt[] -->
                <input type="text" name="opt[]" value="<?= $option['opt'] ?>" class="form-control ">
                <a href="./api/survey_option_del.php?id=<?= $option['id'] ?>" class="btn btn-outline-secondary" role="button" style='border-radius:4px;'>-</a>
                <!-- 將survey_options id 內容裝入array->opt_id[] -->
                <input type="hidden" name="opt_id[]" value="<?= $option['id'] ?>">
            </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="text-center col-12 mt-3">
        <input class="btn btn-warning mx-1" type="reset" value="重置">
        <input class="btn btn-primary mx-1" type="submit" value="修改">
    </div>
</form>


<?php include "./layouts/scripts.php";?>
<script>
    //  $('[data-toggle="tooltip"]').tooltip();

    $(function() {
        const optionAdd = $('#optionAdd'); //button
        optionAdd.on('click',function() {
            const options = $('#options'); //div optionsArea
            const addDiv = $('.addDiv'); //count options number
            const num= $('label').length;
            console.log(num);
            const div = "<div class='input-group mb-3 col-10 addDiv'><label class='input-group-text'>選項 :&nbsp;<span>" + (num) + "</span></label><input type='text' name='optn[]' class='form-control '><div class='remove btn btn-outline-warning' role='button'>-</div></div>"; //addDiv Html
            options.parent().append(div);
            $('.remove').on('click',function() {
                $(this).parent().remove();
                $('span').each(function(e) {
                    $('span').eq(e).text(e +1 );
                })
                // console.log($('span').eq(0));
            })
        })

    })
</script>