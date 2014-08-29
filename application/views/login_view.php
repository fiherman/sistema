<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Iniciar Session</title>
<link rel="stylesheet" type="text/css" href="public/css/estilo.css" />
<link rel="stylesheet" href="public/dist/css/bootstrap.css"/>
<link rel="stylesheet" href="public/css/inicio.css"/>


</head>
<body onload="start();">
    <div class="container" id="centrado">
        <div class="row-fluid">
          <div class="col-xs-offset-4 col-xs-4">
            <div class="panel panel-default" style="padding:20px">
              <div class="panel-body">

                  <div class="col-xs-offset-1 col-xs-10 alert alert-success" style="padding:5px;">
                    <center>INICIAR SESSION</center>
                    <?php echo form_open('admin');?>
                  </div>
                  <div class="input-group">                
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user">&nbsp;Usuario.:&nbsp;</span></span>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" style="text-transform: uppercase;">
                  </div><br/>
                  <div class="input-group">                 
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock">&nbsp;Contraseña:</span></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" style="text-transform: uppercase;">
                  </div><br/>            
                  <center><input class="btn btn-info btn-sm" type="submit" name="login" id="btn_login" onclick="" value="Acceder"/></center>
                  <p><?php echo validation_errors('<p class="alert-info">','</p>'); ?></p>

              </div>
            </div>
          </div>
         </div>  
     </div>    
    <div class="fecha">
         <span id="hora"></span><br>
         <span id="dia"></span>
     </div>    
</body>
<script type="text/javascript">   
//function fn_login_usu(){
//    usuario=$.trim($("#username").val().toUpperCase());    
//    pass=$.trim($("#password").val());
//    if(usuario!="" && pass!=""){
//         $.ajax({
//            url:'login/login_verificar/'+usuario,        
//            success: function(data){                
//                if(data.usuario===usuario){                 
//                    $.ajax({
//                            url:'login/get_user_pass/'+usuario+'/'+pass,        
//                            success: function(data){                
//                                if(data.usuario===usuario && data.cpassword===pass){ 
//                                    window.location='principal';
//                                    $.ajax({url:'login/login_session/'+usuario+'/'+data.cpassword+'/'+data.nom_com+'/'+data.consul});                                    
//                                }else if(data.cpassword!=pass){
//                                    mostraralertas('* Contraseña Incorrecta'); 
//                                }                        
//                            }
//                    });                      
//                }                        
//            },
//            error: function (e) {          
//                mostraralertas('* Usuario No Existe'); 
//            }
//        });
//    }else{        
//        mostraralertas('* Llene todos los campos'); 
//    }   
//}
</script>
<script src="public/js/metas.js" type="text/javascript"></script>
<script src="public/js/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="public/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>
<script src="public/js/jquery.blockUI.js" type="text/javascript"></script>
<script src="public/dist/js/jquery.js" type="text/javascript"></script>
<script src="public/dist/js/bootstrap.js" type="text/javascript"></script>
<script src="public/js/inicio.js" type="text/javascript"></script>
<?php include_once 'dialogos.php';?>
</html>                               
