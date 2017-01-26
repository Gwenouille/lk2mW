$(function(){

  var list=$('#listUsers');

  list.on("change",'.userGlyphicon',function(e) {
    var data = {
      'id':$(this).attr('id')
    };
    console.log(data);
    $.ajax({
      url: "news/newsToggleCheckbox",
      type: "post",
      data: data
    });
  });

};
