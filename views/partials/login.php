<?php
//include the Form class
require_once('models/Form.php');
$login = new LoginController();
if(isset($_POST['login'])){
    $login->login($_POST['username'], $_POST['password']);
}
?>
<style>
    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .form-signin {
    max-width: 330px;
    padding: 15px;
}
.form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
label {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    text-align: start;
    text-overflow: ellipsis;
    white-space: nowrap;
    pointer-events: none;
    border: var(--bs-border-width) solid transparent;
    transform-origin: 0 0;
    transition: opacity .1s ease-in-out,transform .1s ease-in-out;
}
.form-floating>.form-control, .form-floating>.form-control-plaintext {
    padding: 1rem .75rem;
}
.form-floating>.form-control, .form-floating>.form-control-plaintext, .form-floating>.form-select {
    height: calc(3.5rem + calc(var(1px) * 2));
    line-height: 1.25;
}
form{
    padding: 20px;
    background-color: #fff;
    color: #000;
}
h1.h3.mb-3.fw-normal {
    color: #000;
}
</style>
<div class="text-center w-100">
    <main class="form-signin w-100 m-auto">
        <?php $form = new Form('login', ''); ?>
        <?php $form->open_form(); ?>
        <img class="img-fluid" src="./assets/Logo-OGimage.png" alt="TiAiutoTicino Logo">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
            <?php $form->add_text_input('username'); ?>
        <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>
        <div class="form-floating">
            <?php $form->add_password_input('password'); ?>
        <div data-lastpass-icon-root="true" style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;"></div></div>

        <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div>
        <?php $form->add_submit('login', 'Login'); ?>
        <?php $form->close_form(); ?>
    </main>
</div>
