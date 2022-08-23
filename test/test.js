//функция записи Теста в массив
function getTest(){ 
    //скрытый инпут ссылка на тест
    var link = $('#link_test').val();
    let result = [];
    $.ajax({
        url: '../role/prepod/script-php/function.php',
        method: 'post',
        dataType : "json",
        async:false,
        data: {action:'arrayTest', link:link},
        success: function(data){
            result = data;
        }
    });
    return result;
};

//запись в переменную массива с тестом
var data = getTest();

//кнопка начать тест
$('body').on('click',"#startTest",  function() {
    var input1 = $('#input1').val();
    var input2 = $('#input2').val();
    var input3 = $('#input3').val();
    var input4 = $('#input4').val();
    var input5 = $('#input5').val();
    var input6 = $('#input6').val();

    //проверка всех полей
    //if((input1.length >= 4) && (input2.length>= 4) && (input3.length>= 4) && (input4.length>= 4) && (input5.length>= 4) && (input6.length>= 1)) {
        //if((input1 != 0) && (input2 != 0) && (input3 != 0) && (input4 != 0)  && (input5 != 0)  && (input6 != 0)) {
            alert("Начинаем Тест");
                var count = $('#num_voprosov').val();
                    
                //цикл записи вопросов
                for (let value=1; value<=count; value++){
                    var result = parseFloat(value)-1;

                    //если строка
                    if(data[1][result]['type'] == "stroka") {
                        $('.testAction').append(
                            '<div id="'+value+'" class="divTestGlaw">'+
                                '<div class="divTestGlawTop">'+
                                    '<span class="divTestGlawTop_span1">Вопрос №'+value+'</span>'+
                                    '<span class="divTestGlawTop_span2">'+data[1][result]['name_question']+'</span>'+
                                    '<button id="confirmation_'+value+'" data-type="'+data[1][result]['type']+'" data-id-vopros="'+value+'" class="btn btn-danger but_good_vopros">Подтвердить</button>'+
                                '</div>'+

                                '<div class="divTestGlawBottom">'+
                                    '<input id="input_otvet_'+value+'" class="form-control divTestGlawBottomInput" type="text" placeholder="Напишите ответ">'+
                                '</div>'+
                            '</div>'
                        );
                    }
                    //если тест
                    if(data[1][result]['type'] == "test") {
                        $('.testAction').append(    
                            '<div id="'+value+'" class="divTestGlaw">'+
                                '<div class="divTestGlawTop">'+
                                    '<span class="divTestGlawTop_span1">Вопрос №'+value+'</span>'+
                                       '<span class="divTestGlawTop_span2">'+data[1][result]['name_question']+'</span>'+
                                    '<button id="confirmation_'+value+'" data-type="'+data[1][result]['type']+'" data-id-vopros="'+value+'" class="btn btn-danger but_good_vopros">Подтвердить</button>'+
                                '</div>'+

                                '<div class="divTestGlawBottom">'+
                                    '<div class="radio_but">'+
                                        '<input data-id_otvet="0" type="radio" id="radio_'+value+'_0" name="radio_'+value+'" value="0">'+
                                        '<label>'+data[1][result]['answers'][0]+'</label>'+
                                    '</div>'+
                
                                    '<div class="radio_but">'+
                                        '<input data-id_otvet="1" type="radio" id="radio_'+value+'_1" name="radio_'+value+'" value="1">'+
                                        '<label>'+data[1][result]['answers'][1]+'</label>'+
                                    '</div>'+

                                    '<div class="radio_but">'+
                                        '<input data-id_otvet="2" type="radio" id="radio_'+value+'_2" name="radio_'+value+'" value="2">'+
                                        '<label>'+data[1][result]['answers'][2]+'</label>'+
                                    '</div>'+

                                    '<div class="radio_but">'+
                                        '<input data-id_otvet="3" type="radio" id="radio_'+value+'_3" name="radio_'+value+'" value="3">'+
                                        '<label>'+data[1][result]['answers'][3]+'</label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'
                        );
                    }
                }
                //запускаем таймер
                $('#countdown-1').timeTo(1200, function () {
                    resultTest();
                });
                //открываем кнопки
                var startTest = document.getElementById("startTest");
                startTest.style.display = 'none';
                var finishTest = document.getElementById("finishTest");
                finishTest.style.display = 'block';
                //открываем первый блок с вопросами
                var id_van_block = document.getElementById("1");
                id_van_block.style.display = 'block';
        //}
        //else alert("Проверьте введенные Данные!");
    //}
    //else alert("Проверьте введенные Данные!");
    
});


