<?php
session_start();
include_once("login-google/Google_Client.php");
include_once("login-google/contrib/Google_Oauth2Service.php");
######### edit details ##########
$clientId = '445693296018-ln12u1iplpcp1sejp12a7fa9o48pihu6.apps.googleusercontent.com'; //Google CLIENT ID
$clientSecret = 'I5NWOUx5G8qDgBVJhyvBNloo'; //Google CLIENT SECRET
$redirectUrl = 'http://grupodutra.com.br/admin/cadastro.php';  //return url (url to script)
$homeUrl = 'http://grupodutra.com.br/admin/cadastro.php';  //return to home

##################################

$gClient = new Google_Client();
$gClient->setApplicationName('grupodutra');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>