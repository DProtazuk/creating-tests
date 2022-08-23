<?php 

//подключение базы данных
include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");

    $action = $_POST['action'];

    if($action == 'del_user') {
        del_user();
    }
    if($action == 'update_predmet') {
        update_predmet($conn);
    }
    if($action == 'proverka_del_predmet') {
        proverka_del_predmet($conn);
    }
    if($action == 'new_predmet') {
        new_predmet($conn);
    }
    if($action == 'del_tochno_predmet') {
        del_tochno_predmet($conn);
    }
    if($action == 'new_prepod') {
        new_prepod($conn);
    }
    if($action == 'red_content') {
        red_content($conn);
    }
  
    

    //Функция выхода с сессии
    function del_user() {
        session_start();
        $_SESSION = array();

        session_destroy();

        echo "1";
    }


    //функция Update преподователя
    function update_predmet($conn) {
        $id_predmet = $_POST['id_predmet'];
        $input_upt_predmet = $_POST['input_upt_predmet'];
        $sql_upt_predmet = "UPDATE `predmet` SET `name_predmet` = '$input_upt_predmet' WHERE `id_predmet` = '$id_predmet'";
        $queru_upt_predmet = mysqli_query($conn, $sql_upt_predmet);
        echo $input_upt_predmet;
    }


    //функция проверки привязки предмета к преподователю перед удалением
    function proverka_del_predmet($conn) {
        $id_predmet = $_POST['id_predmet'];
        $sql_predmet = "SELECT * FROM `predmet` WHERE `id_predmet` = '$id_predmet'";
        $array_predmet = mysqli_fetch_array(mysqli_query($conn, $sql_predmet));

        if($array_predmet['active'] == "1") {
            echo "У предмета есть преподователь, вы уверены что хотите удалить обоих?";
        }
        else {
            mysqli_query($conn, "DELETE FROM `predmet` WHERE `id_predmet` = '$id_predmet'");
        }
    }


    //функция окочнательного удаления предмета
    function del_tochno_predmet($conn) {
        $id_predmet = $_POST['id_predmet'];
        $id_predmet = $_POST['id_predmet'];
        $sql_predmet = "DELETE FROM `predmet` WHERE `id_predmet` = '$id_predmet'";
        $query_predmet = mysqli_query($conn, $sql_predmet);

        if($query_predmet) {
            echo "Все удалено!";
        }
        else {
            echo "Что-то пошло не так(";
        }
    }

    

    //функиця добавления нового предмета
    function new_predmet($conn) {
        $input_new_predmet = $_POST['input_new_predmet'];
        $query_new_predmet = mysqli_query($conn,"INSERT `predmet` (name_predmet, id_prepod, active) VALUES ('$input_new_predmet', NULL, '0')");

        $array_predmet = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `predmet` WHERE `name_predmet` = '$input_new_predmet'"));
        echo $array_predmet['id_predmet'];
    }
    

    //Добавление нового преподователя
    function new_prepod($conn) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $patronymic = $_POST['patronymic'];
        $id_predmet = $_POST['id_predmet'];

        $array_prepod = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `users` WHERE `login` = '$login'"));
        if(!$array_prepod) {
            $id_users = time()*20;
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT `users` (`login`, `pass`, `role`, `id_users`) VALUES ('$login', '$pass_hash', 'prepod', '$id_users')");
            mysqli_query($conn, "INSERT `prepod` (`id_users`, `surname`, `name`, `patronymic`, `id_predmet`) VALUES ('$id_users', '$surname', '$name', '$patronymic', '$id_predmet')");

            $array_predmet = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `prepod` WHERE `id_users` = '$id_users'"));
            $id_prepod = $array_predmet['id_prepod'];
            mysqli_query($conn, "UPDATE `predmet` SET `id_prepod`= '$id_prepod', `active` = '1' WHERE `id_predmet`='$id_predmet'");
            $array_predmet2 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `predmet` WHERE `id_predmet` = '$id_predmet'"));
            echo $array_predmet2['name_predmet'];
        }
        else {
            echo "0";
        }
    }


    //Редактирование контента на js-редакторе
    function red_content($conn) { 
        $text_content = $_POST['val_redactor'];

        mysqli_query($conn, "UPDATE `content` SET `text_content`= '$text_content' WHERE `id`='1'");
        echo $text_content;
    }


    
    
    