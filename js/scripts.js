// Debut du messenger

function cargaSendMail(){
 
 
    $(".c_error").remove();
 
    var filter= /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var s_email = $('#c_mail').val();  
    var s_name = $('#c_name').val();    
    var s_msg = $('#c_msg').val();
    var s_spam_textbox1 = $('#c_spam_textbox1').val();
    var s_spam_textbox2 = $('#c_spam_textbox2').val();
    
    
    if (filter.test(s_email)){
    sendMail = "true";
    
    $('#c_mail').css("border-color","");   	
    } else{
    $('#c_mail').after("<span id='c_error_mail' class='c_error'>Entrez un e-mail valide.</span>");
    $(".c_error").css("color","Red");
    $('#c_mail').css("border-color","Red");   
    sendMail = "false";
    }
    if (s_name.length == 0 ){
    $('#c_name').after( "<span id='c_error_name' class='c_error'>Entrez votre nom.</span>" );
    $(".c_error").css("color","Red");
    $('#c_name').css("border-color","Red");  	
    var sendMail = "false";
    } else{
    $('#c_name').css("border-color","");
    }	
    if (s_msg.length == 0 ){
    $('#c_msg').after( "<span id='c_error_msg' class='c_error'>Entrer un message.</span>" );
    $(".c_error").css("color","Red");
    $('#c_msg').css("border-color","Red");
    var sendMail = "false";
    } else{
    $('#c_msg').css("border-color","");
    }		
    //Si le premier texbox ete vide, blach
    if (s_spam_textbox1.length == 0 ){
        var s_Bot1 = "false";
    } 
    //Si le 2me textbox ete pas modifie
    if (s_spam_textbox2 == "http://" ){
        var s_Bot2 = "false";
    }
    if (s_Bot1 == "false" && s_Bot2 == "false"){
        spamBot = "false";
    }
    else { spamBot = "true"; }
    
    if(sendMail == "true" && spamBot == "false" ){
     
     var datos = {
 
            "nom" : $('#c_nom').val(),  //nom  nombre
 
            "email" : $('#c_mail').val(),   //email email
                                           
            "telephone" : $('#c_telephone').val(), //telephone  telefono
 
            "messenger" : $('#c_msg').val(),  //messenger mensaje
            
            "cenvoyer" : $('#c_envoyer').val()  //cenvoyer  cenviar
             
     };
 
     $.ajax({
 
             data:  datos,
             // ont fait reference ou fichier mail.php
             url:   'mail.php',
 
             type:  'post',
 
             beforeSend: function () {
 
                    $("#c_envoyer").val("Envoi...");
 
             },
 
             success:  function (response) {
 
                    $('form')[0].reset(); 
                    $("#c_envoyer").val("Envoyer message");
                    $("#c_information p").html(response);
                    $("#c_information").css({
                                            "background-color": "#DFF2BF",
                                            "color": "#4F8A10",
                                            "background-image": "url('img/exito.png')"
                    });				
                    $("#c_information").text( "¡Message envoyé correctement!" );
                    $("#c_information").fadeIn('slow');
                    
 
             }
     
     });
 
    }
 
}

$(document).ready(function(){
    $("#btn-login").click(function(){
        $("#modal-login").modal();
    });
});

