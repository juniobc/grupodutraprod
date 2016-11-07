<?php 

include_once("../../includes/usergoogle.php");

session_start();

if(!isset($_SESSION['google_data'])):header("Location:logar.php");endif;

$gUser = new Users();

if ($gUser->recupera_user('google',$_SESSION['google_data']['id']) == null){
	header("location: logar.php");
}

?>

<!DOCTYPE html>
<html ang="en">
    
    <head>
        <meta charset="utf-8">
        <title>Administrador</title>
        <meta name="description" content="">
        <meta name="author" content="">
        
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="css/admin.css">
        
        <script src="js/admin.js"></script>
        
        <?php
            if (isset($css) && is_array($css))
              foreach ($css as $path)
                printf('<link rel="stylesheet" type="text/css" href="%s" />', $path);
        ?>
        
        <script src="../js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
        
        <?php
            if (isset($js) && is_array($js))
              foreach ($js as $path)
                printf('<script src="%s"></script>', $path);
        ?>
        
        <link rel="stylesheet" href="../css/jasny-bootstrap.min.css">

        
        <script src="../js/jasny-bootstrap.min.js"></script>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <!--<script src="../js/tinymce.min.js"></script>-->
        
    </head>
    
    <body>
        
        <div class='container'>
    
            <nav class="navbar navbar-default">
              <div class="container-fluid">
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li id='mn_index'><a href="index.php">Segmento</a></li>
                    <li id='mn_classe'><a href="classe.php">Classe</a></li>
					<li id='mn_produto'><a href="produto.php">Produto</a></li>
                    <li id='mn_servico'><a href="servico.php">Servico</a></li>
                  </ul>
				  
				  <ul class="nav navbar-nav navbar-right text-center">
						<li><a href="logout.php?logout">Sair</a></li>
					</ul>
                  
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>