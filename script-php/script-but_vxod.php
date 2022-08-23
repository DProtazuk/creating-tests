<?php 

    session_start();
    $id_action = $_SESSION['action'];
        
    //Проверка пустотыт Сессии
    if(!isset($id_action)){
        echo "<button class=header_vxod_buts data-bs-toggle=modal data-bs-target=#exampleModal>Войти</button>";
    }
    else {
        //Проверка актуальности айдишки
        $sql_session_proverka = "SELECT * FROM `users` WHERE `id_users` = '$id_action'";
        $result_session = mysqli_query($conn, $sql_session_proverka);
        $result_session = mysqli_fetch_array($result_session);
        
        if(!isset($result_session)) {
            echo "<button class=header_vxod_buts data-bs-toggle=modal data-bs-target=#exampleModal>Войти</button>";
        }            
        else {
            if($result_session['role'] == "admin"){
                echo "<button id=button_logout_admin class=header_vxod_buts>Админ</button>";
            }
            else if($result_session['role'] == "prepod"){
                echo "<button id=button_logout_prepod class=header_vxod_buts>Prepod</button>";
            }
            else {
                echo "<button class=header_vxod_buts data-bs-toggle=modal data-bs-target=#exampleModal>Войти</button>";
            }
        }
    } 
?>