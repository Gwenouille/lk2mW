$(function(){

  var list=$('#listUsers');

  list.on("click",'.userGlyphicon',function(e) {
    e.preventDefault();
    reloadChat()
    var data = {
      'id':$(this).attr('id')
    };
    $.ajax({
      url: "getUserData",
      type: "post",
      data: data,
      success: function(value) {

        var coords=value.coords;
        $("#userCoordinates").empty();
        $("#userCoordinates").append(coords);

        var projects=value.projects;
        $("#listProjectContent").empty();
        $("#listProjectContent").append(projects);

			}
    });
  });

});
