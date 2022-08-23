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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT']."/role/prepod/link-prepod/link-prepod-css.php"); ?>
    <title>Сайт Преподователя</title>
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

          
        </div>
    </div>
</div>

</body>
<?php include($_SERVER['DOCUMENT_ROOT']."/role/prepod/link-prepod/link-prepod-js.php"); ?>
</html>



<!--<div id="1" class="div_create_vopros div_create_vopros_1">
                    <div class="div_create_vopros_header">
                        <span id="id_span_1" class="div_create_vopros_header_span id_span_1">Вопрос №1</span>
                        <input id="id_input_1" name="name_vopros_1" placeholder="Введите Вопрос" type="text" class="form-control menu_prepod_2_header_input class_input_1">
                        <select data-vopros="1" data-sel-nomer-vopros="create_vopros_1" id="select_type_1" class="btn btn-info menu_prepod_2_header_button2 change_sel_create_vopros select_type_1">
                            <option disabled selected value="">Тип Ответа</option>
                            <option value="test">Тест</option>
                            <option value="stroka">Строка</option>
                        </select>
                        <button data-nomer="1" id="button_del_2" type="button" class="btn btn-danger del_vopros but_del_vopros button_del_1">Удалить вопрос</button>
                    </div>
            
                    <div id="create_vopros_1" class="div_create_vopros_body create_vopros_1">

                        <input id="id_input_hidden_type_1" type="hidden" value="stroka" name="type_vopros_1" class="id_input_hidden_type_1">
                        <input id="stroka_otvet_1" name="otvet_1" placeholder="Введите Ответ" type=text class="form-control menu_prepod_2_header_input stroka_otvet_1">

                    </div>
                </div>


                <div id="2" class="div_create_vopros div_create_vopros_2">
                    <div class="div_create_vopros_header">
                        <span id="id_span_2" class="div_create_vopros_header_span id_span_2">Вопрос №2</span>
                        <input id="id_input_2" name="name_vopros_2" placeholder="Введите Вопрос" type="text" class="form-control menu_prepod_2_header_input class_input_2">
                        <select data-vopros="2" data-sel-nomer-vopros="create_vopros_2" id="select_type_2" class="btn btn-info menu_prepod_2_header_button2 change_sel_create_vopros select_type_2">
                            <option disabled selected value="">Тип Ответа</option>
                            <option value="test">Тест</option>
                            <option value="stroka">Строка</option>
                        </select>
                        <button data-nomer="2" id="button_del_2" type="button" class="btn btn-danger del_vopros but_del_vopros button_del_2">Удалить вопрос</button>
                    </div>
            
                    <div id="create_vopros_2" class="div_create_vopros_body create_vopros_2">
                        <input id="id_input_hidden_type_2" type="hidden" value="stroka" name="type_vopros_2" class="id_input_hidden_type_2">
                        <input id="stroka_otvet_2" name="otvet_2" placeholder="Введите Ответ" type=text class="form-control menu_prepod_2_header_input stroka_otvet_2">
                    </div>
                </div>


                <div id="3" class="div_create_vopros div_create_vopros_3">
                    <div class="div_create_vopros_header">
                        <span id="id_span_3" class="div_create_vopros_header_span id_span_3">Вопрос №3</span>
                        <input id="id_input_3" name="name_vopros_3" placeholder="Введите Вопрос" type="text" class="form-control menu_prepod_2_header_input class_input_3">
                        <select data-vopros="3" data-sel-nomer-vopros="create_vopros_3" id="select_type_3" class="btn btn-info menu_prepod_2_header_button2 change_sel_create_vopros select_type_3">
                            <option disabled selected value="">Тип Ответа</option>
                            <option value="test">Тест</option>
                            <option value="stroka">Строка</option>
                        </select>
                        <button data-nomer="3" id="button_del_3" type="button" class="btn btn-danger del_vopros but_del_vopros button_del_3">Удалить вопрос</button>
                    </div>
            
                    <div id="create_vopros_3" class="div_create_vopros_body create_vopros_3">
                        <div>
                            <input id="id_input_hidden_type_3" type="hidden" value="test" name="type_vopros_3" class="id_input_hidden_type_3">

                            <input id="radio_but_1_3" type="radio" name="radio_but_3" value="1" class="radio_but_1_3">
                            <input id="input_test_1_3" name="input_test_1_3" placeholder="Ответ" class="radio_input input_test_1_3" type="text">

                            <input id="radio_but_2_3" type="radio" name="radio_but_3" value="2" class="radio_but_2_3">
                            <input id="input_test_2_3" name="input_test_2_3" placeholder="Ответ" class="radio_input input_test_2_3" type="text">

                            <input id="radio_but_3_3" type="radio" name="radio_but_3" value="3" class="radio_but_3_3">
                            <input id="input_test_3_3" name="input_test_3_3" placeholder="Ответ" class="radio_input input_test_3_3" type="text">

                            <input id="radio_but_4_3" type="radio" name="radio_but_3" value="4" class="radio_but_4_3">
                            <input id="input_test_4_3" name="input_test_4_3" placeholder="Ответ" class="radio_input input_test_4_3" type="text">
                        </div>
                    </div>
                </div>-->