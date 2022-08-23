<?php

//подключение базы данных
include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");
include("prepodFunction.php");

    $action = $_POST['action'];

    if($action == 'logout_prepod') {
        logout_prepod();
    }
    if($action == 'arrayTest') {
        arrayTest($conn);
    }

    

    //Функция выхода с сессии
    function logout_prepod() {
        session_start();
        $_SESSION = array();

        session_destroy();

        echo "1";
    }




    




/////////////////////////////////


