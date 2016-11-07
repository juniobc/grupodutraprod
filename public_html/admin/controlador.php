<?php

 //echo json_encode($_POST['cd_seg']); {"a":1,"b":2,"c":3,"d":4,"e":5}

switch($_POST['tp_consulta']){
    
    case 'consulta_classe':
        echo consulta_classe($_POST['cd_seg']);
        break;
        
    case 'inclui_produto':
        
        $array_img = array(
            
            "img1" => $_POST['img1'],
            "img2" => $_POST['img2'],
            "img3" => $_POST['img3'],
            "img4" => $_POST['img4'],
            "img5" => $_POST['img5'],
            "img6" => $_POST['img6'],
        
        
        );
        
        echo inclui_produto($_POST['cd_classe'], $_POST['tl_prod'], $_POST['tl_prod_comp'], $_POST['desc_prod'], $_POST['desc_prod_comp'], $array_img);
        break;
        
    case 'consulta_produto':
        echo consulta_produto($_POST['cd_classe']);
        break;
        
    case 'remove_imagem':
        echo remove_imagem($_POST['cd_prod'], $_POST['cd_img'], $_POST['img_prinp']);
        break;
        
    case 'inclui_desc_empresa':
        echo inclui_desc_empresa($_POST['cd_classe'], $_POST['desc_empresa'], $_POST['desc_visao'], $_POST['desc_missao'], $_POST['desc_valor']);
        break;
    
}

function inclui_desc_empresa($cd_classe, $desc_empresa, $desc_visao, $desc_missao, $desc_valor){
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
    
    $pagina = pg_query(
        "select * from t003 where nm_pag = 'EMPRESA'"
    );
    
    if (pg_num_rows($pagina) == 0) {
    
        $result = pg_query(
            " insert into t003 (cd_classe, nm_pag) values(".$cd_classe.", 'EMPRESA') RETURNING cd_pag"
        );
        
        $pag_result = pg_fetch_row($result);
        
    }
    
    $tp_conteudo = pg_query(
        "select * from t004 where nm_tp_contd = 'EMPRESA'"
    );
    
    if (pg_num_rows($tp_conteudo) == 0) {
    
        $result = pg_query(
            " insert into t004 (cd_pag, nm_tp_contd) values(".$pag_result[0].", 'EMPRESA') RETURNING cd_tp_contd"
        );
        
        $tp_contd_result = pg_fetch_row($result);
        
    }
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    //return retorna_msg(1, " insert into t005 (tl_contd, ds_contd) values('EMPRESA', '".$desc_empresa."') RETURNING cd_contd");
    
    $result = pg_query(
        " insert into t005 (tl_contd, ds_contd) values('EMPRESA', '".$desc_empresa."') RETURNING cd_contd"
    );
    
    $contd_result = pg_fetch_row($result);
    
    pg_query(
        " insert into t006 (cd_tp_contd, cd_contd) values(".$tp_contd_result[0].", ".$contd_result[0].")"
    );
    ////////////////////////////////////////////
    $result = pg_query(
        " insert into t005 (tl_contd, ds_contd) values('VISAO', '".$desc_visao."') RETURNING cd_contd"
    );
    
    $contd_result = pg_fetch_row($result);
    
    pg_query(
        " insert into t006 (cd_tp_contd, cd_contd) values(".$tp_contd_result[0].", ".$contd_result[0].")"
    );
    ////////////////////////////////////////////
    $result = pg_query(
        " insert into t005 (tl_contd, ds_contd) values('MISSAO', '".$desc_missao."') RETURNING cd_contd"
    );
    
    $contd_result = pg_fetch_row($result);
    
    pg_query(
        " insert into t006 (cd_tp_contd, cd_contd) values(".$tp_contd_result[0].", ".$contd_result[0].")"
    );
    ////////////////////////////////////////////
    $result = pg_query(
        " insert into t005 (tl_contd, ds_contd) values('VALOR', '".$desc_valor."') RETURNING cd_contd"
    );
    
    $contd_result = pg_fetch_row($result);
    
    pg_query(
        " insert into t006 (cd_tp_contd, cd_contd) values(".$tp_contd_result[0].", ".$contd_result[0].")"
    );
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Empresa Incluido com sucesso");
}


