<div id="login_form">
    <h1>Provider Login</h1>
   
<?php    echo form_open('admin/login', '');
echo form_input('login_username', 'Email Address', 'class="login"');
echo form_password('login_password', 'Password' , 'class="login"');
echo form_submit('Submit', 'Submit');
echo anchor('saasu/forgot_password','Forgot Password');?>
</div>
