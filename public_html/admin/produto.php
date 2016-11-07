<?php

$js = array('js/produto.js');

include_once('header.php');

?>




<form class="form-horizontal">
    
    <div class="row">
        
        <div class="col-md-10 col-md-offset-0">
        
            <div id='msg_erro' class='alert alert-danger' role='alert'></div>
            <div id='msg_sucesso' class='alert bg-success' role='alert'></div>
			
			<h3 id="hora"></h3>
			<h3 id="minuto"></h3>
			<h3 id="segundo"></h3>
			
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
                        
                    <label for="tl_prod" class="col-xs-2 control-label">Titulo: </label>
                    
                    <div class="col-xs-10">
    
                        <input id="tl_prod" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div class="form-group">
                        
					<label for="tl_prod_comp" class="col-xs-2 control-label">Titulo completo: </label>
					
					<div class="col-xs-10">
	
						<input id="tl_prod_comp" type='text' class="form-control" />
					
					</div>
					
				</div>
				
				<div class="form-group">
                        
					<label for="ds_prod" class="col-xs-2 control-label">Descrição: </label>
					
					<div class="col-xs-10">
	
						<input id="ds_prod" type='text' class="form-control" />
					
					</div>
					
				</div>
				
				<div class="form-group">
                        
					<label for="vl_prod" class="col-xs-2 control-label">Valor: </label>
					
					<div class="col-xs-10">
	
						<input id="vl_prod" type='text' class="form-control" />
					
					</div>
					
				</div>
				
				<div class="form-group">
                        
					<label for="local_prod" class="col-xs-2 control-label">localização: </label>
					
					<div class="col-xs-10">
	
						<input id="local_prod" type='text' class="form-control" />
					
					</div>
					
				</div>
				
				<div class="form-group">
                        
					<label for="pl_ch_prod" class="col-xs-2 control-label">Palavras chaves: </label>
					
					<div class="col-xs-10">
                    
						<textarea id='pl_ch_prod' class="form-control" rows="5" cols="5"></textarea>
					
					</div>
					
				</div>
				
				<div class="form-group">
                        
					<label for="desc_prod_comp" class="col-xs-2 control-label">Descrição completa: </label>
					
					<div class="col-xs-4">
                    
						<textarea id='desc_prod_comp' class="form-control" rows="10" cols="5"></textarea>
					
					</div>
					
				</div>
                
                <div class="form-group">
                    
                    <label for="prod_dest" class="col-xs-2 control-label">Produto destaque:</label>
                
                    <div class="checkbox">
                        <label>
                        <input id="prod_dest" type="checkbox"> 
                        </label>
                    </div>
                
                </div>
				
				<div id="div_img_banner" class="form-group">
                
                    <label for="sel_classe" class="col-xs-2 control-label">Imagem banner:</label>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id='img_banner' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
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
				
				<div class="form-group">
                
                    <label for="sel_classe" class="col-xs-2 control-label">Imagem destaque:</label>
                    
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div id='img_destaque' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
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
				
				<div id="img_prod_ini" class="form-group">
                            
                    <label for="" class="col-xs-2 control-label">Adicionar imagens</label>
                    
                    <div class="col-xs-3">
                        <button id="add_img" type="button" class="btn btn-primary">+</button>
                        <button id="remove_img" type="button" class="btn btn-primary">-</button>
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

<script>tinymce.init({ selector:'#desc_prod_comp',height: 300 });</script>
        
</body>

</html>
