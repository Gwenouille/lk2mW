function reloadChat(){
  $.ajax({
    url:"reloadmsg",
    type:"POST",
    success:function(value){
      if(value.Success) {
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

          // Scrolle le chat vers le bas automatiquement.
          var objDiv = document.getElementById("chat_content");
          objDiv.scrollTop = objDiv.scrollHeight;
        }
      }
    });
  });

timeout= setInterval(reloadChat,1000);

// Scrolle le chat vers le bas automatiquement.
var objDiv = document.getElementById("chat_content");
objDiv.scrollTop = objDiv.scrollHeight;

});
