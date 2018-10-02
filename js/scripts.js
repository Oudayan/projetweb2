/* 
 Chat
*/

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//obtient l'état du chat
function getStateOfChat(){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "Chat/process.php",
			   data: {  
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Mises à jour du chat
function updateChat(){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "Chat/process.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }								  
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//envoyer le message
function sendChat(message, nickname)
{       
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "Chat/process.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}




// Debut du messenger

function cargaSendMail(){
 
 
    $(".c_error").remove();
 
    var filter= /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;
    var s_email = $('#c_mail').val();  
    var s_name = $('#c_name').val();    
    var s_msg = $('#c_msg').val();
   
    
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

// $(document).ready(function(){
//     $("#btn-inscription").click(function(){
//         $("#modal-inscription").modal();
//     });
//
// });

$(document).ready(function(){
    $("#btn-login").click(function(){
        $("#modal-login").modal({"backdrop": "static"});
    });


});

