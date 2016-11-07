<?php

$erro_msg = null;

$con = pg_connect("host=localhost dbname=grupodutra user=ubuntu password=postgres");

$segmentos = pg_query("SELECT * FROM t001");

$js = array('js/produto.js');

include_once('header.php');

?>

    
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
                        
                        <label for="sel_classe" class="col-xs-2 control-label">Titulo 1: </label>
                        
                        <div class="col-xs-10">
        
                            <input id="tl_prod" type='text' class="form-control" />
                        
                        </div>
                        
                    </div>
                    
                    <div class="form-group div_prod">
                        
                        <label for="sel_classe" class="col-xs-2 control-label">Titulo 2: </label>
                        
                        <div class="col-xs-10">
        
                            <input id="tl_prod_comp" type='text' class="form-control" />
                        
                        </div>
                        
                    </div>
                    
                    <div class="form-group div_prod">
                        
                        <label for="txt_desc" class="col-xs-2 control-label">Descrição 1: </label>
                        
                        <div class="col-xs-10">
                    
                            <textarea id='desc_prod'class="form-control" rows="<5></5>"></textarea>
                        
                        </div>
                    
                    </div>
                    
                    <input type="button" onclick="get_desc_prod_comp()" value="teste" />
                    
                    <div class="form-group div_prod">
                        
                        <label for="txt_desc" class="col-xs-2 control-label">Descrição 2: </label>
                        
                        <div class="col-xs-4">
                    
                            <textarea id='desc_prod_comp' class="form-control" rows="10" cols="5"></textarea>
                        
                        </div>
                    
                    </div>
<?php
            
            }
        
?>

            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-xs-9 col-xs-offset-2">
                
                <div class="form-group div_prod">
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img1' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                              
                          </div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img2' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img3' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                          <div>
                           <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img4' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img5' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id='img6' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                          <div>
                            <span class="btn btn-default btn-file">
                                <span class="fileinput-new">Imagem</span>
                                <span class="fileinput-exists">Mudar</span>
                                <input type="file">
                            </span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>
                          </div>
                        </div>

                    </div>
                    
                    </div>
                
                
            </div>
            
        </div>
        
        <div class="row">
            
            <div class="col-xs-5 col-xs-offset-5 ">
                
                <div class="form-group div_prod center-block">
                
                    <button id="incluir" type="button" class="btn btn-primary">Incluir</button>
                
                </div>
                
            </div>
            
        </div>
    
    </form>

</div>
        
</body>

</html>