<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LOGIN CODEIGNITER</title>

</head>
<style>
    label{ display: block}
    .errors{  color: red  }
</style>
<body>

<h1>LOGIN</h1>
<?php echo form_open('admin');?>
<p>
    <?php
    echo form_label('usuario:','usuario');
    echo form_input('usuario',  set_value(),'id="txtusuario"');
    ?>    
</p>
<p>
    <?php
    echo form_label('Pass:','password');
    echo form_password('password','','id="txtpassword"');
    ?>
</p>
<p>
    <?php
    echo form_submit('Submit','Acceder');
    ?>
<?php echo form_close();?>

</p>
<div class="errors"><?php echo validation_errors();?></div>
</body>
</html>
