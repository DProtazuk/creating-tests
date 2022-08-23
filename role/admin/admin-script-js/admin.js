//Генератор пароля
{
    $("#input-generate").click(function(){
            var $input = $("#input-password");
            $input.val('');
            
            var pass = generatePassword();
            var txt = pass.split("");
            var interval = setInterval(function(){
                if(!txt[0]){
                clearInterval(interval);
            } else {
                $input.val($input.val() + txt.shift());
            }
        }, 50);

        return false;
    });

    function generatePassword(){
        var length = 8,
        charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz~!@-#$";
        if(window.crypto && window.crypto.getRandomValues) {
            return Array(length)
                .fill(charset)
                .map(x => x[Math.floor(crypto.getRandomValues(new Uint32Array(1))[0] / (0xffffffff + 1) * (x.length + 1))])
                .join('');    
        } else {
            res = '';
            for (var i = 0, n = charset.length; i < length; ++i) {
                res += charset.charAt(Math.floor(Math.random() * n));
            }
            return res;
        }
    }
}



$(document).ready(function() { 
    menu_admin();

});


function menu_admin() {
    var x1 = document.getElementById("div_action_admin_1");
    var x1_but = document.getElementById("admin_menu_1");

    var x2 = document.getElementById("div_action_admin_2");
    var x2_but = document.getElementById("admin_menu_2");

    var x3 = document.getElementById("div_action_admin_3");
    var x3_but = document.getElementById("admin_menu_3");

    $('#admin_menu_1').on('click', function() {
        if (x1.style.display == 'block') {
            x1.style.display = 'none';
            x2.style.display = 'none';
            x3.style.display = 'none';

            x1_but.style.backgroundColor = 'inherit';
            x2_but.style.backgroundColor = 'inherit';
            x3_but.style.backgroundColor = 'inherit';
        } 
        else {
            x1.style.display = 'block';
            x2.style.display = 'none';
            x3.style.display = 'none';
            
            x1_but.style.backgroundColor = 'red';
            x2_but.style.backgroundColor = 'inherit';
            x3_but.style.backgroundColor = 'inherit';
        }
    });

    $('#admin_menu_2').on('click', function() {
        if (x2.style.display == 'block') {
            x1.style.display = 'none';
            x2.style.display = 'none';
            x3.style.display = 'none';

            x1_but.style.backgroundColor = 'inherit';
            x2_but.style.backgroundColor = 'inherit';
            x3_but.style.backgroundColor = 'inherit';
        } 
        else {
            x1.style.display = 'none';
            x2.style.display = 'block';
            x3.style.display = 'none';
            
            x1_but.style.backgroundColor = 'inherit';
            x2_but.style.backgroundColor = 'red';
            x3_but.style.backgroundColor = 'inherit';
        }
    });

    $('#admin_menu_3').on('click', function() {
        if (x3.style.display == 'block') {
            x1.style.display = 'none';
            x2.style.display = 'none';
            x3.style.display = 'none';

            x1_but.style.backgroundColor = 'inherit';
            x2_but.style.backgroundColor = 'inherit';
            x3_but.style.backgroundColor = 'inherit';
        } 
        else {
            x1.style.display = 'none';
            x2.style.display = 'none';
            x3.style.display = 'block';
            
            x1_but.style.backgroundColor = 'inherit';
            x2_but.style.backgroundColor = 'inherit';
            x3_but.style.backgroundColor = 'red';
        }
    });
}


$('#spavn_index').on('click', function() { 
    var path_index = "/index.php";
    window.location.href = path_index;
});

$('#but_admin_logaut').on('click', function() { 
   
    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        dataType: 'html',
        data: {action:'del_user'},
        success: function(data){
            if(data) {
                location.reload();
                alert("Вы успешно вышли!");
            }
            else {
                alert("Что-то пошло не так :)");
            }
        }
    });
});



/////////////////////////////////////
//Система работы с предметом
////////////////////////////////////
//нажатие кнокпи update и появление поля редактирования
$('body').on('click',".upt_predmet", function() { 
    var id_predmet = $(this).attr('data-predmet');
    var name_predmet = $(this).attr('data-name_predmet');

    $('#id_predmet_'+id_predmet).empty();
    $('#id_predmet_'+id_predmet).append("<input id=id_upd_predmet_"+id_predmet+" value="+name_predmet+"><button data-predmet="+id_predmet+" class=but_upt_save>Save</button>");
});

//нажатие на кнопку сохранить
$('body').on('click',".but_upt_save", function() { 
    
    var id_predmet = $(this).attr('data-predmet');
    var input_upt_predmet = $('#id_upd_predmet_'+id_predmet).val();

    //Update предмета
    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        dataType: 'html',
        data: {action:'update_predmet', id_predmet:id_predmet, input_upt_predmet:input_upt_predmet},
        success: function(data){
            if(data) {           
                $('#id_predmet_'+id_predmet).empty();
                $('#id_predmet_'+id_predmet).append("<span>Наименование: "+input_upt_predmet+"</span>"+
                "<button data-name_predmet="+input_upt_predmet+" data-predmet="+id_predmet+" class=upt_predmet>Update</button>"+
                "<button data-predmet="+id_predmet+" class=del_predmet>Delete</button>");
            }
            else {
                alert("что-то пошло не так(");
            }
        }
    });
});


