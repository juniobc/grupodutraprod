$( document ).ready(function() {
	
	var cont_img = 0;
    
     $( "#mn_produto" ).addClass( "active" );
     
     $(".classe_form").hide();
	 
	 $("#div_img_banner").hide();
     
     $("#sel_seg").change(function(){
         
         apaga_msg();
         
         if($("#sel_seg").val() != "null"){
         
             $(".classe_form").show();
             consulta_classes();
             
         }else{
             //limpar();
         }
         
     });
     
     consulta_segmentos();
	 
	 $("#prod_dest").change(function(){
		 
		if($(this).is(":checked")) {
			$("#div_img_banner").show();
		}else{
			$("#div_img_banner").hide();
		}
		 
	 });
	 
	 $("#add_img").click(function(){
        
        var html = "";
		
		html = html + '<div class="form-group div_img_prod">'
		html = html + '<label for="sel_classe" class="col-xs-2 control-label">Imagem:</label>'
		html = html + '<div class="fileinput fileinput-new" data-provides="fileinput">'
		html = html + '<div class="fileinput fileinput-new" data-provides="fileinput">'
		html = html + '<div class="fileinput-preview thumbnail img_prod" data-trigger="fileinput" style="width: 200px; height: 150px;">'
		html = html + '</div>'
		html = html + '<div>'
		html = html + '<span class="btn btn-default btn-file">'
		html = html + '<span class="fileinput-new">Imagem</span>'
		html = html + '<span class="fileinput-exists">Mudar</span>'
		html = html + '<input type="file">'
		html = html + '</span>'
		html = html + '<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remover</a>'
		html = html + '</div>'
		html = html + '</div>'
		html = html + '</div>'
		html = html + '</div>'
        
        $( html ).insertAfter( "#img_prod_ini" );
        
    });
    
    $("#remove_img").click(function(){
        
        $('.div_img_prod').last().remove();
        
    });
	
	$("#limpar").click(function(){
		
        limpar();
        
    });
	
	$("#incluir").click(function(){
        
        apaga_msg();
        
        if(valida_campos())
            inclui_produto();
        
    });
     
});

function inclui_produto(){
    
    var imgs = "";
    
    mostra_carregar();
    
    /*$(".img_prod").each(function() {
        imgs = imgs + $(this).find('img').attr("src")+";";
    });*/
	
	alert("passou");
	return;
    
    var request = $.ajax({
        
        url: "ctproduto.php",
        method: "POST",
        data: {
            
            'tp_req' : 'cadastra_produto', 
            'cd_seg' : $("#sel_seg").val(),
			'cd_classe' : $("#cd_classe").val(),
			'tl_prod' : $("#tl_prod").val(),
			'tl_prod_comp' : $("#tl_prod_comp").val(),
			'ds_prod' : $("#ds_prod").val(),
			'vl_prod' : $("#vl_prod").val(),
			'local_prod' : $("#local_prod").val(),
			'pl_ch_prod' : $("#pl_ch_prod").val(),
			'desc_prod_comp' : get_desc_prod_comp(),
			'prod_dest' : $("#prod_dest").is(':checked'),
			'img_banner' : $("#img_banner").find('img').attr("src"),
			'img_destaque' : $("#img_destaque").find('img').attr("src"),
            'imgs' : imgs
            
        },
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                msg_sucesso(data.msg);
                limpar();
                consulta_segmentos()
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      esconde_carregar();
      msg_erro(jqXHR.responseText);
    });
    
}

function limpar(){
	
	$("#sel_seg").val("null");
	$("#sel_classe").val("null");
	$("#tl_prod").val("");
	$("#tl_prod_comp").val("");
	$("#ds_prod").val("");
	$("#vl_prod").val("");
	$("#local_prod").val("");
	$("#pl_ch_prod").val("");
	
	tinyMCE.get('desc_prod_comp').setContent("");
	
	$('.fileinput').fileinput('clear');
	
	$("#div_img_banner").hide();
	    
    $('.div_img_prod').remove();
	
	$(".classe_form").hide();
	
	
}

function valida_campos(){
	
	if($("#sel_classe").val() == "null"){
        
        msg_erro("Informe uma classe!");
        return false;
        
    }

	if($("#tl_prod").val() == ""){
        
        msg_erro("Informe o titulo do produto!");
        return false;
        
    }
	
	if($("#tl_prod_comp").val() == ""){
        
        msg_erro("Informe o titulo completo do produto!");
        return false;
        
    }
	
	if($("#ds_prod").val() == ""){
        
        msg_erro("Informe a descrição do produto!");
        return false;
        
    }
	
	if($("#vl_prod").val() == ""){
        
        msg_erro("Informe o valor do produto!");
        return false;
        
    }
	
	if($("#local_prod").val() == ""){
        
        msg_erro("Informe a localização do produto!");
        return false;
        
    }
	
	if($("#pl_ch_prod").val() == ""){
        
        msg_erro("Informe as palavras chaves do produto!");
        return false;
        
    }
	
	if($("#pl_ch_prod").val() == ""){
        
        msg_erro("Informe as palavras chaves do produto!");
        return false;
        
    }
	
	if(get_desc_prod_comp() == ""){
        
        msg_erro("Informe a descrição completa do produto!");
        return false;
        
    }
	
	if($("#prod_dest").is(":checked")){
		if($("#img_banner").find('img').attr("src") == undefined){
			msg_erro("Informe a imagem banner do produto!");
		}
	}
	
	if($("#img_destaque").find('img').attr("src") == undefined){
		
		msg_erro("Informe a imagem de destaque do produto!");
        return false;
		
	}
	
	return true;	
	
}

function get_desc_prod_comp(){
    
    // Get the HTML contents of the currently active editor
    tinyMCE.activeEditor.getContent();
    
    // Get the raw contents of the currently active editor
    tinyMCE.activeEditor.getContent({format : 'raw'});
    
    console.log(tinyMCE.get('desc_prod_comp').getContent());
    
    // Get content of a specific editor:
    return tinyMCE.get('desc_prod_comp').getContent();
    
    //tinyMCE.get('desc_prod_comp').setContent("teste")
    
}

function consulta_classes(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctclasse.php",
        method: "POST",
        data: {
            
            'tp_req' : 'consulta_classes', 
            'cd_seg' : $("#sel_seg").val()
            
        },
        
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                
                $('#sel_classe').find('option').remove();
                
                $('#sel_classe').append($('<option>', { 
                    value: "null",
                    text : "SELECIONE UMA CLASSE"
                }));
                
                $.each(data.msg, function (i, item) {
                    
                    $('#sel_classe').append($('<option>', { 
                        value: i,
                        text : item
                    }));
                });
                
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      esconde_carregar();
      msg_erro(jqXHR.responseText);
    });
    
}

function consulta_segmentos(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctsegmento.php",
        method: "POST",
        data: {
            
            'tp_req' : 'consulta_segmentos', 
            'cd_seg' : $("#sel_seg").val()
            
        },
        
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                
                $('#sel_seg').find('option').remove();
                
                $('#sel_seg').append($('<option>', { 
                    value: "null",
                    text : "SELECIONE UM SEGMENTO"
                }));
                
                $.each(data.msg, function (i, item) {
                    
                    $('#sel_seg').append($('<option>', { 
                        value: i,
                        text : item
                    }));
                });
                
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      esconde_carregar();
      msg_erro(jqXHR.responseText);
    });
    
}