<?php 
    include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");

    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $institute = $_POST['institute'];
    $speciality = $_POST['speciality'];
    $well = $_POST['well'];
    $namePrepdmet = $_POST['namePrepdmet'];
    $nameTest = $_POST['nameTest'];
    $grade = $_POST['grade'];

    mysqli_query($conn, "INSERT INTO `statistics` (`surname`, `name`, `patronymic`, `institute`, `speciality`, `well`, `namePrepdmet`, `nameTest`, `grade`) 
    VALUES ('$surname', '$name', '$patronymic', '$institute', '$speciality', '$well', '$namePrepdmet', '$nameTest', '$grade`')");
?>