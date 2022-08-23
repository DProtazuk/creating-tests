//выход на главную
$('#link_glaw').on('click', function() { 
    var path_index = "/index.php";
    window.location.href = path_index;
});

//выход из системы преподователя
$('#but_logout_prepod').on('click', function() { 
   
    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        dataType: 'html',
        data: {action:'logout_prepod'},
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

//функция меню при загрузке страницы
$(document).ready(function() { 
    menu_admin();
});


function menu_admin() {
    $('#but_menu1').on('click', function() {
        var delete_test = confirm("Вы уверены?");
        if(delete_test)  {
            window.location.href = "prepod_menu_1.php";
        }
        else {

        }
    });

    $('#but_menu2').on('click', function() { 
        var delete_test = confirm("Вы уверены?");
        if(delete_test)  {
            window.location.href = "prepod_menu_2.php";
        }
        else {

        }       
    });

    $('#but_menu3').on('click', function() {
        var delete_test = confirm("Вы уверены?");
        if(delete_test)  {
            window.location.href = "prepod_menu_3.php";
        }
        else {

        }
    });
}

//по нажатию на создать Тест
$('body').on('click',"#but_create_test",  function() { 

    //скрытый инпут, счетчик вопросов
    var num_vopros = parseFloat($('#num_vopros').val())+1;
    alert(num_vopros);

            $('.menu_prepod_2_content').append(
                '<div id="'+num_vopros+'" class="div_create_vopros div_create_vopros_'+num_vopros+'">'+
                    '<div class="div_create_vopros_header">'+
                        '<span id="id_span_'+num_vopros+'" class="div_create_vopros_header_span id_span_'+num_vopros+'">Вопрос №'+num_vopros+'</span>'+
                        '<input id="id_input_'+num_vopros+'" name="name_vopros_'+num_vopros+'" placeholder="Введите Вопрос" type="text" class="form-control menu_prepod_2_header_input class_input_'+num_vopros+'">'+
                        '<select data-vopros="'+num_vopros+'" data-sel-nomer-vopros="create_vopros_'+num_vopros+'" id="select_type_'+num_vopros+'" class="btn btn-info menu_prepod_2_header_button2 change_sel_create_vopros select_type_'+num_vopros+'">'+
                            '<option disabled selected value="">Тип Ответа</option>'+
                            '<option value="test">Тест</option>'+
                            '<option value="stroka">Строка</option>'+
                        '</select>'+
                        '<button data-nomer="'+num_vopros+'" id="button_del_'+num_vopros+'" type="button" class="btn btn-danger del_vopros but_del_vopros button_del_'+num_vopros+'">Удалить вопрос</button>'+
                    '</div>'+
            
                    '<div id="create_vopros_'+num_vopros+'" class="div_create_vopros_body create_vopros_'+num_vopros+'">'+
                            
                    '</div>'+
                '</div>');
                
    $('#num_vopros').val(num_vopros);

});


//Отрисовка типа теста
$('body').on('change',".change_sel_create_vopros",  function() { 
    var id_div_vopros = $(this).attr('data-sel-nomer-vopros');
    var this_num_vopros = $(this).attr('data-vopros');
    var value_type_vopros = $(this).val();

        if(value_type_vopros == "test") {
            $('#'+id_div_vopros).empty();
            $('#'+id_div_vopros).append(
                '<div >'+
                    '<input id="id_input_hidden_type_'+this_num_vopros+'" type="hidden" value="'+value_type_vopros+'" name="type_vopros_'+this_num_vopros+'" class="id_input_hidden_type_'+this_num_vopros+'">'+
    
                    '<input id="radio_but_1_'+this_num_vopros+'" type="radio" name="radio_but_'+this_num_vopros+'" value="1" class="radio_but_1_'+this_num_vopros+'">'+
                    '<input id="input_test_1_'+this_num_vopros+'" name="input_test_1_'+this_num_vopros+'" placeholder="Ответ" class="radio_input input_test_1_'+this_num_vopros+'" type="text">'+
    
                    '<input id="radio_but_2_'+this_num_vopros+'" type="radio" name="radio_but_'+this_num_vopros+'" value="2" class="radio_but_2_'+this_num_vopros+'">'+
                    '<input id="input_test_2_'+this_num_vopros+'" name="input_test_2_'+this_num_vopros+'" placeholder="Ответ" class="radio_input input_test_2_'+this_num_vopros+'" type="text">'+
    
                    '<input id="radio_but_3_'+this_num_vopros+'" type="radio" name="radio_but_'+this_num_vopros+'" value="3" class="radio_but_3_'+this_num_vopros+'">'+
                    '<input id="input_test_3_'+this_num_vopros+'" name="input_test_3_'+this_num_vopros+'" placeholder="Ответ" class="radio_input input_test_3_'+this_num_vopros+'" type="text">'+
    
                    '<input id="radio_but_4_'+this_num_vopros+'" type="radio" name="radio_but_'+this_num_vopros+'" value="4" class="radio_but_4_'+this_num_vopros+'">'+
                    '<input id="input_test_4_'+this_num_vopros+'" name="input_test_4_'+this_num_vopros+'" placeholder="Ответ" class="radio_input input_test_4_'+this_num_vopros+'" type="text">'+
                '</div>');
        }
        if(value_type_vopros == "stroka") {
            $('#'+id_div_vopros).empty();
            $('#'+id_div_vopros).append(
                '<input id="id_input_hidden_type_'+this_num_vopros+'" type="hidden" value="'+value_type_vopros+'" name="type_vopros_'+this_num_vopros+'" class="id_input_hidden_type_'+this_num_vopros+'">'+
                '<input id="stroka_otvet_'+this_num_vopros+'" name="otvet_'+this_num_vopros+'" placeholder="Введите Ответ" type=text class="form-control menu_prepod_2_header_input stroka_otvet_'+this_num_vopros+'">'
            );
        }
});


//кнопка удаления блока теста
$('body').on('click',".but_del_vopros",  function() { 

    //id блока
    var id_del_vopros = $(this).attr('data-nomer');
    
    //колличество изначально
    var num_vopros = parseFloat($('#num_vopros').val())
    for (let i = 1; i <= num_vopros; i++) {

        if(id_del_vopros==i){
            $('#'+id_del_vopros).remove();
        }
        else {
            if(i<id_del_vopros){

            }
            else {

                //начинаеться отрисовка!!!
                /////////////////////////

                var value = parseFloat(i)-1;

                //изменение главного блока
                $('.div_create_vopros_'+i).attr("id", value);
                $('#'+value).removeClass('div_create_vopros_'+i).addClass('div_create_vopros_'+value);

                //изменение span нумерации
                $('.id_span_'+i).attr("id", 'id_span_'+value);
                $('#id_span_'+value).text("Вопрос №"+value);
                $('#id_span_'+value).removeClass('id_span_'+i).addClass('id_span_'+value);

                //изменение инпута ввода название вопроса нумерации
                $('.class_input_'+i).attr("id", 'id_input_'+value);
                $('#id_input_'+value).attr("name", "name_vopros_"+value);
                $('#id_input_'+value).removeClass('class_input_'+i).addClass('class_input_'+value);

                //Изменения select типа вопроса
                $('.select_type_'+i).attr("id", 'select_type_'+value);
                $('#select_type_'+value).attr("data-vopros", value);
                $('#select_type_'+value).attr("data-sel-nomer-vopros", "create_vopros_"+value);
                $('#select_type_'+value).removeClass('select_type_'+i).addClass('select_type_'+value);

                //изменение кнопки удалить вопрос
                $('.button_del_'+i).attr("id", 'button_del_'+value);
                $('#button_del_'+value).attr("data-nomer", value);
                $('#button_del_'+value).removeClass('button_del_'+i).addClass('button_del_'+value);

                //отрисовка блока с ответом
                $('.create_vopros_'+i).attr("id", "create_vopros_"+value);
                $('#create_vopros_'+value).removeClass('create_vopros_'+i).addClass('create_vopros_'+value);

                //изменения скрытого инпута с типом вопроса
                $('.id_input_hidden_type_'+i).attr("id", 'id_input_hidden_type_'+value);
                $('#id_input_hidden_type_'+value).attr("name", 'type_vopros_'+value);
                $('#id_input_hidden_type_'+value).removeClass('id_input_hidden_type_'+i).addClass('id_input_hidden_type_'+value);
                
                var type_vopros = $('#id_input_hidden_type_'+value).val();

                if(type_vopros == "stroka") {
                    //изменение инпутов в типе строке
                    $('.stroka_otvet_'+i).attr("id", 'stroka_otvet_'+value);
                    $('#stroka_otvet_'+value).attr("name", 'otvet_'+value);
                    $('#stroka_otvet_'+value).removeClass('stroka_otvet_'+i).addClass('stroka_otvet_'+value);
                }
                if(type_vopros == "test") {
                    //изменение 4 радиобатоннов в тесте
                    $('.radio_but_1_'+i).attr("id", 'radio_but_1_'+value);
                    $('#radio_but_1_'+value).attr("name", 'radio_but_'+value);
                    $('#radio_but_1_'+value).removeClass('radio_but_1_'+i).addClass('radio_but_1_'+value);
                   
                    $('.radio_but_2_'+i).attr("id", 'radio_but_2_'+value);
                    $('#radio_but_2_'+value).attr("name", 'radio_but_'+value);
                    $('#radio_but_2_'+value).removeClass('radio_but_2_'+i).addClass('radio_but_2_'+value);

                    $('.radio_but_3_'+i).attr("id", 'radio_but_3_'+value);
                    $('#radio_but_3_'+value).attr("name", 'radio_but_'+value);
                    $('#radio_but_3_'+value).removeClass('radio_but_3_'+i).addClass('radio_but_3_'+value);

                    $('.radio_but_4_'+i).attr("id", 'radio_but_4_'+value);
                    $('#radio_but_4_'+value).attr("name", 'radio_but_'+value);
                    $('#radio_but_4_'+value).removeClass('radio_but_4_'+i).addClass('radio_but_4_'+value);


                    //изменение 4 инпутов ответа в тесте
                    $('.input_test_1_'+i).attr("id", 'input_test_1_'+value);
                    $('#input_test_1_'+value).attr("name", 'input_test_1_'+value);
                    $('#input_test_1_'+value).removeClass('input_test_1_'+i).addClass('input_test_1_'+value);
                   
                    $('.input_test_2_'+i).attr("id", 'input_test_2_'+value);
                    $('#input_test_2_'+value).attr("name", 'input_test_2_'+value);
                    $('#input_test_2_'+value).removeClass('input_test_2_'+i).addClass('input_test_2_'+value);

                    $('.input_test_3_'+i).attr("id", 'input_test_3_'+value);
                    $('#input_test_3_'+value).attr("name", 'input_test_3_'+value);
                    $('#input_test_3_'+value).removeClass('input_test_3_'+i).addClass('input_test_3_'+value);

                    $('.input_test_4_'+i).attr("id", 'input_test_4_'+value);
                    $('#input_test_4_'+value).attr("name", 'input_test_4_'+value);
                    $('#input_test_4_'+value).removeClass('input_test_4_'+i).addClass('input_test_4_'+value);
                }
            }
            
        }
    }

    //количество после удаления
    var num_next_vopros = parseFloat($('#num_vopros').val())-1;
    $('#num_vopros').val(num_next_vopros);
});



///////////////////////////////////////////////////
//редактирование тестов
//////////////////////////////////////////////////


//кнопка удаления теста
$('body').on('click',"#but_del_test",  function() { 
    var delete_test = confirm("Вы уверены что хотите удалить?");

    if(delete_test)  {
        alert("Удаляем");
    }
    else {
        alert("мда");
    }
});


//Отрисовка теста для редактирования
$('body').on('change',"#select_update_test",  function() {
    //ссылка на сайт
    var link = $(this).val();
    
    $.ajax({
        url: 'script-php/function.php',
        method: 'post',
        dataType : "json",
        data: {action:'arrayTest', link:link},
        success: function(data){
            if(data) {
                //запись в скрытый инпут переменная колличества вопросов
                var count = data[0]['count'];
                $('#num_vopros').val(count);
                //записываем название Теста в инпут
                $(".input_red_name_test").val(data[0]['nameTest']);
                
                //цикл записи вопросов
                for (let value=1; value<=count; value++){
                    var result = parseFloat(value)-1;
                    //отрисовали вопросы
                    $('.menu_prepod_2_content').append(
                        '<div id="'+value+'" class="div_create_vopros div_create_vopros_'+value+'">'+
                        '<div class="div_create_vopros_header">'+
                        '<span id="id_span_'+value+'" class="div_create_vopros_header_span id_span_'+value+'">Вопрос №'+value+'</span>'+
                        '<input value="'+data[1][result]['name_question']+'" id="id_input_'+value+'" name="name_vopros_'+value+'" placeholder="Введите Вопрос" type="text" class="form-control menu_prepod_2_header_input class_input_'+value+'">'+
                        '<select data-vopros="'+value+'" data-sel-nomer-vopros="create_vopros_'+value+'" id="select_type_'+value+'" class="btn btn-info menu_prepod_2_header_button2 change_sel_create_vopros select_type_'+value+'">'+
                        '<option disabled selected value="">Тип Ответа</option>'+
                        '<option value="test">Тест</option>'+
                        '<option value="stroka">Строка</option>'+
                        '</select>'+
                        '<button data-nomer="'+value+'" id="button_del_'+value+'" type="button" class="btn btn-danger del_vopros but_del_vopros button_del_'+value+'">Удалить вопрос</button>'+
                        '</div>'+

                        '<div id="create_vopros_'+value+'" class="div_create_vopros_body create_vopros_'+value+'">'+

                        '</div>'+
                        '</div>'
                    );

                    //отрисовка ответов
                    //если строка
                    if(data[1][result]['type'] == "stroka") {
                        $('#create_vopros_'+value).append(
                            '<input id="id_input_hidden_type_'+value+'" type="hidden" value="'+data[1][result]['type']+'" name="type_vopros_'+value+'" class="id_input_hidden_type_'+value+'">'+
                            '<input id="stroka_otvet_'+value+'" name="otvet_'+value+'" value="'+data[1][result]['answers']+'" placeholder="Введите Ответ" type=text class="form-control menu_prepod_2_header_input stroka_otvet_'+value+'">'
                        );
                    }
                    //если тест
                    if(data[1][result]['type'] == "test") {
                        $('#create_vopros_'+value).append(
                            '<div >'+
                            '<input id="id_input_hidden_type_'+value+'" type="hidden" value="'+data[1][result]['type']+'" name="type_vopros_'+value+'" class="id_input_hidden_type_'+value+'">'+

                            '<input id="radio_but_1_'+value+'" type="radio" name="radio_but_'+value+'" value="1" class="radio_but_1_'+value+'">'+
                            '<input value="'+data[1][result]['answers'][0]+'" id="input_test_1_'+value+'" name="input_test_1_'+value+'" placeholder="Ответ" class="radio_input input_test_1_'+value+'" type="text">'+

                            '<input id="radio_but_2_'+value+'" type="radio" name="radio_but_'+value+'" value="2" class="radio_but_2_'+value+'">'+
                            '<input value="'+data[1][result]['answers'][1]+'" id="input_test_2_'+value+'" name="input_test_2_'+value+'" placeholder="Ответ" class="radio_input input_test_2_'+value+'" type="text">'+

                            '<input id="radio_but_3_'+value+'" type="radio" name="radio_but_'+value+'" value="3" class="radio_but_3_'+value+'">'+
                            '<input value="'+data[1][result]['answers'][2]+'" id="input_test_3_'+value+'" name="input_test_3_'+value+'" placeholder="Ответ" class="radio_input input_test_3_'+value+'" type="text">'+

                            '<input id="radio_but_4_'+value+'" type="radio" name="radio_but_'+value+'" value="4" class="radio_but_4_'+value+'">'+
                            '<input value="'+data[1][result]['answers'][3]+'" id="input_test_4_'+value+'" name="input_test_4_'+value+'" placeholder="Ответ" class="radio_input input_test_4_'+value+'" type="text">'+
                            '</div>'
                        );

                        //отметить радибаттон
                        if(data[1][result]['active'] == "0") {
                            $('#radio_but_1_'+value).attr('checked',true);
                        }
                        if(data[1][result]['active'] == "1") {
                            $('#radio_but_2_'+value).attr('checked',true);
                        }
                        if(data[1][result]['active'] == "2") {
                            $('#radio_but_3_'+value).attr('checked',true);
                        }
                        if(data[1][result]['active'] == "3") {
                            $('#radio_but_4_'+value).attr('checked',true);
                        }
                    }
                }
            }
        }
    });

    /*открытие кнопок инструментов*/
    var but1 = document.getElementById("but_create_test");
    var but2 = document.getElementById("but_create_tes");
    var but3 = document.getElementById("but_del_test");

    but1.style.display = 'block';
    but2.style.display = 'block';
    but3.style.display = 'block';

    //запись с скрытый инпут
    $('#input_hidden_testId').val(link);
});
