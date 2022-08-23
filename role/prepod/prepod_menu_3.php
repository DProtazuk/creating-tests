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
    <title>Сайт Преподователя/menu3</title>
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

        

            <div id="menu_prepod_3" class="did_action_prepod_mini">

                <style>
	/* Стили таблицы (IKSWEB) */
	table.iksweb{text-decoration: none;border-collapse:collapse;width:90%;text-align:center; margin-left:5%;margin-top:15px;}
	table.iksweb th{font-weight:normal;font-size:14px; color:#ffffff;background-color:#354251;}
	table.iksweb td{font-size:13px;color:#354251;}
	table.iksweb td,table.iksweb th{white-space:pre-wrap;padding:10px 5px;line-height:13px;vertical-align: middle;border: 1px solid #354251;}	table.iksweb tr:hover{background-color:#f9fafb}
	table.iksweb tr:hover td{color:#354251;cursor:default;}
</style>
<table class="iksweb">
<thead>
<tr>
	<th>surname</th>
	<th>name</th>
	<th>patronymic</th>
	<th>institute</th>
    <th>speciality</th>
	<th>well</th>
	<th>namePrepdmet</th>
	<th>nameTest</th>
    <th>grade</th>
</tr>
</thead>
<tbody>

<?php 
    $selStatick = mysqli_query($conn, "SELECT * FROM `statistics`");
    while($arrayStatick = mysqli_fetch_array($selStatick)){
        echo "<tr>
                <td>{$arrayStatick[0]}</td>
                <td>$arrayStatick[1]</td>
                <td>$arrayStatick[2]</td>
                <td>$arrayStatick[3]</td>
                <td>$arrayStatick[4]</td>
                <td>$arrayStatick[5]</td>
                <td>$arrayStatick[6]</td>
                <td>$arrayStatick[7]</td>
                <td>$arrayStatick[8]</td>
            </tr>";
    }
?>
</tbody>
</table>

            </div>
        </div>
    </div>
</div>

<style>
    #but_menu3 {
        background-color: aliceblue; 
    }
</style>
</body>
<?php include($_SERVER['DOCUMENT_ROOT']."/role/prepod/link-prepod/link-prepod-js.php"); ?>
</html>