//удалить предмет
$('body').on('click',".del_predmet", function() { 
    
    //проверка предмета на привязку
    var id_predmet = $(this).attr('data-predmet');
    
    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        data: {action:'proverka_del_predmet', id_predmet:id_predmet},
        success: function(data){
            if(data) {
                var result = confirm(data);

                if(result)  {
                    $.ajax({
                        url: 'script-php/function.php',
                        method: 'post',
                        dataType: 'html',
                        data: {action:'del_tochno_predmet', id_predmet:id_predmet},
                        success: function(data){
                            $('#id_predmet_'+id_predmet).remove();
                            alert(data);
                        }
                    });
                } 
                else {
                    alert("Тогда не будем)!");
                }
            }
            else {
                alert("Good Delete");
                $('#id_predmet_'+id_predmet).remove();
            }
        }
    });
});



/*$('#but_click').on('click', function() { 
    var result = confirm("Do you want to continue?");

    if(result)  {
        alert("OK Next lesson!");
    } else {
        alert("Bye!");
    }
});*/


//Функция добавления преподователя
$('body').on('click',".button_new_predmet",  function() { 
   
    var input_new_predmet = $('.input_new_predmet').val();
    if(input_new_predmet.length >= 4) {
        $.ajax({
            url: 'script-php/function.php',
            method: 'post',
            data: {action:'new_predmet', input_new_predmet:input_new_predmet},
            success: function(data){
                $('.div_select_predmet').append("<div id=id_predmet_"+data+"  class=colom_predmet><span>Наименование: "+input_new_predmet+"</span>"+
                "<button data-name_predmet="+input_new_predmet+" data-predmet="+data+" class=upt_predmet>Update</button>"+
                "<button data-predmet="+data+" class=del_predmet>Delete</button></div>");
                $('.div_new_prepod_input').append("<option value="+data+">"+input_new_predmet+"</option>");
            }
        });
    }
    else {
        alert("Проверьте!");
    }
});

$('body').on('click',"#button_new_prepod",  function() { 
    var login = $('#new_login').val();
    var pass = $('#new_pass').val();
    var surname = $('#new_surname').val();
    var name = $('#new_name').val();
    var patronymic = $('#new_patronymic').val();
    var id_predmet = $('#select_option_prepod').val();

    if((login.length >= 4)&&(pass.length >= 4)&&(surname.length >= 4)&&(name.length >= 4)&&(patronymic.length >= 4)) {
        if(id_predmet){ 
            $.ajax({
                url: 'script-php/function.php',
                method: 'post',
                data: {action:'new_prepod', login:login, pass:pass, surname:surname, name:name, patronymic:patronymic, id_predmet:id_predmet,},
                success: function(data){
                    if(data == "0"){
                        alert("Логин Занят!");
                    }
                    else {
                        alert(data);
                        $('.div_select_prepod').append("<div class=div_prepod_select>"+
                        "<span class=div_prepod_select_span>"+surname+"</span>"+
                        "<span class=div_prepod_select_span>"+name+"</span>"+
                        "<span class=div_prepod_select_span>"+patronymic+"</span>"+
                        "<span class=div_prepod_select_span>"+data+"</span>"+
                    "</div>");
                    } 
                }
            });
        }
        else {
            alert("Выберите предмет для преподователя!");
        }
    }
    else {
        alert("Проверьте!");
    }
});


$(document).ready(function() {
    $('#summernote').summernote({
        lang: 'ru-RU',
        height: 300,
    });
});



$('body').on('click',"#btn_js_redaktor",  function() { 
    var val_redactor = $('#summernote').summernote('code');
    alert(val_redactor);

    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        data: {action:'red_content', val_redactor:val_redactor},
        success: function(data){ 
            if(data) {
                alert("Good");
            }
            else {
                alert("eror");
            }
        }
    });
});


$('body').on('click',"#but_down_doc",  function() { 
    if (window.FormData === undefined) {
        alert('В вашем браузере FormData не поддерживается')
    } else {
        var formData = new FormData();
        formData.append('file', $("#js-file")[0].files[0]);

        $.ajax({
            type: "POST",
            url: 'script-php/down_img.php',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            dataType : 'json',
            success: function(msg){
                if (msg.error == '') {
                    $('#result').html(msg.success);
                    $('.js_file_input_right').empty();
                    $('.js_file_input_right').append("<img class=js_file_input_left_img src=../../../../../src/"+msg.img_name+" class=div_action_img_img>");

                } else {
                    $('#result').html(msg.error);
                }
            }
        });
    }
});