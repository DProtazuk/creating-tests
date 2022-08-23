<?php 

    include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");

    session_start();
    $id_action = $_SESSION['action'];
    
    //создание счетчика на количество вопросов
    $_SESSION['nums_create_voprosov'] = "0";

    //Проверка пустотыт Сессии
    if(!isset($id_action)){
        header("Location: ../../../../index.php");
    }
    else {

        //Проверка актуальности айдишки
        $sql_auth_proverka = "SELECT * FROM `users` WHERE `id_users` = '$id_action'";
        $result = mysqli_query($conn, $sql_auth_proverka);
        $result = mysqli_fetch_array($result);

        if(!isset($result)) {
            header("Location: ../index.php");
        }
        else {
            if($result['role'] == "admin"){
                header("Location: ../../../../index.php");
            }
            else if($result['role'] == "prepod"){
            }
            else {
                header("Location: ../../../../index.php");
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT']."/role/prepod/link-prepod/link-prepod-css.php"); ?>
    <title>Сайт Преподователя/menu1</title>
</head>
<body>

<div class="div_prepod_container">
    <div class="prepod_header">
        <div class="prepod_header_text">
        <?php   
            $sel_predmet = mysqli_query($conn, "SELECT predmet.name_predmet, predmet.id_predmet, prepod.surname, prepod.name, prepod.patronymic FROM `prepod` INNER JOIN `predmet` ON prepod.id_predmet = predmet.id_predmet WHERE id_users = '$id_action'");
            $array_table = mysqli_fetch_array($sel_predmet);
        ?>
            <span class="prepod_header_text_span">
                Добро пожаловать: <?php echo $array_table[2]." ".$array_table[3]." ".$array_table[4]."<br>Предмет: ".$array_table[0]?>
            </span>
            
        </div>

        <div class="prepod_header_but_exit">
            <button id="link_glaw" class="prepod_header_but_exit_buts btn btn-danger">на главную</button>
            <button id="but_logout_prepod" class="prepod_header_but_exit_buts btn btn-danger">выйти из системы</button>
        </div>
    </div>

    <div class="div_prepod_container_mini">
        <div class="container_menu">
            <div id="but_menu1" class="div_menu">
                <span class="div_menu_span">Список контрольных</span>
            </div>

            <div id="but_menu2" class="div_menu">
                <span class="div_menu_span">Создать контрольную</span>
            </div>

            <div id="but_menu3" class="div_menu">
                <span class="div_menu_span">Статистика</span>
            </div>
        </div>

        <div class="div_action_prepod">

            <div id="menu_prepod_1" class="did_action_prepod_mini">
               <div class="menu_prepod_1_header">

                        <?php $sqlTest = mysqli_query($conn, "SELECT * FROM `test` WHERE `id_predmet`='$array_table[1]'");?>

                        <select name="" id="select_update_test" class="btn btn-info select_update_test">
                            <option disabled selected value="">Выберите тестувую работу</option>
                            <?php 
                            while($arrayTest = mysqli_fetch_array($sqlTest)){
                                echo "<option value={$arrayTest['link']}>{$arrayTest['name_test']}</option>";
                            }
                            ?>
                            
                        </select>
    <!---->
                        <button id="but_create_test" class="menu_prepod_2_header_button btn btn-primary display_button" type="button">Добавить вопрос</button>
                        <button form="form_array_vopros" type="submit" id="but_create_tes" class="menu_prepod_2_header_button btn btn-primary display_button" >Сохранить Тест</button>
                        <button id="but_del_test" class="btn btn-primary menu_prepod_2_header_button display_button">Удалить Тест</button>
                </div>

                <div class="action_red_test">

                <!--форма отправки-->
                <form id="form_array_vopros" action="script-php/script_create_test.php" method="post">

                        <div class="div_redact_name_test">
                            <!--скрытый инпут изменяемого теста-->
                            <input name="id_test" value="" type="hidden" id="input_hidden_testId">
                            <!--id актуального предмета предмета-->
                            <input name="id_predmet" type="hidden" value="<?php echo $array_table[1] ?>">

                            <!--колличество вопросов в тесте-->
                            <input name="num_vopros" type="hidden" id="num_vopros" value="">

                            <span class="span_red_name_test">Название Теста:</span>
                            <input name="name_new_test" type="text" class="form-control input_red_name_test">
                        </div>

                        <div class="action_red_test_mini">
                            <!--блок куда вписывать блоки вопросов-->
                            <div class="menu_prepod_2_content">
                </form>


                            </div>
                        </div>
                </div>
               


            </div>
        </div>

    </div>
</div>
<style>
    #but_menu1 {
        background-color: aliceblue; 
    }
</style>
</body>
<?php include($_SERVER['DOCUMENT_ROOT']."/role/prepod/link-prepod/link-prepod-js.php"); ?>
</html> 