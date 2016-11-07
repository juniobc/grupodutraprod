$( document ).ready(function() {
    
    $( "#mn_servico" ).addClass( "active" );
    
    $(".classe_form").hide();
    
    $("#sel_seg").change(function(){
         
         apaga_msg();
         
         if($("#sel_seg").val() != "null"){
         
             $(".classe_form").show();
             
             consulta_classes();
             
         }else{
             $(".classe_form").hide();
         }
         
     });
     
     $("#limpar").click(function(){
        
        limpar();
        
    });
    
    $("#incluir").click(function(){
        
        apaga_msg();
        
        if(valida_campos())
            inclui_servico();
        
    });
     
    consulta_segmentos();
     
});

function inclui_servico(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctservico.php",
        method: "POST",
        data: {
            
            'tp_req' : 'cadastra_servico', 
            'cd_seg' : $("#sel_seg").val(),
            'cd_classe' : $("#sel_classe").val(),
            'tl_serv' : $("#tl_serv").val(),
            'ds_serv' : $("#ds_serv").val(),
            'img_serv' : $("#img_serv").find('img').attr("src")
            
        },
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                msg_sucesso(data.msg);
                limpar();
                consulta_segmentos();
            }
            
        }
        
    });
    
    request.fail(function( jqXHR, textStatus ) {
      esconde_carregar();
      msg_erro(jqXHR.responseText);
    });
    
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

function limpar(){
    
    $("#sel_seg").val("null");
    $("#sel_classe").val("null");
    $("#ds_serv").val("");
    
    $('.fileinput').fileinput('clear');
    
    $(".classe_form").hide();
    
}

function valida_campos(){
    
    if($("#sel_classe").val() == "null"){
        
        msg_erro("Informe uma classe!");
        return false;
        
    }
    
    if($("#tl_serv").val() == ""){
        
        msg_erro("Informe o titulo do serviço!");
        return false;
        
    }
    
    if($("#ds_serv").val() == ""){
        
        msg_erro("Informe a descrição do serviço!");
        return false;
        
    }
    
    if($("#img_serv").find('img').attr("src") == undefined){
        
        msg_erro("Informe a imagem do serviço!");
        return false;
        
    }
    
    return true;
    
    
}