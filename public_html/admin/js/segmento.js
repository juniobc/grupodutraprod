$( document ).ready(function() {
    
    $( "#mn_index" ).addClass( "active" );
    
    $("#incluir").click(function(){
        
        apaga_msg();
        
        if(valida_segmento())
            inclui_segmento();
        
    });
    
     $("#limpar").click(function(){
        
        limpar();
        
    });
    
    $("#sel_seg").change(function(){
        
        apaga_msg();
        
        
        if($("#sel_seg").val() != "null"){
            consulta_seg_codigo();
        }else{
            limpar();
            $("#incluir").prop("disabled", false);
            $("#alterar").prop("disabled", true);
            $("#excluir").prop("disabled", true);
        }
        
    });
    
    $("#alterar").click(function(){
        
        apaga_msg();
        
        if(valida_segmento())
            altera_segmento();
        
    });
    
    $("#excluir").click(function(){
        
        apaga_msg();
        
        excluir_segmento();
        
    });
    
    $("#add_email").click(function(){
        
        var html = "";
        
        html = html + '<div class="div_email_seg form-group">';
        html = html + '<label for="whpp_classe" class="col-xs-2 control-label">Email:</label>';
        html = html + '<div class="col-xs-7">';
        html = html + '<input type="text" class="form-control email_seg" />';
        html = html + '</div>';
        html = html + '</div>';
        
        $( html ).insertAfter( "#email_seg_ini" );
        
    });
    
    $("#remove_email").click(function(){
        
        $('.div_email_seg').last().remove();
        
    });
    
    consulta_segmentos();
    
});

function excluir_segmento(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctsegmento.php",
        method: "POST",
        data: {
            
            'tp_req' : 'excluir_segmento', 
            'cd_seg' : $("#sel_seg").val(),
            
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
                    text : "CRIAR NOVO SEGMENTO"
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

function altera_segmento(){
    
    mostra_carregar();
    
    $(".email_seg").each(function() {
        emails = emails + $(this).val()+";";
    });
    
    var request = $.ajax({
        
        url: "ctsegmento.php",
        method: "POST",
        data: {
            
            'tp_req' : 'cadastra_segmento', 
            'nm_seg' : $("#nm_seg").val(),
            'face_seg' : $("#face_seg").val(),
            'twitter_seg' : $("#twitter_seg").val(),
            'inst_seg' : $("#inst_seg").val(),
            'pinter_seg' : $("#pinter_seg").val(),
            'ytube_seg' : $("#ytube_seg").val(),
            'google_seg' : $("#google_seg").val(),
            'tel_tim' : $("#tel_tim").val(),
            'tel_vivo' : $("#tel_vivo").val(),
            'tel_claro' : $("#tel_claro").val(),
            'tel_oi' : $("#tel_oi").val(),
            'tel_whpp' : $("#tel_whpp").val(),
            'emails' : emails
            
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

function consulta_seg_codigo(){
    
    mostra_carregar();
    
    var request = $.ajax({
        
        url: "ctsegmento.php",
        method: "POST",
        data: {
            
            'tp_req' : 'consulta_seg_codigo', 
            'cd_seg' : $("#sel_seg").val()
            
        },
        
        dataType: "json",
        success: function(data){
            
            esconde_carregar();
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                
                $("#nm_seg").val(data.msg['nm_seg']);
                $("#face_seg").val(data.msg['md_face']);
                $("#twitter_seg").val(data.msg['md_twitter']);
                $("#inst_seg").val(data.msg['md_instag']);
                $("#pinter_seg").val(data.msg['md_pinter']);
                $("#ytube_seg").val(data.msg['md_ytube']);
                $("#google_seg").val(data.msg['md_google']);
                
                $("#tel_whpp").val(data.msg['tel_whpp']);
                $("#tel_tim").val(data.msg['tel_tim']);
                $("#tel_vivo").val(data.msg['tel_vivo']);
                $("#tel_oi").val(data.msg['tel_oi']);
                $("#tel_claro").val(data.msg['tel_claro']);
                
                $.each(data.msg.emails, function(i, item){
                    
                    var html = "";
        
                    html = html + '<div class="div_email_seg form-group">';
                    html = html + '<label for="whpp_classe" class="col-xs-2 control-label">Email:</label>';
                    html = html + '<div class="col-xs-7">';
                    html = html + '<input type="text" value="'+item["ds_email"]+'" class="form-control email_seg" />';
                    html = html + '</div>';
                    html = html + '</div>';
                    
                    $( html ).insertAfter( "#email_seg_ini" );
                    
                });
                
                
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


function inclui_segmento(){
    
    var emails = "";
    
    mostra_carregar();
    
    $(".email_seg").each(function() {
        emails = emails + $(this).val()+";";
    });
    
    var request = $.ajax({
        
        url: "ctsegmento.php",
        method: "POST",
        data: {
            
            'tp_req' : 'cadastra_segmento', 
            'nm_seg' : $("#nm_seg").val(),
            'face_seg' : $("#face_seg").val(),
            'twitter_seg' : $("#twitter_seg").val(),
            'inst_seg' : $("#inst_seg").val(),
            'pinter_seg' : $("#pinter_seg").val(),
            'ytube_seg' : $("#ytube_seg").val(),
            'google_seg' : $("#google_seg").val(),
            'tel_tim' : $("#tel_tim").val(),
            'tel_vivo' : $("#tel_vivo").val(),
            'tel_claro' : $("#tel_claro").val(),
            'tel_oi' : $("#tel_oi").val(),
            'tel_whpp' : $("#tel_whpp").val(),
            'emails' : emails
            
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


function valida_segmento(){
    
    if($("#nm_seg").val() == ""){
            
        msg_erro("Informe o nome do segmento!");
        return false;
        
    }
    
    if($("#face_seg").val() == ""){
            
        msg_erro("Informe o facebook do segmento!");
        return false;
        
    }
    
    if($("#twitter_seg").val() == ""){
            
        msg_erro("Informe o twitter do segmento!");
        return false;
        
    }
    
    if($("#inst_seg").val() == ""){
            
        msg_erro("Informe o instagram do segmento!");
        return false;
        
    }
    
    if($("#pinter_seg").val() == ""){
            
        msg_erro("Informe o pinterest do segmento!");
        return false;
        
    }
    
    if($("#ytube_seg").val() == ""){
            
        msg_erro("Informe o youtube do segmento!");
        return false;
        
    }
    
    if($("#google_seg").val() == ""){
            
        msg_erro("Informe o google plus do segmento!");
        return false;
        
    }
    
    return true;
    
}

function limpar(){
    
    $("#incluir").prop("disabled", false);
    $("#alterar").prop("disabled", true);
    $("#excluir").prop("disabled", true);
    
    $("#nm_seg").val("");
    
    $("#face_seg").val("");
    
    $("#twitter_seg").val("");
    
    $("#inst_seg").val("");
    
    $("#pinter_seg").val("");
    
    $("#ytube_seg").val("");
    
    $("#google_seg").val("");
    
    $("#sel_seg").val("null");
    
    $("#tel_tim").val("");
    
    $("#tel_vivo").val("");
    
    $("#tel_claro").val("");
    
    $("#tel_oi").val("");
    
    $("#tel_whpp").val("");
    
    $(".email_seg").each(function() {
        $(this).val("");
    });
    
    $('.div_email_seg').remove();
    
}