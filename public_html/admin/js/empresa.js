$( document ).ready(function() {
    
    
    $("#sel_seg").change(function(){
        
        apaga_msg();
        
        if($(this).val() != "")
            consulta_classe();
        
    });
    
    $("#incluir").click(function(){
        
        apaga_msg();
        
        /*if($("#desc_empresa").val() == ""){
            
            msg_erro("Informe a descrição da empresa!");
            
        }else if($("#desc_missao").val() == ""){
            
            ("Informe a descrição da missao!");
            
        }else if($("#desc_valor").val() == ""){
            
            ("Informe a descrição do valor!");
            
        }else if($("#desc_visao").val() == ""){
            
            ("Informe a descrição da visao!");
            
        }else{*/
            inclui_produto();
        //}
        
    });
    
});

function get_desc_empresa(){
    
    // Get the HTML contents of the currently active editor
    tinyMCE.activeEditor.getContent();
    
    // Get the raw contents of the currently active editor
    tinyMCE.activeEditor.getContent({format : 'raw'});
    
    // Get content of a specific editor:
    return tinyMCE.get('desc_empresa').getContent();
    
    //tinyMCE.get('desc_prod_comp').setContent("teste")
    
}

function get_desc_visao(){
    
    // Get the HTML contents of the currently active editor
    tinyMCE.activeEditor.getContent();
    
    // Get the raw contents of the currently active editor
    tinyMCE.activeEditor.getContent({format : 'raw'});
    
    // Get content of a specific editor:
    return tinyMCE.get('desc_visao').getContent();
    
    //tinyMCE.get('desc_prod_comp').setContent("teste")
    
}

function get_desc_valor(){
    
    // Get the HTML contents of the currently active editor
    tinyMCE.activeEditor.getContent();
    
    // Get the raw contents of the currently active editor
    tinyMCE.activeEditor.getContent({format : 'raw'});
    
    // Get content of a specific editor:
    return tinyMCE.get('desc_valor').getContent();
    
    //tinyMCE.get('desc_prod_comp').setContent("teste")
    
}

function get_desc_missao(){
    
    // Get the HTML contents of the currently active editor
    tinyMCE.activeEditor.getContent();
    
    // Get the raw contents of the currently active editor
    tinyMCE.activeEditor.getContent({format : 'raw'});
    
    // Get content of a specific editor:
    return tinyMCE.get('desc_missao').getContent();
    
    //tinyMCE.get('desc_prod_comp').setContent("teste")
    
}

function inclui_produto(){
    
    var request = $.ajax({
        
        url: "controlador.php",
        method: "POST",
        data: {
            
            'tp_consulta' : 'inclui_desc_empresa', 
            'cd_classe' : $("#sel_classe").val(),
            'desc_empresa' : get_desc_empresa(),
            'desc_visao' : get_desc_empresa(),
            'desc_missao' : get_desc_empresa(),
            'desc_valor' : get_desc_empresa()
            
        },
        dataType: "json",
        success: function(data){
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                msg_sucesso(data.msg);
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      msg_erro(jqXHR.responseText);
    });
    
    
}


function consulta_classe(){
    
    var request = $.ajax({
      url: "controlador.php",
      method: "POST",
      data: {'tp_consulta' : 'consulta_classe', 'cd_seg' : $("#sel_seg").val() },
      dataType: "json",
      success: function(data){
        
        if(data.status == 0){
            
            $("#class_div").hide();
            $(".div_prod").hide();
            $("#msg_erro").html(data.msg);
            $("#msg_erro").show();
            
        }else{
            
            $('#sel_classe').find('option').remove();
            
            $.each(data.msg, function(index, row) {
                
                $('#sel_classe').append($('<option>', { 
                    value: row['cd_classe'],
                    text : row['nm_classe']
                }));
                
            });
            
            $("#class_div").show();
            $(".div_prod").show();
            
        }
        
      }
    });
     
    request.fail(function( jqXHR, textStatus ) {
      $("#msg_erro").html(jqXHR.responseText);
      $("#msg_erro").show();
    });
    
}

function msg_erro(msg){
    
    $("#msg_erro").html(msg);
    $("#msg_erro").show();
    
}

function apaga_msg(){
    
    $("#msg_erro").hide();
    $("#msg_sucesso").hide();
    
}

function msg_sucesso(msg){
    
    $("#msg_sucesso").html(msg);
    $("#msg_sucesso").show();
}