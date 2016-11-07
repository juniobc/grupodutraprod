<?php

$js = array('js/servico.js');

include_once('header.php');

?>




<form class="form-horizontal">
    
    <div class="row">
        
        <div class="col-md-10 col-md-offset-0">
        
            <div id='msg_erro' class='alert alert-danger' role='alert'></div>
            <div id='msg_sucesso' class='alert bg-success' role='alert'></div>
            <button id="carregando" class="btn btn-lg btn-warning oculta btn_carregando">
                <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Carregando...
            </button>
            
            <div class="form-group">
                        
                <label for="sel_seg" class="col-xs-2 control-label">Segmento: </label>
                
                <div class="col-xs-10">

                    <select id='sel_seg' class="form-control">
                        
                        <option value="null">SELECIONE UM SEGMENTO</option>
                
                    </select>
                
                </div>
            
            </div>
            
            <div class="classe_form">
            
                <div class="form-group">
                            
                    <label for="sel_classe" class="col-xs-2 control-label">Classes: </label>
                    
                    <div class="col-xs-10">
    
                        <select id='sel_classe' class="form-control">
                            
                            <option value="null">SELECIONE UMA CLASSE</option>
                    
                        </select>
                    
                    </div>
                
                </div>
                
                <div class="form-group">
                            
                    <label for="tl_serv" class="col-xs-2 control-label">Titulo:</label>
                    
                    <div class="col-xs-7">
    
                        <input id="tl_serv" type='text' class="form-control" /> 
                    
                    </div>
                </div>
                
                <div class="form-group">
                            
                    <label for="ds_serv" class="col-xs-2 control-label">Descrição:</label>
                    
                    <div class="col-xs-10">
    
                        <textarea id="ds_serv" class="form-control" rows="4"></textarea>
                    
                    </div>
                </div>
        
                <div class="form-group">
                
                    <label for="sel_classe" class="col-xs-2 control-label">Imagem:</label>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id='img_serv' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
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
                
                </div>
            
            </div>


        </div>
        
    </div>
    
    
    <div class="classe_form" class="row">
        
        <div class="col-xs-5 col-xs-offset-5 ">
            
            <div class="form-group center-block">
            
                <button id="incluir" type="button" class="btn btn-primary">Incluir</button>
                
                <button id="alterar" type="button" class="btn btn-primary" disabled>Alterar</button>
                
                <button id="excluir" type="button" class="btn btn-primary" disabled>Excluir</button>
                
                <button id="limpar" type="button" class="btn btn-primary">Limpar</button>
            
            </div>
            
        </div>
        
    </div>

</form>





</div>
        
</body>

</html>
