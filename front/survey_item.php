<style>
    h3 .subject_add {
        margin-left: 20px;
        border-radius: 8px;
        height: 36px;
        width: 36px;
        line-height: 28px;
        background-color: #44992280;
        border: none;
        color: #fff;
    }
    h3 .subject_add:hover{
        background-color: #44992298;
    }
    form {
        width: 68%;
        margin: 32px auto;
    }
    form .subject{
        margin: auto;
    }
    form .options{
       margin: auto;   
    }
    form .option , form .subject{
        display: grid;
        grid-auto-rows: 48px;
        justify-items: center;
    }
    .ss {
        padding: 5px;
        border-radius: 5px;
        outline: 1px solid #fff;
        border: 1px solid pink;
        width: 480px;
    }
    label input:hover {
        border: 3px solid #bbf;
        border-radius: 6px;
    }
    .cc{   
        color:#33f;
        font-weight: bold;
    }
    @media only screen and (max-width: 780px) {
        form{width:90%;}
        .ss {
            width: 360px;
        }
    }
</style>
<h3>新增調查<button onclick="addOption()" class="subject_add" title="增加選項">+</button></h3>
<form action="./api/survey_add.php" method="post">
    <div class="subject">
        <label class="cc" style="margin-bottom: 12px;"> 主題 &nbsp;
            <input type="text" name="subject" required class="ss">
        </label>
    </div>
    <!-- 選項區 -->
    <div id="options">
        <div class="option">
            <label class="cc">選項1
                <input type="text" name="opt[]" required class="ss">
            </label>
        </div>
    </div>

    <div class="text-center col-12 mt-3">
        <input class="btn btn-warning mx-1" type="reset" value="重置">
        <input class="btn btn-primary mx-1" type="submit" value="確定新增">
    </div>
    
</form>
<script>
    function addOption() {
        let options = document.getElementById('options');
        let num = document.getElementsByClassName('option').length + 1
        // console.log(mun);
        /*     
        let opt=`<div class="option form-group row col-12">
                    <label class="col-2 text-right">項目${num}</label>
                    <input type="text" name="opt[]" class="form-control col-10">
                </div>` 
        */
        //createElement DOM 節點的新增
        //透過 appendChild()、insertBefore() 或 replaceChild()
        //將新元素加入至指定的位置之後才會顯示
        let opt = document.createElement("div");
        let label = document.createElement("label");
        let input = document.createElement('input');
        let numNode = document.createTextNode("選項" + num + " ");
        // console.log(numNode);
        //setAttribute :第一個參數是你要修改的屬性名稱，第二個是要改成的內容
        //xx.setAttribute('href','www.google.com');

        opt.setAttribute("class", "option") 
        //設定 opt 的 class 屬定 這邊一定要加 不然數字不會增加
        //因為num 是抓取 class:option 的數量來算的

        input.setAttribute("class", "ss")
        label.setAttribute("class", "cc");
        // opt.setAttribute("class", "option form-group row col-12")
        input.setAttribute("name", "opt[]");
        input.setAttribute("type", "text");
        //appendChild :
        label.appendChild(numNode);
        opt.appendChild(label);
        label.appendChild(input);

        options.appendChild(opt);
        //options.innerHTML=options.innerHTML+opt
        //console.log(options.innerHTML)
    }
    
</script>