//кнопка подвердить вопрос
$('body').on('click',".but_good_vopros",  function() {

    function proverka(){
        //открываем сдедующий вопрос
        var count = $('#num_voprosov').val();
        var chet;
        for(let i=1;i<=count;i++){
            var clickBut = document.getElementById('click_but_'+i);
            if(clickBut.dataset.active == "true"){
                var id_van_block = document.getElementById(i);
                id_van_block.style.display = 'block';
                chet = 1;
            }
        }
        if(!chet){
            $('#countdown-1').timeTo(1, function () {});
            resultTest();
        }
        return;
    }

    var data_type = $(this).attr('data-type');
    var data_id_vopros = $(this).attr('data-id-vopros');
    //переменная для массива по счету вопроса
    var amout = data_id_vopros-1;


    //проверка внесен ли ответ
    if(data_type == "stroka") {
        var value_input_otvet = $("#input_otvet_"+data_id_vopros).val();
        if((value_input_otvet.length == 0)) {
            alert("Запишите ответ!");
            return;
        }
        if(value_input_otvet == data[1][amout]['answers']){
            var clickBut = document.getElementById('click_but_'+data_id_vopros);
            clickBut.style.backgroundColor = 'green';
        }
        else {
            var clickBut = document.getElementById('click_but_'+data_id_vopros);
            clickBut.style.backgroundColor = 'red';
        }
        //делаем неактивный блок с отвеченным вопросом
        $('#click_but_'+data_id_vopros).attr("data-active", "false");
        //скрываем блок
        var id_del_block = document.getElementById(data_id_vopros);
        id_del_block.style.display = 'none';

        proverka();
        return;
    }
    if(data_type == "test") {
        //проверка задан ли хоть один радиобаттон
        if($("#radio_"+data_id_vopros+"_0").is(":checked")||$("#radio_"+data_id_vopros+"_1").is(":checked")||$("#radio_"+data_id_vopros+"_2").is(":checked")||$("#radio_"+data_id_vopros+"_3").is(":checked")) {
            for(let i=0;i<=3;i++){
                if($("#radio_"+data_id_vopros+"_"+i).is(":checked")){
                    if(i == data[1][amout]['active']) {
                        var clickBut = document.getElementById('click_but_'+data_id_vopros);
                        clickBut.style.backgroundColor = 'green';
                        //делаем неактивный блок с отвеченным вопросом
                        $('#click_but_'+data_id_vopros).attr("data-active", "false");
                        //скрываем блок
                        var id_del_block = document.getElementById(data_id_vopros);
                        id_del_block.style.display = 'none';
                        
                        proverka();
                        return;
                    }
                    else {
                        var clickBut = document.getElementById('click_but_'+data_id_vopros);
                        clickBut.style.backgroundColor = 'red';
                        //делаем неактивный блок с отвеченным вопросом
                        $('#click_but_'+data_id_vopros).attr("data-active", "false");
                        //скрываем блок
                        var id_del_block = document.getElementById(data_id_vopros);
                        id_del_block.style.display = 'none';
                        
                        proverka();
                        return;
                    }
                }
            }
        }
        alert("Ответ не выбран!");
    }
});



//кнопка закончить тест
$('body').on('click',"#finishTest",  function() {
    var count = $('#num_voprosov').val();
    var chet;
        for(let i=1;i<=count;i++){
            var clickBut = document.getElementById('click_but_'+i);
            if(clickBut.dataset.active == "true"){
                alert("Закончите тест");
                chet = 1;
                return;
            }
        }
        if(!chet){
            $('#countdown-1').timeTo(1, function () {
                resultTest();
            });
            
        }
        return;
});


