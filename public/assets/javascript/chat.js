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
         $(".chat_content").empty();
         $(".chat_content").html(value.reloadChat);
        }
      }
    });
  });

  function reloadChat(){
    $.ajax({
      url:"reloadmsg",
      type:"POST",
      success:function(value){
        if(value.Success) {
          console.log('prout');
         $(".chat_content").empty();
         $(".chat_content").html(value.reloadChat);

        }
      }
    });
  }

timeout= setInterval(reloadChat,3000);

});
