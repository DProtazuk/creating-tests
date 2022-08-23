<?php include($_SERVER['DOCUMENT_ROOT']."/script-php/link-connect.php"); ?>

<div class="div_header">
    <div class="header_menu">
        <div class="header_menu_logo">
            <span class="header_menu_logo_span">logo</span> 
        </div>

        <div class="header_menu_buts">
            <button class="header_menu_buts_button">Главная</button>
            <button class="header_menu_buts_button">Тесты</button>
        </div>
    </div>

    <div class="header_vxod">
        <?php include($_SERVER['DOCUMENT_ROOT']."/script-php/script-but_vxod.php"); ?>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Система Входа</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="div_modal">
            <input id="inp_log_auth" placeholder="Введите Логин" class="form-control div_modal_input" type="text">
            <input id="inp_pass_auth" placeholder="Введите Пароль" class="form-control div_modal_input" type="text">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="button_auth" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>