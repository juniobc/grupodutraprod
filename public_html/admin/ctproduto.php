<?php 

include_once('ctfuncoes.php');

$cd_prod = trim($_POST['cd_prod']);
$cd_classe = trim($_POST['cd_classe']);
$cd_seg = trim($_POST['cd_seg']);
$tl_prod = mb_strtoupper(trim($_POST['tl_prod']), 'UTF-8');
$tl_prod_comp = mb_strtoupper(trim($_POST['tl_prod_comp']), 'UTF-8');
$ds_prod = mb_strtoupper(trim($_POST['ds_prod']), 'UTF-8');
$vl_prod = mb_strtoupper(trim($_POST['vl_prod']), 'UTF-8');
$local_prod = mb_strtoupper(trim($_POST['local_prod']), 'UTF-8');
$pl_ch_prod = mb_strtoupper(trim($_POST['pl_ch_prod']), 'UTF-8');
$desc_prod_comp = trim($_POST['desc_prod_comp']);
$prod_dest = strtoupper(trim($_POST['prod_dest']));
$img_banner = trim($_POST['img_banner']);
$img_destaque = trim($_POST['img_destaque']);
$imgs = trim($_POST['imgs']);

switch($_POST['tp_req']){
    
    case 'cadastra_produto':
        echo cadastra_produto();
        break;
    
}

function cadastra_produto(){
		
	global $cd_classe, $cd_seg, $tl_prod, $tl_prod_comp, $ds_prod, $vl_prod, $local_prod, $pl_ch_prod, $desc_prod_comp, 
	$prod_dest, $img_banner, $img_destaque, $imgs;
	
	$con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
	
	
	
	$sql = "insert into t007 (cd_classe, tl_prod, ds_prod, local_prod, vl_prod, pl_ch_prod, prod_dest,";
	$sql = $sql . "tl_prod_comp, ds_prod_comp, dt_cad_prod) values(";
	
	$sql = $sql . " ".$cd_classe.", ";
	$sql = $sql . " '".$tl_prod."', ";
	$sql = $sql . " '".$ds_prod."', ";
	$sql = $sql . " '".$local_prod."', ";
	$sql = $sql . " '".$vl_prod."', ";
	$sql = $sql . " '".$pl_ch_prod."', ";
	$sql = $sql . " '".$prod_dest."', ";
	$sql = $sql . " '".$tl_prod_comp."', ";
	$sql = $sql . " '".$desc_prod_comp."', ";
	$sql = $sql . " '20161107' ";
	
	$sql = $sql . ") returning cd_prod ";
	
	$result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
        
    $seg_result = pg_fetch_assoc($result);
	
	$sql = "insert into t008 (cd_prod, prod_img, img_prinp, dt_cad_img) values(";
	
	$sql = $sql . " ".$cd_prod.", ";
	$sql = $sql . " '".$img_banner."', ";
	//$sql = $sql . " '".$img_prinp."', ";
	$sql = $sql . " 'FALSE', ";
	$sql = $sql . " '20161107' ";
	
	$sql = $sql . ") ";
	
	$result = pg_query(
        $sql
    );
    
    if ($result === false) {
        
        pg_query("ROLLBACK") or die("Transaction rollback failed\n");
        return retorna_msg(0, pg_last_error($con)." </br>SQL enviada: ".$sql);
    }
	
	pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    //pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Segmento Incluido com sucesso!");
	
}


?>