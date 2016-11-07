<?php 

include_once('ctfuncoes.php');

$cd_seg = trim($_POST['cd_seg']);
$nm_seg = mb_strtoupper(trim($_POST['nm_seg']), 'UTF-8');
$face_seg = strtoupper(trim($_POST['face_seg']));
$twitter_seg = strtoupper(trim($_POST['twitter_seg']));
$inst_seg = strtoupper(trim($_POST['inst_seg']));
$pinter_seg = strtoupper(trim($_POST['pinter_seg']));
$ytube_seg = strtoupper(trim($_POST['ytube_seg']));
$google_seg = strtoupper(trim($_POST['google_seg']));

$tel_tim = $_POST['tel_tim'];
$tel_vivo = $_POST['tel_vivo'];
$tel_claro = $_POST['tel_claro'];
$tel_oi = $_POST['tel_oi'];
$tel_whpp = $_POST['tel_whpp'];
$emails = strtoupper($_POST['emails']);


switch($_POST['tp_req']){
    
    case 'cadastra_segmento':
        echo cadastra_segmento();
        break;
        
    case 'consulta_seg_codigo':
        echo consulta_seg_codigo();
        break;
        
    case 'alterar_segmento':
        echo alterar_segmento();
        break;
        
    case 'consulta_segmentos':
        echo consulta_segmentos();
        break;
        
    case 'excluir_segmento':
        echo excluir_segmento();
        break;
    
}

function excluir_segmento(){
    
    global $cd_seg;
    
    $con = abre_banco();
        
    $sql = "delete from t001 where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, "Segmento Excluido com sucesso!");
    
}

function consulta_segmentos(){
    
    $segmento = array();
    
    $con = abre_banco();
    
    $sql = "select * from t001";
    
    $result = pg_query(
        $sql
    );
    
    while ($row = pg_fetch_assoc($result)) {
            
        $segmento[$row['cd_seg']] = $row['nm_seg'];
        
    }
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    pg_close($con);
    
    return retorna_msg(1, $segmento);
    
}

function alterar_segmento(){
    
    global $nm_seg, $face_seg, $twitter_seg, $inst_seg , $pinter_seg, $ytube_seg, $google_seg, $tel_tim,$tel_vivo,
    $tel_claro,$tel_oi,$tel_whpp,$emails;
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
        
    $sql = "update t001 set nm_seg = '".$nm_seg."', md_face = '".$face_seg."', md_twitter = '".$twitter_seg."', md_instag = '".$inst_seg."',
    md_pinter = '".$pinter_seg."', md_ytube = '".$ytube_seg."', md_google = '".$google_seg."' ";
    if($tel_tim != "") $sql = $sql . ", tel_tim = '".$tel_tim."'";
    if($tel_vivo != "") $sql = $sql . ", tel_vivo = '".$tel_vivo."'";
    if($tel_claro != "") $sql = $sql . ", tel_claro = '".$tel_claro."'";
    if($tel_oi != "") $sql = $sql . ", tel_oi = '".$tel_oi."'";
    if($tel_whpp != "") $sql = $sql . ", tel_whpp = '".$tel_whpp."'";
    $sql = $sql ." where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    $sql = "delete from t009 where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    $array_email = explode(";", $emails);
    
    foreach($array_email as &$email){
        
        if($email != ""){
        
            $sql = " insert into t009 (cd_seg, ds_email) values(".$cd_seg.", '".$email."')";
            
            $result = pg_query(
                $sql
            );
            
            if ($result === false) {
                pg_query("ROLLBACK") or die("Transaction rollback failed\n");
                return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
            }
            
        }
    }
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Segmento Alterado com sucesso!");
    
}

function consulta_seg_codigo(){
    
    global $cd_seg;
    
    $segmento = array();
    
    $con = abre_banco();
    
    $sql = "select * from t001 where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    while ($row = pg_fetch_assoc($result)) {
            
        $segmento['cd_seg'] = $row['cd_seg'];
        $segmento['nm_seg'] = $row['nm_seg'];
        $segmento['md_face'] = $row['md_face'];
        $segmento['md_twitter'] = $row['md_twitter'];
        $segmento['md_instag'] = $row['md_instag'];
        $segmento['md_pinter'] = $row['md_pinter'];
        $segmento['md_ytube'] = $row['md_ytube'];
        $segmento['md_google'] = $row['md_google'];
        $segmento['tel_whpp'] = $row['tel_whpp'];
        $segmento['tel_tim'] = $row['tel_tim'];
        $segmento['tel_vivo'] = $row['tel_vivo'];
        $segmento['tel_oi'] = $row['tel_oi'];
        $segmento['tel_claro'] = $row['tel_claro'];
        
    }
    
    $sql = "select * from t009 where cd_seg = ".$cd_seg;
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
        
    $segmento['emails'] = pg_fetch_all($result);
    
    pg_close($con);
    
    return retorna_msg(1, $segmento);
    
}


function cadastra_segmento(){
    
    global $nm_seg, $face_seg, $twitter_seg, $inst_seg , $pinter_seg, $ytube_seg, $google_seg, $tel_tim,$tel_vivo,
    $tel_claro,$tel_oi,$tel_whpp,$emails;
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
    
    $sql = " insert into t001 (nm_seg, md_face, md_twitter, md_instag, md_pinter, md_ytube, md_google, tel_whpp, tel_tim, tel_vivo, tel_oi, tel_claro)
        values('".$nm_seg."', '".$face_seg."', '".$twitter_seg."', '".$inst_seg."', '".$pinter_seg."', '".$ytube_seg."', '".$google_seg."',";
    if($tel_tim == "") $sql = $sql . "null,"; else $sql = $sql . "'".$tel_tim."',";
    if($tel_vivo == "") $sql = $sql . "null,"; else $sql = $sql . "'".$tel_vivo."',";
    if($tel_claro == "") $sql = $sql . "null,"; else $sql = $sql . "'".$tel_claro."',";
    if($tel_oi == "") $sql = $sql . "null,"; else $sql = $sql . "'".$tel_oi."',";
    if($tel_whpp == "") $sql = $sql . "null) RETURNING cd_seg"; else $sql = $sql . "'".$tel_whpp."') RETURNING cd_seg";
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    $result_seg = pg_fetch_row($result);
    
    $array_email = explode(";", $emails);
    
    foreach($array_email as &$email){
        
        if($email != ""){
        
            $sql = " insert into t009 (cd_seg, ds_email) values(".$result_seg[0].", '".$email."')";
            
            $result = pg_query(
                $sql
            );
            
            if ($result === false) {
                pg_query("ROLLBACK") or die("Transaction rollback failed\n");
                return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
            }
            
        }
    }
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Segmento Incluido com sucesso!");
    
}


?>