<?php 


function abre_banco(){
    return pg_connect("host=mikedutra.postgresql.dbaas.com.br dbname=mikedutra user=mikedutra password=esmorfe2");
}


function retorna_msg($status, $msg){
    return json_encode(array('status' => $status, 'msg' => $msg));
}


?>