$(function(){

	function emptyHide() {
		// cache les champs erreurs
		$(".confirmMsg").hide();
		$(".news_title .news_error").hide();
		$(".news_content .news_error").hide();
		// vide les champs erreurs
		$(".confirmMsg").empty();
		$(".news_content .news_error").empty();
		$(".news_title .news_error").empty();
	}

	var list=$('#list');
	
	// clic sur le bouton modifier
		list.on("submit",'.form_listArticle',function(e) {
		e.preventDefault();

		emptyHide();
		// affichage du formulaire à droite
		$(".newsEditShowArticle").show();

		// affichage du titre (modification)
		$(".newsEditShowArticle h2").empty();
		$(".newsEditShowArticle h2").html("Modification de l'article");

		// affichage du bouton modifier
		$(".news_input_button").empty();
		$(".news_input_button").html('<input type="submit" name="news_submit" value="Modifier">');

		var data = $(this).serialize();
		$.ajax({
			url: "news/newsShow",
			type:"post",
			data: data,
			dataType:"json",
			success: function(value) {
				// entre les données de l'article dans les champs
				$("#news_article_title").val(value.ArticleData['title']);
				tinyMCE.get('news_content_title').setContent(value.ArticleData['content']);

				// incorpore l'ID de l'article qui sera changé dans le formulaire
				$(".news_input_button").append("<input type='hidden' value='"+value.ArticleData['id']+"' name='article_id'>");
			}
		});
	});

	// valide le formulaire de droite
	$("#news_form").on("submit",function(e) {
		e.preventDefault();

		var data = $(this).serialize();
		$.ajax({
			url: "news/newsModify",
			type:"post",
			data: data,
			dataType:"json",
			success: function(value) {
				emptyHide();
				$(".confirmMsg").html(value.formConcern + " effectuée");
				if(value.success) {
					$.ajax({
						url: "news/newsAjaxModify",
						type:"post",
						data: data,
						dataType:"html",
						success: function(value) {
							emptyHide();
							$(".newsEditListing ul").html(value);
							$(".confirmMsg").show();
						}
					});
				} else {
					$(".confirmMsg").show();
					$(".confirmMsg").html("Erreur lors de la " + value.formConcern);
					if(value.errors) {
						if(value.errors.content) {
							$(".news_content .news_error").show();
							$(".news_content .news_error").html("Ce champ est mal renseigné");
						}
						if(value.errors.title) {
							$(".news_title .news_error").show();
							$(".news_title .news_error").html("Ce champ est mal renseigné");
						}
					}
				}
			}
		});
	});

	// clic sur le bouton créer
	$("#creationButton").on("click",function() {
		emptyHide();
		// affichage du formulaire à droite
		$(".newsEditShowArticle").show();
		// affichage du titre (modification)
		$(".newsEditShowArticle h2").empty();
		$(".newsEditShowArticle h2").html("Création d'un article");
		// affichage du bouton créer
		$(".news_input_button").empty();
		$(".news_input_button").html('<input type="submit" name="news_submit" value="Créer">');
		// vide les champs du formulaire de droite
		$("#news_article_title").val("");
		tinyMCE.get('news_content_title').setContent("");
	});



})
