<?PHP 
    
        include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");
    
        //Функиция Авторизации
        $inp_log_auth = $_POST['inp_log_auth'];

        //Проверка Данных пользователя
        {
            $sql_auth_proverka = "SELECT * FROM `users` WHERE `login` = '$inp_log_auth'";
            $result_auth = mysqli_query($conn, $sql_auth_proverka);
            $result_auth_array = mysqli_fetch_array($result_auth);

            //проверка Логина
            if(isset($result_auth)) {

                //Проверка Пароля
                $inp_pass_auth = $_POST['inp_pass_auth'];
                $pass_hash = $result_auth_array['pass'];
                if (password_verify($inp_log_auth, $pass_hash)) {

                    //Запись в сессию уникального id 
                    session_start();
                    $_SESSION['action'] = $result_auth_array['id_users'];

                    echo "good";
                }
                else echo "Неверный Пароль!".$pass_hash;
            }
            else {
                echo "Неверный Логин!";
            }
        }
