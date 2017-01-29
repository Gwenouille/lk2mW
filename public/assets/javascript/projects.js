$(function(){


  var list = $('.project');

  // clic sur le bouton de visualisation du projet
  list.on("click",'.glyphicon-eye-open',function(e) {
    var data = { 'id':$(this).attr('id') };
    console.log(data);
    $.ajax({
      url: "projectsShow",
      type: "post",
      data: data,
      success: function(value) {
        console.log(value);
				// Entre les données du projet dans les champs
				$(".formControl[name='titleProject']").val(value.projectData['name']);
        $(".formControl[name='dateProject']").val(value.projectData['date']);
        $("#contentProject").val(value.projectData['description']);
        $("#idProject").val(value.projectData['id']);
			}
    });
  });

  // clic sur le bouton créer ou Modifier
  $(".detailProject").on("submit",function(e) {
    e.preventDefault();
    var buttonActive = $(document.activeElement).attr('id');

    var form = document.getElementById('projectForm');
    var data = new FormData(form);
    // Ajout du bouton du formulaire qui est cliqué dans le formData
    data.append("action", buttonActive);

    $.ajax({
      url: "projectsModify",
      type: "post",
      data: data,
      dataType:"json",
      processData:false,
      contentType:false,
      success: function(value) {
        console.log(value);
        if(value.success) {
          // vide la partie du menu de gauche et la remplace par sa maj
          $.ajax({
            url: "projectsAjaxModify",
            type:"post",
            data: data,
            dataType:"html",
            processData:false,
            success: function(value) {
              $(".listProjectContent").html(value);


            }
          });
        }
      }
    });
  });

  // clic sur le bouton de suppression d'un fichier
  list.on("click",'.glyphicon-trash',function(e) {
    var data = { 'id':$(this).attr('id') };
    $.ajax({
      url: "deleteFile",
      type: "post",
      data: data,
      success: function(value) {
        var li='#lifileID'+value.id;
        if (value.success){
          $(li).replaceWith('<li>Fichier supprimé</li>');
        } else {
          $(li).append("<p>Le fichier n'a pu être supprimé</li>");
        }

			}
    });
  });


});
