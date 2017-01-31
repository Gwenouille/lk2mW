function reloadChat(){
  $.ajax({
    url:"reloadmsg",
    type:"POST",
    success:function(value){
      if(value.Success) {
        $(".chat_content").empty();
        $(".chat_content").html(value.reloadChat);
      } else {
        $(".chat_content").empty();
        $(".chat_content").html(value.reloadChat);
      }
    }
  });
}

$(function(){

  $(".chat_input").on("submit",function(e){
    e.preventDefault();

    var data = $(this).serialize();
    $.ajax({
      url:"sendmsg",
      type:"POST",
      data: data,
      success:function(value){
        if(value.Success) {
          reloadChat()
          $('#chat_input').val('');
          // Scrolle le chat vers le bas automatiquement.
          var to=setTimeout(function(){var objDiv = document.getElementById("chat_content");
          objDiv.scrollTop = objDiv.scrollHeight;},200)
        } else {
          alert("Votre message n'a pas pu être envoyé");
        }
      }
    });
  });

timeout= setInterval(reloadChat,1000);

// Scrolle le chat vers le bas automatiquement.
var objDiv = document.getElementById("chat_content");
objDiv.scrollTop = objDiv.scrollHeight;

});