//мини кнопки для каждого вопроса
$('body').on('click',".sel_mini",  function() {
    if($(this).attr('data-active') == "true") {
        //колличество вопросов
        var num_voprosov = $('#num_voprosov').val();   

        for (let i = 1; i <= num_voprosov; i++) {
            var data_id = document.getElementById(i);
            data_id.style.display = 'none';
        }
        //ключ вопроса
        var data_id = $(this).attr('data-but-vopros');
        var data_id = document.getElementById(data_id);
        data_id.style.display = 'block';
    }
});



//функция подсчета результата
function resultTest() { 
    //баллы за тест и за вопрос
    const strokaGrade = 2;
    const testGrade = 1;

    //колличество вопросов в теста
    var count = $('#num_voprosov').val();
    
    //смотрим сколько всего возможно набрать баллов
    var maxPoints = 0;
        for(let i=1;i<=count;i++){
            //смотрим тип вопроса
            var typeQuestion = document.getElementById('confirmation_'+i);
            //если строка
            if(typeQuestion.dataset.type == "stroka"){
                maxPoints = maxPoints+strokaGrade;
            }
            //если тест
            if(typeQuestion.dataset.type == "test") {
                maxPoints = maxPoints+testGrade;
            }
        }
    //alert(maxPoints);

    
    //подсчитываем сколько набрал баллов студент
    //баллы студента
    var points = 0;

    for(let i=1;i<=count;i++){
        //проверяем подтвежден ли вопрос
        var question = document.getElementById('click_but_'+i);
        if(question.dataset.active == "false"){
            //смотрим тим вопроса
            var typeQuestion = document.getElementById('confirmation_'+i);
            //если строка
            if(typeQuestion.dataset.type == "stroka"){
                //ответ записанный студентом
                var value_input_otvet = $("#input_otvet_"+i).val();
                //проверяем правильный ли ответ
                if(value_input_otvet == data[1][i-1]['answers']){
                    //засчитываем очки
                    points = points+strokaGrade;
                }   
            }
            //если тест
            if(typeQuestion.dataset.type == "test") {
                //ответ записанный студентом
                var value_input_otvet = $('input[name="radio_'+i+'"]:checked').val();
                //проверяем правильный ли ответ

                if(value_input_otvet == data[1][i-1]['active']) {
                    //засчитываем очки
                    points = points+testGrade;
                }
            }
        }
    }
    //alert(points);

    /////////////////
    //считаем оценку 
    ////////////////

    //макимум по стобальной системе
    const max = 100;

    //оценка студента по стобальной системе
    var points100 = (max/maxPoints)*points;

    //приводим к целому числу
    points100 = parseInt(points100,10);
    
    //делаем проверку по 5-бальной системе
    var grade = 0;
    

    //отправка в статистику
    function getResult() {
        var surname = $('#input1').val();
        var name = $('#input2').val();
        var patronymic = $('#input3').val();
        var institute = $('#input4').val();
        var speciality = $('#input5').val();
        var well = $('#input6').val();  

        var namePrepdmet = $('#input5').val();
        var nameTest = $('#input6').val(); 

        $.ajax({
            url: 'function.php',
            method: 'post',
            dataType : "json",
            data: {surname:surname, name:name, patronymic:patronymic, institute:institute, speciality:speciality, well:well, namePrepdmet:namePrepdmet, nameTest:nameTest, grade:grade},
            success: function(data){
                result = data;
            }
        });
    }

    switch(true) { 
        case(points == 0):
        case(points100<25):
            grade = 1;
            getResult();
            alert("Ваша оценка "+grade+"!");
            location.reload();
            break;
        case(points100<49):
            grade = 2;
            getResult();
            alert("Ваша оценка "+grade+"!");
            location.reload();
            break;
        case(points100<74):
            grade = 3;
            getResult();
            alert("Ваша оценка "+grade+"!");
            location.reload();
            break;
        case(points100<89):
            grade = 4;
            getResult();
            alert("Ваша оценка "+grade+"!");
            location.reload();
            break;
        case(points100>89):
            grade = 5;
            getResult();
            alert("Ваша оценка "+grade+"!");
            location.reload();
            break;
    }
}