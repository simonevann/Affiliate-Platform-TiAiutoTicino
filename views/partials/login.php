<?php
//include the Form class
require_once('models/Form.php');
$login = new LoginController();
if(isset($_POST['login'])){
    $login->login($_POST['username'], $_POST['password']);
}
?>
<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div class="m-3 p-3 border">
                <h1>Login</h1>

                <?php $form = new Form('login', ''); ?>
                <?php $form->open_form(); ?>
                <?php $form->add_text_input('username'); ?>
                <?php $form->add_password_input('password'); ?>
                <?php $form->add_submit('login', 'Login'); ?>
                <?php $form->close_form(); ?>

                </div>
        </div>
    </div>
</div>