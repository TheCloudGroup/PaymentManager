<div id="login_form">
    <h1>Client Login</h1>
<?php $this->load->helper('form');
echo form_open('saasu/login', '');
echo form_input('username', 'Email Address', 'class="login"');
echo form_password('password', 'Password' , 'class="login"');
echo form_submit('Submit', 'Submit');
echo anchor('saasu/forgot_password','Forgot Password');
echo anchor('saasu/signup_form','Sign Up');
echo form_close();?>
<?= validation_errors('<p class="error">')?><br/>
    <img src="<?= base_url(); ?>/application/img/openid.png" align="center" alt="">
    <?= anchor('test','Log In Using OpenID');?>
</div>