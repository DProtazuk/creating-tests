<?php

//проверка на существование теста перед его записью
function proverka_na_delete_test($conn) {
    if($_POST['id_test']){
        $link = $_POST['id_test'];
        //echo $link;
        $sqlDelTest = "DELETE test,question,answers FROM test INNER JOIN question INNER JOIN answers WHERE test.id_test = question.id_test AND question.id_question = answers.id_question AND  test.link='$link'";
        mysqli_query($conn, $sqlDelTest);
    }
}

//создание теста
function crate_test($conn){
    //id предмета
    $id_predmet = $_POST['id_predmet'];
    //echo "id предмета: ".$id_predmet."<br>";

    //колличество вопросов в тесте
    $num_vopros = $_POST['num_vopros'];

    //Запись в таблицу test

    //Название теста
    $name_new_test = $_POST['name_new_test'];
    //echo "Название теста: ".$name_new_test."<br>";
    $link = "http://localhost/test/test.php?name_test=".$name_new_test;
    mysqli_query($conn, "INSERT INTO `test` (`name_test`, `id_predmet`, `link`, `num_rows`) VALUES ('$name_new_test', '$id_predmet', '$link', '$num_vopros')");
    $id_test = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id_test) FROM `test`"));

    //текущий id теста в таблице
    $id_test = $id_test[0][0];
    //echo $id_test;
    //echo "Колличество вопросов: ".$num_vopros."<br><br><br>";

    //массив с вопросами
    $array_question = array();

    //массив с ответами
    $array_answers = array();

    //массив с id вопросами
    $array_id_question = array();

    //sql запись вопросов в базу данных
    $sql_question = "INSERT INTO `question` (`name_question`, `type_question`, `id_test`) VALUES ";

    //sql запись ответов в базу данных
    $sql_answers = "INSERT INTO `answers` (`name_answer`, `id_question`, `active`) VALUES ";

    for ($i = 1; $i <= $num_vopros; $i++) {
        //название вопроса
        $name_vopros = $_POST["name_vopros_".$i];
        //тип вопроса
        $type_vopros = $_POST["type_vopros_".$i];

        //формирование запроса на таблицу вопросов
        $sql_question_dop = "('$name_vopros','$type_vopros',$id_test),";
        $sql_question = $sql_question.$sql_question_dop;
    }

    //обрезаем последний символ
    $sql_question = mb_substr($sql_question, 0, -1);

    //запись в базу данных вопросов
    mysqli_query($conn, $sql_question);
    $id_vopros = mysqli_fetch_array(mysqli_query($conn, "SELECT max(id_question) FROM `question`"));
    $id_vopros = $id_vopros[0];

    //цыкл формирования массива с id вопросов
    array_push($array_id_question, $id_vopros);
    for($e=1; $e <= $num_vopros-1; $e++) {
        array_push($array_id_question, $id_vopros-$e);
    }

    $array_id_question1 = array_reverse($array_id_question);

    //print_r($array_id_question);

    //цыкл формирования массива с ответами
    for ($i = 1; $i <= $num_vopros; $i++) {

        $id_question = $array_id_question1[$i-1];

        //тип вопроса
        $type_vopros = $_POST["type_vopros_".$i];

        if($type_vopros == "test") {

            //варианты ответов
            $otvet_test_1 = $_POST["input_test_1_".$i];
            $otvet_test_2 = $_POST["input_test_2_".$i];
            $otvet_test_3 = $_POST["input_test_3_".$i];
            $otvet_test_4 = $_POST["input_test_4_".$i];

            //правильный ответ
            $active_otvet = $_POST["radio_but_".$i];

            if($active_otvet == "1") {
                $otvet = [$otvet_test_1, $id_question, 1];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_2, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_3, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_4, $id_question, 0];
                array_push($array_answers, $otvet);
            }
            if($active_otvet == "2") {
                $otvet = [$otvet_test_1, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_2, $id_question, 1];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_3, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_4, $id_question, 0];
                array_push($array_answers, $otvet);
            }
            if($active_otvet == "3") {
                $otvet = [$otvet_test_1, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_2, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_3, $id_question, 1];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_4, $id_question, 0];
                array_push($array_answers, $otvet);
            }
            if($active_otvet == "4") {
                $otvet = [$otvet_test_1, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_2, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_3, $id_question, 0];
                array_push($array_answers, $otvet);

                $otvet = [$otvet_test_4, $id_question, 1];
                array_push($array_answers, $otvet);
            }
        }

        if($type_vopros == "stroka") {
            $otvet = [$_POST["otvet_".$i], $id_question, 1];
            array_push($array_answers, $otvet);
        }
    }



    //количество в массиве ответов
    $num_otvetov = count($array_answers);

    for ($i = 0; $i <= $num_otvetov-1; $i++) {
        //формирование запроса на таблицу ответов
        $name_answer = $array_answers[$i][0];
        $id_question = $array_answers[$i][1];
        $active = $array_answers[$i][2];

        $sql_answers_dop = "('$name_answer','$id_question','$active'),";
        $sql_answers = $sql_answers.$sql_answers_dop;

    }

    //обрезаем последний символ
    $sql_answers = mb_substr($sql_answers, 0, -1);

    //запись в базу данных ответов
    mysqli_query($conn, $sql_answers);
}

//создание массива теста с бд
function arrayTest($conn){
    $link = $_POST['link'];
    //ссылка на тест
    $sqlTest = "SELECT test.id_test, test.name_test, test.num_rows, question.name_question, question.type_question, answers.name_answer, answers.active FROM test INNER JOIN question ON test.id_test = question.id_test INNER JOIN answers ON question.id_question = answers.id_question WHERE test.link = '$link' ";
    $queryTest = mysqli_query($conn, $sqlTest);
    $num_rows = mysqli_num_rows($queryTest);

    $arrayData = [];
    $arrayTest = [];

    //создаем начальный нормальный массив
    for($i=1; $i<=$num_rows; $i++) {
        $arraySql = mysqli_fetch_assoc($queryTest);
        array_push($arrayTest, $arraySql);
    }

    //половина массива теста
    $arrayData[] = [nameTest=>$arrayTest[0][name_test],count=>$arrayTest[0][num_rows]];

    //обьявление второй половины
    $array_vopros =[];
    $i=0;
    while($i <= $num_rows-1) {

        if($arrayTest[$i][type_question] == "stroka") {
            $array_vopros[] = [name_question=>$arrayTest[$i][name_question], type=>"stroka", answers=>$arrayTest[$i][name_answer]];
        }
        else{
            if($arrayTest[$i][active]=="1"){
                $active = "0";
            }
            if($arrayTest[$i+1][active]=="1"){
                $active = "1";
            }
            if($arrayTest[$i+2][active]=="1"){
                $active = "2";
            }
            if($arrayTest[$i+3][active]=="1"){
                $active = "3";
            }
            $array_vopros[] = [name_question=>$arrayTest[$i][name_question], type=>"test", answers=>[$arrayTest[$i][name_answer],$arrayTest[$i+1][name_answer],$arrayTest[$i+2][name_answer],$arrayTest[$i+3][name_answer]], active=>$active];
            $i = $i+3;
        }

        $i++;
    }

    //соединение массива
    array_push($arrayData, $array_vopros);


    echo json_encode($arrayData);


    
}