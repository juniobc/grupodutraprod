$( document ).ready(function() {
    
     $( "#mn_classe" ).addClass( "active" );
     
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
     
     $("#incluir").click(function(){
        
        apaga_msg();
        
        if(valida_campos())
            inclui_classe();
        
    });
    
    $("#limpar").click(function(){
        
        limpar();
        
    });
    
    $("#sel_classe").change(function(){
        
        apaga_msg();
        
        
        if($("#sel_classe").val() != "null"){
            consulta_classe_codigo();
        }else{
            limpar();
        }
        
    });
    
    $("#alterar").click(function(){
        
        apaga_msg();
        
        if(valida_campos())
            altera_classe();
        
    });
    
    $("#excluir").click(function(){
        
        apaga_msg();
        
        excluir_classe();
        
    });
    
    consulta_segmentos();
    
});

function excluir_classe(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctclasse.php",
        method: "POST",
        data: {
            
            'tp_req' : 'excluir_classe', 
            'cd_classe' : $("#sel_classe").val(),
            
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

function altera_classe(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctclasse.php",
        method: "POST",
        data: {
            
            'tp_req' : 'alterar_classe', 
            'cd_classe' : $("#sel_classe").val(),
            'cd_seg' : $("#sel_seg").val(),
            'nm_classe' : $("#nm_classe").val(),
            'log_classe' : $("#logo_classe").find('img').attr("src"),
            'prod_classe' : $("#prod_classe").val(),
            'ordem_classe' : $("#ordem_classe").val(),
            'url_classe' : $("#url_classe").val(),
            'tel_tim' : $("#tel_tim").val(),
            'tel_vivo' : $("#tel_vivo").val(),
            'tel_claro' : $("#tel_claro").val(),
            'tel_oi' : $("#tel_oi").val(),
            'whpp_classe' : $("#whpp_classe").val(),
            'class_prinp' : $("#class_prinp").is(':checked')
            
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

function consulta_classe_codigo(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctclasse.php",
        method: "POST",
        data: {
            
            'tp_req' : 'consulta_classe_codigo', 
            'cd_classe' : $("#sel_classe").val()
            
        },
        
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                
                $("#nm_classe").val(data.msg['nm_classe']);
                $("#url_classe").val(data.msg['url_classe']);
                $("#prod_classe").val(data.msg['tp_prod']);
                $("#ordem_classe").val(data.msg['ordem_classe']);
                
                $('.fileinput').fileinput('clear');
                
                $('.fileinput').removeClass('fileinput-new');
                $('.fileinput').addClass('fileinput-exists');
                
                $('.fileinput-preview').prepend('<img src="'+data.msg['classe_logo']+'" />')
                
                if(data.msg['seg_prinp'] == "t")
                    $('#class_prinp').prop('checked', true);
                else
                    $('#class_prinp').prop('checked', false);
                    
                //<img src="<?php echo $row["prod_img"]; ?>" width="100%" height="350" alt="...">
                
                
                
                $("#incluir").prop("disabled", true);
                $("#alterar").prop("disabled", false);
                $("#excluir").prop("disabled", false);
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
                    text : "CRIAR NOVA CLASSE"
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

function inclui_classe(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctclasse.php",
        method: "POST",
        data: {
            
            'tp_req' : 'cadastra_classe', 
            'cd_seg' : $("#sel_seg").val(),
            'nm_classe' : $("#nm_classe").val(),
            'log_classe' : $("#logo_classe").find('img').attr("src"),
            'prod_classe' : $("#prod_classe").val(),
            'ordem_classe' : $("#ordem_classe").val(),
            'url_classe' : $("#url_classe").val(),
            'tel_tim' : $("#tel_tim").val(),
            'tel_vivo' : $("#tel_vivo").val(),
            'tel_claro' : $("#tel_claro").val(),
            'tel_oi' : $("#tel_oi").val(),
            'whpp_classe' : $("#whpp_classe").val(),
            'class_prinp' : $("#class_prinp").is(':checked')
            
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

function valida_campos(){
    
    if($("#nm_classe").val() == ""){
            
        msg_erro("Informe o nome da classe!");
        return false;
        
    }
    
    if($("#logo_classe").find('img').attr("src") == undefined){
        
        msg_erro("Informe a logomarca!");
        return false;
        
    }
    
    if($("#prod_classe").val() == ""){
            
        msg_erro("Informe o produto da classe!");
        return false;
        
    }
    
    if($("#ordem_classe").val() == ""){
            
        msg_erro("Informe a ordem da classe!");
        return false;
        
    }
    
    if($("#url_classe").val() == ""){
            
        msg_erro("Informe a url da classe!");
        return false;
        
    }
    
    return true;
    
}

function limpar(){
    
    $("#incluir").prop("disabled", false);
    $("#alterar").prop("disabled", true);
    $("#excluir").prop("disabled", true);
    
    $("#sel_seg").val("null");
    $("#sel_classe").val("null");
    
    $("#nm_classe").val("");
    
    $("#prod_classe").val("");
    $("#ordem_classe").val("");
    $("#url_classe").val("");
    
    $('#class_prinp').prop('checked', false);
    
    $('.fileinput').fileinput('clear');
    
    $(".classe_form").hide();
    
}