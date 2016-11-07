<?php 

include_once('ctfuncoes.php');

$cd_classe = trim($_POST['cd_classe']);
$cd_seg = trim($_POST['cd_seg']);
$tl_serv = trim($_POST['tl_serv']);
$ds_serv = trim($_POST['ds_serv']);
$img_serv = $_POST['img_serv'];


switch($_POST['tp_req']){
    
    case 'cadastra_servico':
        echo cadastra_servico();
        break;
    
}


function cadastra_servico(){
    
    global $cd_classe, $ds_serv, $img_serv, $tl_serv;
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
    
    $sql = "select * from t003 where cd_classe = ".$cd_classe." and nm_pag = 'SERVICO'";
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    if (pg_num_rows($result) == 0){
            
        $sql = " insert into t003 (cd_classe, nm_pag) values(".$cd_classe.", 'SERVICO') RETURNING cd_pag";
    
        $result = pg_query(
            $sql
        );
        
        if ($result === false) {
            pg_query("ROLLBACK") or die("Transaction rollback failed\n");
            return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
        }
        
        $result = pg_fetch_row($result);
        
        $sql = " insert into t004 (cd_pag, nm_tp_contd) values(".$result[0].", 'SERVICO') RETURNING cd_tp_contd";
    
        $result_tp_contd = pg_query(
            $sql
        );
        
        if ($result_tp_contd === false) {
            
            pg_query("ROLLBACK") or die("Transaction rollback failed\n");
            return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
        }
        
        $result_tp_contd = pg_fetch_row($result_tp_contd);
        
    }else{
        
        $result = pg_fetch_row($result);
        
        $sql = " insert into t004 (cd_pag, nm_tp_contd) values(".$result["cd_pag"].", 'SERVICO') RETURNING cd_tp_contd";
    
        $result_tp_contd = pg_query(
            $sql
        );
        
        if ($result_tp_contd === false) {
            
            pg_query("ROLLBACK") or die("Transaction rollback failed\n");
            return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
            
        }
        
        $result_tp_contd = pg_fetch_row($result_tp_contd);
        
    }
    
    $sql = " insert into t005 (tl_contd, ds_contd, img_contd) values('".$tl_serv."', '".$ds_serv."', '".$img_serv."') RETURNING cd_contd";
    
    $result_contd = pg_query(
        $sql
    );
    
    if ($result_contd === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    $result_contd = pg_fetch_row($result_contd);
    
    $sql = " insert into t006 (cd_tp_contd, cd_contd) values(".$result_tp_contd[0].", ".$result_contd[0].")";
    
    $result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Servico Incluido com sucesso!");
    
}



?>