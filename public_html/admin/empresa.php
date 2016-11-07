<?php 

$erro_msg = null;

$con = pg_connect("host=localhost dbname=grupodutra user=ubuntu password=postgres");

$segmentos = pg_query("SELECT * FROM t001");


?>


<!DOCTYPE html>
<html ang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Administrador</title>
        <meta name="description" content="">
        <meta name="author" content="">
        
        <link href="../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <script src="../js/jquery-1.12.1.min.js"></script>
        <script src="../css/bootstrap/js/bootstrap.js"></script>
        <script src="js/empresa.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/admin.css">
        <link rel="stylesheet" type="text/css" href="css/empresa.css">
        
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'#desc_empresa' });</script>
        <script>tinymce.init({ selector:'#desc_valor' });</script>
        <script>tinymce.init({ selector:'#desc_missao' });</script>
        <script>tinymce.init({ selector:'#desc_visao' });</script>
        
    </head>
    
    <body>
        <div class='container'>
            
            <nav class="navbar navbar-default">
              <div class="container-fluid">
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li><a href="index.php">Cadastrar Produto</a></li>
                    <li><a href="lista-produtos.php">Listar Produtos</a></li>
                    <li class="active"><a href="empresa.php">Empresa</a></li>
                  </ul>
                  
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            
            
            <form class="form-horizontal">
            
                <div class="row">
                    
                    <div class="col-xs-10 col-xs-offset-0">
                    
                        <div id='msg_erro' class='alert alert-danger' role='alert'></div>
                        <div id='msg_sucesso' class='alert bg-success' role='alert'></div>
                
<?php 
                        if(!$segmentos){
                        
                            $erro_msg = "<div class='alert alert-danger' role='alert'>Ocorreu um erro tente novamente mais tarde!</div>";
                        
                        }else if(pg_num_rows($segmentos) == 0){
                            $erro_msg = "<div class='alert alert-danger' role='alert'>Nenhum segmento cadastrado!</div>";
                        }else{
                    
                    
?>

                        
                            
                            <div class="form-group">
                                
                                <label for="sel_seg" class="col-xs-2 control-label">Segmento: </label>
                                
                                <div class="col-xs-10">
                
                                    <select id='sel_seg' class="form-control">
                                        
                                        <option value="">SELECIONE UM SEGMENTO</option>
                                
<?php

                                        while ($row = pg_fetch_assoc($segmentos)) {
                                            
                                            echo "<option value='".$row['cd_seg']."'>".$row['nm_seg']."</option>";
                                            
                                        }

?>
                                
                                    </select>
                                
                                </div>
                            
                            </div>
                            
                            <div id='class_div' class="form-group">
                                
                                <label for="sel_classe" class="col-xs-2 control-label">Classe: </label>
                                
                                <div class="col-xs-10">
                
                                    <select id='sel_classe' class="form-control"></select>
                                
                                </div>
                            
                            </div>
                            
                            <div class="form-group div_prod">
                                
                                <label for="txt_desc" class="col-xs-2 control-label">Empresa: </label>
                                
                                <div class="col-xs-10">
                            
                                    <textarea id='desc_empresa'class="form-control" rows="<5></5>"></textarea>
                                
                                </div>
                            
                            </div>
                            
                            <div class="form-group div_prod">
                                
                                <label for="txt_desc" class="col-xs-2 control-label">Visao: </label>
                                
                                <div class="col-xs-10">
                            
                                    <textarea id='desc_visao'class="form-control" rows="<5></5>"></textarea>
                                
                                </div>
                            
                            </div>
                            
                            <div class="form-group div_prod">
                                
                                <label for="txt_desc" class="col-xs-2 control-label">Valores: </label>
                                
                                <div class="col-xs-10">
                            
                                    <textarea id='desc_valor'class="form-control" rows="<5></5>"></textarea>
                                
                                </div>
                            
                            </div>
                            
                            <div class="form-group div_prod">
                                
                                <label for="txt_desc" class="col-xs-2 control-label">Missao: </label>
                                
                                <div class="col-xs-10">
                            
                                    <textarea id='desc_missao'class="form-control" rows="<5></5>"></textarea>
                                
                                </div>
                            
                            </div>
                            
                            <div class="row">
                    
                                <div class="col-xs-5 col-xs-offset-5 ">
                                    
                                    <div class="form-group div_prod center-block">
                                    
                                        <button id="incluir" type="button" class="btn btn-primary">Incluir</button>
                                    
                                    </div>
                                    
                                </div>
                                
                            </div>
<?php
                    
                    }
                
?>
        
                </div>
     
     
         </div>       
    </body>