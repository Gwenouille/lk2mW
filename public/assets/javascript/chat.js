function reloadChat(){
  $.ajax({
    url:"http://localhost/lk2mW/public/fabrication_additive/projects/reloadmsg",
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
      url:"http://localhost/lk2mW/public/fabrication_additive/projects/sendmsg",
      type:"POST",
      data: data,
      success:function(value){
        if(value.Success) {
          reloadChat()
        //  $(".chat_content").empty();
        //  $(".chat_content").html(value.reloadChat);
        }
      }
    });
  });



timeout= setInterval(reloadChat,1000);

});