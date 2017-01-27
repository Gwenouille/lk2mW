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
        console.log(value);
        console.log(value.coords);

        var coords=value.coords;
        $("#userCoordinates").empty();
        $("#userCoordinates").append(coords);
        
        var projects=value.projects;
        $("#listProjectContent").empty();
        $("#listProjectContent").append(projects);

				// entre les données de l'article dans les champs
				// $("#news_article_title").val(value.ArticleData['title']);
				// tinyMCE.get('news_content_title').setContent(value.ArticleData['content']);
				// // incorpore l'ID de l'article qui sera changé dans le formulaire
				// $(".news_input_button").append("<input type='hidden' value='"+value.ArticleData['id']+"' name='article_id'>");
			}
    });
  });

});
