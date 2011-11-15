<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
  <body>
     <?$this->load->helper('form');?>
     <?=form_open('blog/form').form_input('stuff').form_submit('submit','submit');?>
      <?=$title;?>
  </body>
</html>