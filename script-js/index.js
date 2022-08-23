//Скрипт при нажатии кнопки Авторизацииы
$('#button_auth').on('click', function() { 
    var inp_log_auth = $('#inp_log_auth').val();
    var inp_pass_auth = $('#inp_pass_auth').val();
    //Проверка на пустоты и длинну
    if((inp_log_auth.length >= 4) && (inp_pass_auth.length>= 4) && (inp_log_auth != 0)&& (inp_pass_auth != 0)) {

        $.ajax({
            url: 'script-php/script_auth.php',
            method: 'post',
            dataType: 'html',
            data: {action:'auth_user', inp_log_auth: inp_log_auth, inp_pass_auth: inp_pass_auth},
            success: function(data){
                if(data == 'good') {
                    location.reload();
                    alert("Вы успешно вошли!");
                }
                else {
                    alert(data);
                }
            }
        });
    }
    else {
        alert("Проверьте введенные Данные!");
    }
});


$('#button_logout_admin').on('click', function() { 
    var root_admin = document.location.hostname;
    var path_admin = "/role/admin/admin.php";
    var root_admin = root_admin + path_admin;
    window.location.href = path_admin;

});

$('#button_logout_prepod').on('click', function() { 
    var root_prepod = document.location.hostname;
    var path_prepod = "/role/prepod/prepod.php";
    var root_prepod = root_prepod + path_prepod;
    window.location.href = path_prepod;

});
