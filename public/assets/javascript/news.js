$(function(){

	var list=$('#list');

// Mise à jour des champs de droite sur le clic du bouton modifier d'un article de gauche
	list.on("submit",'.form_listArticle',function(e) {
		e.preventDefault();

		// affichage du titre (modification)
		$(".newsEditShowArticle .titleList").empty();
		$(".newsEditShowArticle .titleList").html("Modification de l'article");

		// affichage du bouton modifier
		$(".news_input_button").empty();
		$(".news_input_button").html('<input type="submit" name="news_submit" value="Modifier">');

		// enlève l'input file qui contient des images par celle de l'article qu'on modifie
		$(".news_file input[type='file']").remove();
		$(".news_file").append("<input type='file' name='news_files_input[]' multiple>");

		var data = $(this).serialize();
		$.ajax({
			url: "news/newsShow",
			type:"post",
			data: data,
			dataType:"json",
			success: function(value) {
				$(".news_content .news_error").hide();
				$(".news_title .news_error").hide();
				$(".news_file .news_error").hide();
				// entre les données de l'article dans les champs
				$("#news_article_title").val(value.ArticleData['title']);
				tinyMCE.get('news_content_title').setContent(value.ArticleData['content']);
				// incorpore l'ID de l'article qui sera changé dans le formulaire
				$(".news_input_button").append("<input type='hidden' value='"+value.ArticleData['id']+"' name='article_id'>");
			}
		});
	});

	list.on("change",'.newsCheckbox',function(e) {
		var data = {
			'id':$(this).attr('id'),
			'state':$(this).prop('checked')
		};
		$.ajax({
			url: "news/newsToggleCheckbox",
			type: "post",
			data: data
		});
	});

	list.on("change",'.newsImgCheckbox',function(e) {
		var data = {
			'id':$(this).attr('id'),
			'state':$(this).prop('checked')
		};
		$.ajax({
			url: "news/newsToggleImgCheckbox",
			type: "post",
			data: data
		});
	});


	// valide le formulaire de droite
	$("#news_form").on("submit",function(e) {
		e.preventDefault();
		var form=document.getElementById('news_form');
		var data = new FormData(form);
		$.ajax({
			url: "news/newsModify",
			type:"post",
			data: data,
			dataType:"json",
			processData:false,
			contentType:false,
			success: function(value) {
				if(value.success) {
					$(".news_content .news_error").hide();
					$(".news_title .news_error").hide();
					$(".news_file .news_error").hide();
					// enlève l'input file qui contient des images par celle de l'article qu'on modifie
					$(".news_file input[type='file']").remove();
					$(".news_file").append("<input type='file' name='news_files_input[]' multiple>");
					if(typeof(value.errorsType)!="undefined") {
						$(".news_file .news_error").show();
						$(".news_file .news_error").empty();
						for(var i = 0; i < value.errorsType.length;i++) {
							$(".news_file .news_error").append("<p>" + value.errorsType[i] + "</p>");
						}
					}
			    $.ajax({
				      url: "news/newsAjaxModify",
				      type:"post",
				      data: data,
				      dataType:"html",
				      processData:false,
				      success: function(value) {
				        $(".listNewsContent ul").html(value);
				        $(".confirmMsg").show();
				      }
				    });
				}	else {
					// enlève l'input file qui contient des images par celle de l'article qu'on modifie
					$(".news_file input[type='file']").remove();
					$(".news_file").append("<input type='file' name='news_files_input[]' multiple>");
					if(typeof(value.errorsChamp)!="undefined") {
						if(typeof(value.errorsChamp['content'])!="undefined") {
							$(".news_content .news_error").show();
							$(".news_content .news_error").html("Ce champ est mal renseigné");
						} else {
							$(".news_content .news_error").hide();
						}
						if(typeof(value.errorsChamp['title'])!="undefined") {
							$(".news_title .news_error").show();
							$(".news_title .news_error").html("Ce champ est mal renseigné");
						} else {
							$(".news_title .news_error").hide();
						}
			 		}
				}
			}
		});
	});

	// clic sur le bouton créer
	$("#creationButton").on("click",function() {

		// affichage du titre (modification)
		$(".newsEditShowArticle .titleList").empty();
		$(".newsEditShowArticle .titleList").html("Création de l'article");

		// affichage du bouton créer
		$(".news_input_button").empty();
		$(".news_input_button").html('<input type="submit" name="news_submit" value="Créer">');

		// vide les champs du formulaire de droite
		$("#news_article_title").val("");
		tinyMCE.get('news_content_title').setContent("");

		// enlève l'input file qui contient des images par celle de l'article qu'on modifie
		$(".news_file input[type='file']").remove();
		$(".news_file").append("<input type='file' name='news_files_input[]' multiple>");
	});

});
