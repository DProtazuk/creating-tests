<?php

    include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");

    $test = $_GET['name_test'];

    $testInfo = mysqli_fetch_array(mysqli_query($conn,"SELECT test.name_test, test.num_rows, predmet.name_predmet, prepod.surname, prepod.name, prepod.patronymic, test.link FROM test INNER JOIN predmet ON test.id_predmet = predmet.id_predmet INNER JOIN prepod ON predmet.id_prepod = prepod.id_prepod WHERE `name_test` = '$test'"));

    if(!$testInfo) {
        echo 'Данного теста не существует!';
        exit();
    }
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT']."/script-php/link-css.php"); ?>
    <link href="timeTo.css" type="text/css" rel="stylesheet"/>
    <title>Страница Тесты</title>
</head>
<body>

    <div class="testHeader">
        <div class="testInfo">
            <!--ипут для ссылки на создание массива теста-->
            <input type="hidden" id="link_test" name="link_test" value="<?php echo $testInfo[6]?>">
            <!--инпут для хранения колличества вопросов-->
            <input type="hidden" id="num_voprosov" name="num_voprosov" value="<?php echo $testInfo[1]?>">
            
            <input type="hidden" id="name_predmet" value="<?php echo $testInfo[2]?>">
            <input type="hidden" id="name_test" value="<?php echo $testInfo[0]?>">

            <span class="testInfo_span">Предмет: <?php echo $testInfo[2]?></span>
            <span class="testInfo_span">Преподователь: <?php echo $testInfo[3]." ".$testInfo[4]." ".$testInfo[5]?></span>
            <span class="testInfo_span">Название: <?php echo $testInfo[0]?> - вопросов: <?php echo $testInfo[1]?></span>
        </div>

        <div class="studInfo">
            <div class="studInfo_mini">
                <input id="input1" placeholder="Фамилия" class="studInfo_input" type="text">
                <input id="input2" placeholder="Имя" class="studInfo_input" type="text">
                <input id="input3" placeholder="Отчество" class="studInfo_input" type="text">
            </div>

            <div class="studInfo_mini">
                <input id="input4" placeholder="Институт" class="studInfo_input" type="text">
                <input id="input5" placeholder="Специальность" class="studInfo_input" type="text">
                <input id="input6" placeholder="Курс" class="studInfo_input" type="text">
            </div>
        </div>
        
        <div class="testConst">
            <div id="countdown-1" class="divTime"></div>

            <div class="testConst_but">
                <button class="btn btn-danger startTest" id="startTest">Начать</button>
                <button class="btn btn-danger finishTest" id="finishTest">Закончить</button>
            </div>
            
        </div>   
        
    </div>


    <div class="testAction">
    
        <!--Скрытый инпут для хранения уже подтвержденных вопросов-->    
        <input id="good_vopros" type="hidden" name="" value="[1]">

        <div class="select_but_vopros">
            <?php 
                for($i=1; $i<=$testInfo[1]; $i++) {
                    echo "<div id=click_but_{$i} data-active=true data-but-vopros={$i} class=sel_mini>
                            <span class=sel_mini_span>{$i}</span>
                        </div>";
                } 
            ?>
        </div>



    </div>

</body>
<?php include($_SERVER['DOCUMENT_ROOT']."/script-php/link-js.php"); ?>
<script src="jquery.time-to.js"></script>
<script src="test.js"></script>
</html>

