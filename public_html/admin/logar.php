<?php

include_once("../../includes/config.php");
include_once("../../includes/usergoogle.php");

if(isset($_REQUEST['code'])){
	$gClient->authenticate();
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectUrl1, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
  
	$userProfile = $google_oauthV2->userinfo->get();
	
	$gUser = new Users();
	
	if ($gUser->recupera_user('google',$userProfile['id']) != null){
		$_SESSION['google_data'] = $userProfile; // Storing Google User Data in Session
		$_SESSION['token'] = $gClient->getAccessToken();
		header("location: index.php");
	}else{
		header("location: logout.php");
	}
	
}

$authUrl = $gClient->createAuthUrl();

if(isset($authUrl)) {
?>




<html>
  
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Grupo Dutra Admin</title>
  
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="../font-awesome/css/font-awesome.css">
  
  <link rel="stylesheet" type="text/css" href="css/index.css">
  
  
  <script src="../js/jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  
  
  <script type="text/javascript">
    
    function entrar(){
      
      document.location.href = "<?php echo $authUrl ?>";
      
    }
    
  </script>
  
  
</head>
<style>
   
   
</style>
<body>
  
<div class="container">

  <div class="omb_login">
  
    <h3 class="omb_authTitle">Administrador Grupo Dutra</h3>
    <div class="row omb_row-sm-offset-3 omb_socialButtons text-center">
      <div class="col-xs-12 visible-xs">
		  <a href="javascript:entrar()" class="btn btn-lg btn-block omb_btn-google">
			<i class="fa fa-google-plus visible-xs"></i>
		  </a>
      </div>	
	  <div class="col-xs-6 col-xs-offset-3 hidden-xs">
		  <a href="javascript:entrar()" class="btn btn-lg btn-block omb_btn-google">
			<span>Google+</span>
		  </a>
      </div>	
    </div>
    
  </div>


</div>

</body>
</html>



	
<?php
} else {
	echo '<a href="logout.php?logout">Logout</a>';
}

?>