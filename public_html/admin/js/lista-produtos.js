$( document ).ready(function() {
    
    $("#sel_seg").change(function(){
        
        if($(this).val() != "")
            consulta_classe();
        
    });
    
    $("#sel_classe").change(function(){
        
        if($(this).val() != "")
            consulta_produto();
        
    });
    
});

function consulta_produto(){
    
    apaga_msg();
    $("#products").html("");
    
    var request = $.ajax({
      url: "controlador.php",
      method: "POST",
      data: {'tp_consulta' : 'consulta_produto', 'cd_classe' : $("#sel_classe").val() },
      dataType: "json",
      success: function(data){
        
        if(data.status == 0){
            
            $("#msg_erro").html(data.msg);
            $("#msg_erro").show();
            
        }else{
            
            var cd_prod, tl_prod, tl_prod_comp, ds_prod, ds_prod_comp, cd_img;
            var flag_cd_prod = "";
            
            $.each(data.msg, function(index, row) {
                
                cd_prod = row["ds_produto"]["cd_prod"];
                tl_prod = row["ds_produto"]["tl_prod"];
                tl_prod_comp = row["ds_produto"]["tl_prod_comp"];
                ds_prod = row["ds_produto"]["ds_prod"];
                ds_prod_comp = row["ds_produto"]["ds_prod_comp"];
                ds_prod_comp = row["ds_produto"]["ds_prod_comp"];
                
                
                $.each(row["ds_img"], function(index, row){
                    
                    cd_img = index;
                    
                    html = "<div class='item  col-xs-4 col-lg-4'>";
                    
                    if(row["img_prinp"] == "true"){
                        flag_cd_prod = cd_prod;
                        html += "<div class='thumbnail' style='background-color:green'>";
                    }else{
                        html += "<div class='thumbnail' style='background-color:white'>";
                    }
                    html += "<img class='group list-group-image' style='width:400px, height:250px' width='400px' height='250px' src='"+row['prod_img']+"' alt='' />";
                    html += "<div class='caption'>";
                    html += "<h4 class='group inner list-group-item-heading'><fieldset style='border:2px solid black'><legend>cd_prod: "+cd_prod+"</legend>"+tl_prod+"</fieldset>";
                    html += "</br></br>"+tl_prod_comp+"</h4>";
                    html += "<p class='group inner list-group-item-text'>";
                    html += ds_prod;
                    html += "</br></br>"+ds_prod_comp;
                    html += "<div class='row'>";
                    /*html += "<div class='col-xs-12 col-md-6'>";
                    html += "<p class='lead'>$21.000</p>";
                    html += "</div>";*/
                    html += "<div class='col-xs-12 col-md-6'>";
                    html += "<a class='btn btn-success' href='javascript:remove_prod("+cd_prod+","+cd_img+", "+row['img_prinp']+")'>Remover</a>";
                    html += "</div></div></div></div></div>";
                    
                    $("#products").append(html);
                    
                });
                
            });
            
        }
        
      }
    });
     
    request.fail(function( jqXHR, textStatus ) {
      $("#msg_erro").html(jqXHR.responseText);
      $("#msg_erro").show();
    });
    
}

function remove_prod(cd_prod, cd_img, img_prinp){
    
    apaga_msg();
    
    var request = $.ajax({
      url: "controlador.php",
      method: "POST",
      data: {'tp_consulta' : 'remove_imagem', 'cd_img' : cd_img, 'cd_prod' :  cd_prod, 'img_prinp' : img_prinp},
      dataType: "json",
      success: function(data){
        
        if(data.status == 0){
            
            $("#msg_erro").html(data.msg);
            $("#msg_erro").show();
            
        }else{
            
            msg_sucesso(data.msg);
            
            consulta_produto();
            
        }
        
      }
    });
     
    request.fail(function( jqXHR, textStatus ) {
      $("#msg_erro").html(jqXHR.responseText);
      $("#msg_erro").show();
    });
    
}

function consulta_classe(){
    
    apaga_msg();
    $("#products").html("");
    
    var request = $.ajax({
      url: "controlador.php",
      method: "POST",
      data: {'tp_consulta' : 'consulta_classe', 'cd_seg' : $("#sel_seg").val() },
      dataType: "json",
      success: function(data){
        
        if(data.status == 0){
            
            $("#class_div").hide();
            $("#msg_erro").html(data.msg);
            $("#msg_erro").show();
            
        }else{
            
            $('#sel_classe').find('option').remove();
            
            $('#sel_classe').append($('<option>', { 
                    value: "",
                    text : "SELECIONE UMA CLASSE"
            }));
            
            $.each(data.msg, function(index, row) {
                
                $('#sel_classe').append($('<option>', { 
                    value: row['cd_classe'],
                    text : row['nm_classe']
                }));
                
            });
            
            $("#class_div").show();
            
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