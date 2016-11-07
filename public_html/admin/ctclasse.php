<?php 

include_once('ctfuncoes.php');

$cd_classe = trim($_POST['cd_classe']);
$cd_seg = trim($_POST['cd_seg']);
$nm_classe = mb_strtoupper(trim($_POST['nm_classe']), 'UTF-8');
$log_classe = $_POST['log_classe'];
$prod_classe = mb_strtoupper(trim($_POST['prod_classe']), 'UTF-8');
$ordem_classe = $_POST['ordem_classe'];
$url_classe = strtoupper(trim($_POST['url_classe']));
$class_prinp = strtoupper(trim($_POST['class_prinp']));

switch($_POST['tp_req']){
    
    case 'cadastra_classe':
        echo cadastra_classe();
        break;
        
    case 'consulta_classes':
        echo consulta_classes();
        break;
        
    case 'consulta_classe_codigo':
        echo consulta_classe_codigo();
        break;
        
    case 'alterar_classe':
        echo alterar_classe();
        break;
        
    case 'excluir_classe':
        echo excluir_classe();
        break;
    
}

function excluir_classe(){
    
    global $cd_classe;
    
    $con = abre_banco();
        
    $sql = "delete from t002 where cd_classe = ".$cd_classe;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, "Classe Excluida com sucesso!");
    
}

function alterar_classe(){
    
    global $cd_seg, $cd_classe, $nm_classe, $log_classe, $prod_classe, $url_classe, $ordem_classe, $class_prinp;
    
    $con = abre_banco();
    
    if($class_prinp == "TRUE"){
        
        $sql = "select * from t002 where cd_seg = ".$cd_seg." and seg_prinp = 'true' and cd_classe <> ".$cd_classe;
        
        $result = pg_query(
            $sql
        );
        
        if ($result === false) {
            
            return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
        }
        
        if (pg_num_rows($result) != 0){
			            
            $result_ordem = pg_fetch_assoc($result);
        
			return retorna_msg(0, "Ordem já cadastrada para a classe ".$result_ordem["nm_classe"]."!");
            
        }
        
    }
            
    $sql = "update t002 set cd_seg = ".$cd_seg.", nm_classe = '".$nm_classe."',";
    if($class_prinp == "TRUE"){
        $sql = $sql. "seg_prinp = 'true', ";
    }else{
        $sql = $sql. "seg_prinp = 'false', ";
    }
    $sql = $sql. " url_classe = '".$url_classe."', tp_prod = '".$prod_classe."', classe_logo = '".$log_classe."', ";
    $sql = $sql. " ordem_classe = ".$ordem_classe;
    $sql = $sql. " where cd_classe = ".$cd_classe;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, "Classe Alterado com sucesso!");
    
}

function consulta_classe_codigo(){
    
    global $cd_classe;
    
    $classe = array();
    
    $con = abre_banco();
    
    $sql = "select * from t002 where cd_classe = ".$cd_classe;
    
    $result = pg_query(
        $sql
    );
    
    while ($row = pg_fetch_assoc($result)) {
            
        $classe['cd_classe'] = $row['cd_classe'];
        $classe['cd_seg'] = $row['cd_seg'];
        $classe['nm_classe'] = $row['nm_classe'];
        $classe['seg_prinp'] = $row['seg_prinp'];
        $classe['url_classe'] = $row['url_classe'];
        $classe['tp_prod'] = $row['tp_prod'];
        $classe['ordem_classe'] = $row['ordem_classe'];
        $classe['classe_logo'] = $row['classe_logo'];
        
    }
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, $classe);
    
}

function consulta_classes(){
    
    global $cd_seg;
    
    $classes = array();
    
    $con = abre_banco();
    
    $sql = "select * from t002 where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    while ($row = pg_fetch_assoc($result)) {
            
        $classes[$row['cd_classe']] = $row['nm_classe'];
        
    }
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, $classes);
    
}

function cadastra_classe(){
    
    global $cd_seg, $nm_classe, $log_classe, $prod_classe, $url_classe,$ordem_classe,$class_prinp;
    
    $con = abre_banco();
    
    if($class_prinp == "TRUE"){
        
        $sql = "select * from t002 where cd_seg = ".$cd_seg." and seg_prinp = 'true' ";
        
        $result = pg_query(
            $sql
        );
        
        if ($result === false) {
            
            return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
        }
        
        if (pg_num_rows($result) != 0){
            
            return retorna_msg(0, "Já existe uma classe principal para este segmento!");
            
        }
        
    }
    
    $sql = "select * from t002 where ordem_classe = ".$ordem_classe;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    if (pg_num_rows($result) != 0){
        
        $result_ordem = pg_fetch_assoc($result);
        
        return retorna_msg(0, "Ordem já cadastrada para a classe ".$result_ordem["ordem_classe"]."!");
        
    }
        
    $sql = "insert into t002 (cd_seg, nm_classe, seg_prinp, url_classe, tp_prod, classe_logo, ordem_classe)";
    $sql = $sql. " values(";
    $sql = $sql. $cd_seg.", '".$nm_classe."', ";
    if($class_prinp == "TRUE"){
        $sql = $sql. "'true', ";
    }else{
        $sql = $sql. "'false', ";
    }
    $sql = $sql. "'".$url_classe."', '".$prod_classe."', '".$log_classe."', ";
    $sql = $sql.$ordem_classe.")";
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, "Classe Incluida com sucesso!");
    
}


?>