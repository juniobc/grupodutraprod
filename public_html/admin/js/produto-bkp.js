$( document ).ready(function() {
    
    
    $("#sel_seg").change(function(){
        
        apaga_msg();
        
        if($(this).val() != "")
            consulta_classe();
        
    });
    
    $("#incluir").click(function(){
        
        apaga_msg();
        
        if($("#img1").find('img').attr("src") == undefined){
            
            msg_erro("Informe a primeira imagem!");
            
        }else{
            inclui_produto();
        }
        
    });
    
});

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

function inclui_produto(){
    
    var request = $.ajax({
        
        url: "controlador.php",
        method: "POST",
        data: {
            
            'tp_consulta' : 'inclui_produto', 
            'cd_classe' : $("#sel_classe").val(),
            'tl_prod' : $("#tl_prod").val(),
            'tl_prod_comp' : $("#tl_prod_comp").val(),
            'desc_prod' : $("#desc_prod").val(),
            'desc_prod_comp' : get_desc_prod_comp(),
            'img1' : $("#img1").find('img').attr("src"),
            'img2' : $("#img2").find('img').attr("src"),
            'img3' : $("#img3").find('img').attr("src"),
            'img4' : $("#img4").find('img').attr("src"),
            'img5' : $("#img5").find('img').attr("src"),
            'img6' : $("#img6").find('img').attr("src")
            
        },
        dataType: "json",
        success: function(data){
        
            if(data.status == 0){
                msg_erro(data.msg);
            }else{
                msg_sucesso(data.msg);
                $('.fileinput').fileinput('clear');
                $("#tl_prod").val("");
                $("#desc_prod").val("");
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

