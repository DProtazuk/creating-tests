<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT']."/script-php/link-css.php"); ?>
    <title>Сайт кафедры</title>
</head>

<body>

    <div class="index_content">

        <?php include($_SERVER['DOCUMENT_ROOT']."/pages/header.php"); ?>

        <div class="div_action">
            <?php 
                 $result_content = mysqli_query($conn, "SELECT * FROM `content` WHERE `id` = '1'");
                 $array_content = mysqli_fetch_array($result_content);
            ?>
            <div class="div_action_img">
                <?php echo "<img src=src/{$array_content['img_content']} class=div_action_img_img>"; ?>
            </div>

            <div class="div_action_text">
                <?php echo $array_content['text_content']; ?>
            </div>

        </div>

        <?php include($_SERVER['DOCUMENT_ROOT']."/pages/footer.php"); ?>

    </div>

</body>

<?php include($_SERVER['DOCUMENT_ROOT']."/script-php/link-js.php"); ?>
</html>