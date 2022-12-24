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
<h3>編輯調查 <button id="optionAdd" class="btn btn-outline-success btn-sm add">+</button></h3>

<form action="./api/survey_edit.php" method="post" class="col-5 mx-auto  flex-wrap justify-content-center">
    <div class="input-group mb-3">
        <label class=" input-group-text ">&nbsp; 主題 : &nbsp; </label>
        <input type="text" name="subject" value="<?= $subject['subject'] ?>" class="form-control ">
        <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">

    </div>
    <div>
        <!-- 選項區 -->
        <?php
        foreach ($options as $idx => $option) {
        ?>
            <div class="input-group mb-3 col-10" id="options">
                <label class=" input-group-text ">項目 : <?= $idx + 1; ?>&nbsp; </label>
                <input type="text" name="opt[]" value="<?= $option['opt'] ?>" class="form-control ">
                <a href="./api/survey.option_del.php?id=<?= $option['id'] ?>" class="btn btn-outline-success" role="button" style='border-radius:4px;'>-</a>
                <input type="hidden" name="opt_id[]" value="<?= $option['id'] ?>">
            </div>
        <?php
        }
        ?>
    </div>
    <div class="text-center col-12 mt-3">
        <input class="btn btn-warning mx-1" type="reset" value="重置">
        <input class="btn btn-primary mx-1" type="submit" value="修改">
    </div>
</form>
<div id="d1" class="ca">
    <div id="dd1" class="cc1">1</div>
    <div id="dd2" class="cc2">2</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(function() {
        const optionAdd = $('#optionAdd');//button
        console.log(optionAdd);
        optionAdd.click(function() {
            const options = $('#options');//div optionsArea
            const div = "<div class='input-group mb-3 col-10 addDiv' >";//addDiv
            const addDiv = $('.addDiv');
            // console.log(addDiv.length);
            //test :
            const test = $('label');
            console.log(addDiv.length);

            // console.log(addDiv.length);
            const labelTheme = "<label class='input-group-text'>項目 : 2</label>";
            const input = "<input type='text' name='opt[]' class='form-control '>";
           
            options.parent().append(div).addDiv.append(labelTheme,input);
            
            
            // console.log(options.parent());
            // addDiv.append(labelTheme,input);
           
            








        })
      



    })
</script>