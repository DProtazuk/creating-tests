<?php 

include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");

session_start();
$id_action = $_SESSION['action'];

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
            header("Location: ../../../../index.php");
        }
        else {
            if($result['role'] == "admin"){

            }
            else if($result['role'] == "prepod"){
                header("Location: ../../../../index.php");
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
    <?php include($_SERVER['DOCUMENT_ROOT']."/role/admin/link-admin/link-admin-css.php"); ?>
    <title>Сайт Админа</title>
</head>
<body>
		<!--<input type="text" class="form-control" id="input-password">
	    <button type="button" id="input-generate" class="btn btn-primary">Сгенерировать</button>-->

    <div class="action_admin">
        <div class="action_admin_menu">
            <div id="admin_menu_1" class="action_admin_menu_punkt">
                <span class="action_admin_menu_punkt_span">red prepod</span>
            </div>

            <div id="admin_menu_2" class="action_admin_menu_punkt">
                <span class="action_admin_menu_punkt_span">statistic</span>
            </div>

            <div id="admin_menu_3" class="action_admin_menu_punkt">
                <span class="action_admin_menu_punkt_span">red content</span>
            </div>

            <div id="admin_menu_exit" class="action_admin_menu_punkt admin_menu_exit">
                <button id="spavn_index" class="but_exit">На главную</button>
                <button id="but_admin_logaut" class="but_exit">Выйти из системы</button>
            </div>
        </div>

        <div class="action_admin_content">
            <div id="div_action_admin_1" class="div_action_admin">

                <div class="action_prepmet">

                    <div class="div_new_predmet">
                        <input type="text" class="input_new_predmet">
                        <button class="button_new_predmet">Добавить предмет</button>
                    </div>

                    <div class="div_select_predmet">

                        <?php 
                            $query_sel_predmet = mysqli_query($conn, "SELECT*FROM `predmet`");
                            while($array_sel_predmet = mysqli_fetch_array($query_sel_predmet)){
                                echo "<div id=id_predmet_{$array_sel_predmet['id_predmet']}  class=colom_predmet>
                                <span>Наименование: {$array_sel_predmet['name_predmet']}</span>
                                <button data-name_predmet={$array_sel_predmet['name_predmet']} data-predmet={$array_sel_predmet['id_predmet']} class=upt_predmet>Update</button>
                                <button data-predmet={$array_sel_predmet['id_predmet']} class=del_predmet>Delete</button>
                            </div>";
                            };
                            
                        ?>
                                                
                    </div>

                    

                    
                </div>

                <div class="div_action_prepod">
                            
                    <div class="div_new_prepod">
                        <input id="new_login" placeholder="логин" type="text" class="div_new_prepod_input">
                        <input id="new_pass" placeholder="пароль" type="text" class="div_new_prepod_input">
                        <input id="new_surname" placeholder="Фамилия" type="text" class="div_new_prepod_input">
                        <input id="new_name" placeholder="Имя" type="text" class="div_new_prepod_input">
                        <input id="new_patronymic" placeholder="Отчество" type="text" class="div_new_prepod_input">
                        <select name="" id="select_option_prepod"class="div_new_prepod_input">
                            <option selected disabled value="">Предмет</option>
                            <?php 
                                $sel_predmet = mysqli_query($conn, "SELECT*FROM `predmet` WHERE `active` = '0'");
                                while($array_predmet = mysqli_fetch_array($sel_predmet)){
                                    echo "<option value={$array_predmet['id_predmet']}>{$array_predmet['name_predmet']}</option>";
                                }
                            ?>
                        </select>
                        <button id="button_new_prepod" class="div_new_prepod_button">New Prepod</button>
                    </div>


                    <div class="div_select_prepod">
                        <?php 
                        
                            $sel_predmet = mysqli_query($conn, "SELECT predmet.name_predmet, prepod.surname, prepod.name, prepod.patronymic FROM `prepod` INNER JOIN `predmet` ON prepod.id_predmet = predmet.id_predmet");
                            while($array_table = mysqli_fetch_array($sel_predmet)){
                                echo "<div class=div_prepod_select>
                                <span class=div_prepod_select_span>{$array_table[1]}</span>
                                <span class=div_prepod_select_span>{$array_table[2]}</span>
                                <span class=div_prepod_select_span>{$array_table[3]}</span>
                                <span class=div_prepod_select_span>{$array_table[0]}</span>
                            </div>";
                            }
                        ?>
                    </div>

                </div>

            </div>

            <div id="div_action_admin_2" class="div_action_admin">
                            
        

            </div>

            <div id="div_action_admin_3" class="div_action_admin">
                
                <?php 
                    $result_content = mysqli_query($conn, "SELECT * FROM `content` WHERE `id` = '1'");
                    $array_content = mysqli_fetch_array($result_content);
                    $img = $_SERVER['DOCUMENT_ROOT']."/src/".$array_content['img_content'];
                    echo $_SERVER['DOCUMENT_ROOT']."/src/{$array_content['img_content']}";
                ?>

                <textarea class="div_js_redaktor" id="summernote">
                    <?php echo $array_content['text_content']; ?>
                </textarea>

                <button id="btn_js_redaktor" class="btn btn-danger btn_redaktor">Отправить</button>

                <div class="div_redak_glaw_img">
                        <div class="js_file_input_left">
                            <input class="js_file_input" type="file" id="js-file">
                            <button id="but_down_doc">Down</button>
                            <div id="result">
                                <!-- Результат из upload.php -->
                            </div>
                            <?php $path = $_SERVER['DOCUMENT_ROOT']."/src/";
                                echo $path;
                            ?>
                        </div>

                        <div class="js_file_input_right">
                            <?php echo "<img class=js_file_input_left_img src=../../../../../src/{$array_content['img_content']} class=div_action_img_img>"; ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include($_SERVER['DOCUMENT_ROOT']."/role/admin/link-admin/link-admin-js.php"); ?>
</html>