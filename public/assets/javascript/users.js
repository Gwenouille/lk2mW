$(function(){

  var list=$('#listUsers');

  list.on("click",'.userGlyphicon',function(e) {
    e.preventDefault();
    reloadChat()
    console.log('ici');
    var data = {
      'id':$(this).attr('id')
    };
    console.log(data);
    $.ajax({
      url: "getProjects",
      type: "post",
      data: data,
      success: function(value) {
				// entre les données de l'article dans les champs
				// $("#news_article_title").val(value.ArticleData['title']);
				// tinyMCE.get('news_content_title').setContent(value.ArticleData['content']);
				// // incorpore l'ID de l'article qui sera changé dans le formulaire
				// $(".news_input_button").append("<input type='hidden' value='"+value.ArticleData['id']+"' name='article_id'>");
			}
    });
  });

});