function inclui_produto($cd_classe, $tl_prod, $tl_prod_comp, $desc_prod, $desc_prod_comp, $array_img){
    
    if(trim("".$cd_classe) == ""){
        return retorna_msg(0, "Informe a classe!");
    }
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
    
    //if(trim("".$tl_prod) == ""){
    //    $tl_prod = "null";
    //}
    //
    //if(trim("".$desc_prod) == ""){
    //    $desc_prod = "null";
    //}
    
    /*echo " insert into t007 (cd_classe, tl_prod, ds_prod, prod_dest, tl_prod_comp, ds_prod_comp) values(".$cd_classe.", '".
        strtoupper($tl_prod)."', '".strtoupper($desc_prod)."', false, '".strtoupper($tl_prod_comp)."', '".strtoupper($desc_prod_comp)."')";
        
        exit(1);*/
    
    pg_query(
        " insert into t007 (cd_classe, tl_prod, ds_prod, prod_dest, tl_prod_comp, ds_prod_comp) values(".$cd_classe.", '".
        strtoupper($tl_prod)."', '".strtoupper($desc_prod)."', false, '".strtoupper($tl_prod_comp)."', '".strtoupper($desc_prod_comp)."')"
    );
    
    $produto = pg_query(
        "select max(cd_prod) as cd_prod from t007"
    );
    
    while ($row = pg_fetch_assoc($produto)) {
            
        $cd_prod =  $row["cd_prod"];
        
    }
    
    foreach($array_img as $indice =>$valor){
        
        if(trim("".$valor) != ""){
            
            if($indice == "img1"){
                $img_prinp = "true";
            }else{
                $img_prinp = "false";
            }
            
            pg_query(
                "insert into t008 (cd_prod, prod_img, ds_prod, img_prinp) values(".$cd_prod.", '".$valor."', null, ".$img_prinp.")"
            );
            
        }
        
    }
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Produto Incluido com sucesso");
    
}

function abre_banco(){
    return pg_connect("host=localhost dbname=grupodutra user=ubuntu password=postgres");
}

function remove_imagem($cd_prod, $cd_img, $img_prinp){
    
    if(trim("".$cd_img) == ""){
        return retorna_msg(0, "Informe o codigo da imagem!");
    }
    
    $con = abre_banco();
    
    pg_query("BEGIN") or die("Could not start transaction\n");
    
    if(strtoupper($img_prinp) == "TRUE"){
        
        $img_prinp = pg_query("SELECT * FROM t008 where img_prinp = 'false'");
        
        if (pg_num_rows($img_prinp) == 0) {
            
            pg_query(
                " delete from t008 where cd_img = ".$cd_img
            );
            
            pg_query(
                " delete from t007 where cd_prod = ".$cd_prod
            );
            
        }else{
            
            pg_close($con);
            
            return retorna_msg(0, "Remova primeiro as imagens nao principal!");
            
        }
        
    }else{
        
        pg_query(
            " delete from t008 where cd_img = ".$cd_img
        );
        
    }
    
    //pg_query("ROLLBACK") or die("Transaction rollback failed\n");
    
    pg_query("COMMIT") or die("Transaction commit failed\n");
    
    pg_close($con);
    
    return retorna_msg(1, "Imagem removida com sucesso!");
    
}

function consulta_produto($cd_classe){
    
    if(trim("".$cd_classe) == ""){
        retorna_msg(0, "Informe a classe!");
    }
    
    $con = abre_banco();
    
    $produto = array();
    
    $ds_produto = pg_query("SELECT * FROM t007 where cd_classe = ".$cd_classe);
    
    
    if (pg_num_rows($ds_produto) == 0) {
        
        return retorna_msg(0, "Nenhum produto cadastrado para esta classe!");
        
    }else{
    
        while ($row = pg_fetch_assoc($ds_produto)) {
            
            $produto[$row["cd_prod"]]["ds_produto"] = $row;
            
        }
    
    }
    
    foreach($produto as $value){
        
        $img_produto = pg_query("SELECT * FROM t008 where cd_prod = ".$value["ds_produto"]["cd_prod"]);
        
        while ($row = pg_fetch_assoc($img_produto)) {
            
            $produto[$value["ds_produto"]["cd_prod"]]["ds_img"][$row["cd_img"]] = $row;
            
        }
        
    }
    
    pg_close($con);
    
    return retorna_msg(1, $produto);
    
    //$img_produto = pg_query("SELECT * FROM t008 where cd_classe = ".$cd_classe);
    
}

function consulta_classe($cd_seg){
    
    $con = abre_banco();
    
    $cont = 0;
    
    $classe = pg_query("SELECT * FROM t002 where seg_prinp = false and cd_seg = ".$cd_seg);
    
    pg_close($con);
    
    if (pg_num_rows($classe) == 0) {
        
        return json_encode(array('status' => 0, 'msg' => 'Nenhuma classe encontrada para este segmento'));
    }else{
    
        while ($row = pg_fetch_assoc($classe)) {
            
            $array_json[$cont] =  $row;
            
            $cont ++;
            
        }
        
        return json_encode(array('status' => 1, 'msg' => $array_json));
    
    }
    
}

function retorna_msg($status, $msg){
    return json_encode(array('status' => $status, 'msg' => $msg));
}

?>