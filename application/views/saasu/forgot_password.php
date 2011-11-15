<div class='content'>
    <h2>Forgot Your Password Fool!</h2>
<?= 'hello world' ?>
    <?=form_open('saasu/password_reset');?>
    <?=form_input('email','email')?>
    <?=form_input('confirm_email','confirm email')?>
    <?=form_submit('Submit','Submit')?>
    <?=form_close()?>
</div>

