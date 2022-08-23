<?php 

include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php");
include("prepodFunction.php");

//проверка на существование теста перед его записью
proverka_na_delete_test($conn);

//создание теста
crate_test($conn);
header("Location: ../prepod.php");
?>