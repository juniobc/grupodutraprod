<?php

$js = array('js/segmento.js');

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
                        
                        <option value="null">CRIAR NOVO SEGMENTO</option>
                
                    </select>
                
                </div>
            
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Nome:</label>
                
                <div class="col-xs-7">

                    <input id="nm_seg" type='text' class="form-control" /> 
                
                </div>
            </div>
    
            <!--<div class="form-group">
            
                <label for="sel_classe" class="col-xs-2 control-label">Logomarca:</label>
                
                <div class="fileinput fileinput-new" data-provides="fileinput">
                
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div id='logo_seg' class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
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
            
            </div>-->
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Facebook:</label>
                
                <div class="col-xs-10">

                    <input id="face_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Twitter:</label>
                
                <div class="col-xs-10">

                    <input id="twitter_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Instagram:</label>
                
                <div class="col-xs-10">

                    <input id="inst_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Pinterest:</label>
                
                <div class="col-xs-10">

                    <input id="pinter_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Youtube:</label>
                
                <div class="col-xs-10">

                    <input id="ytube_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                        
                <label for="sel_classe" class="col-xs-2 control-label">Google Plus:</label>
                
                <div class="col-xs-10">

                    <input id="google_seg" type='text' class="form-control" />
                
                </div>
                
            </div>
            
            <div class="form-group">
                            
                    <label for="tel_tim" class="col-xs-2 control-label">Tel tim:</label>
                    
                    <div class="col-xs-10">
    
                        <input id="tel_tim" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div class="form-group">
                            
                    <label for="tel_vivo" class="col-xs-2 control-label">Tel vivo:</label>
                    
                    <div class="col-xs-10">
    
                        <input id="tel_vivo" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div class="form-group">
                            
                    <label for="tel_claro" class="col-xs-2 control-label">Tel claro:</label>
                    
                    <div class="col-xs-10">
    
                        <input id="tel_claro" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div class="form-group">
                            
                    <label for="tel_oi" class="col-xs-2 control-label">Tel oi:</label>
                    
                    <div class="col-xs-10">
    
                        <input id="tel_oi" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div class="form-group">
                            
                    <label for="tel_whpp" class="col-xs-2 control-label">Whatsapp:</label>
                    
                    <div class="col-xs-10">
    
                        <input id="tel_whpp" type='text' class="form-control" />
                    
                    </div>
                    
                </div>
                
                <div id="email_seg_ini" class="form-group">
                            
                    <label for="whpp_classe" class="col-xs-2 control-label">Adicionar email</label>
                    
                    <div class="col-xs-3">
                        <button id="add_email" type="button" class="btn btn-primary">+</button>
                        <button id="remove_email" type="button" class="btn btn-primary">-</button>
                    </div>
                    
                </div>


        </div>
        
    </div>
    
    
    <div class="row">
        
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

