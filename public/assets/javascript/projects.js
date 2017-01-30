$(function(){

  var list = $('.project');


  function ajaxFillForm(e) {
    var data = { 'id':$(this).attr('id') };
    $.ajax({
      url: "projectsShow",
      type: "post",
      data: data,
      success: function(value) {
        // Entre les données du projet dans les champs
        $(".formControl[name='titleProject']").val(value.projectData['name']);
        $(".formControl[name='dateProject']").val(value.projectData['date']);
        $("#contentProject").val(value.projectData['description']);
        $("#idProject").val(value.projectData['id']);
      }
     });
  }

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
        $(".projects_title .projects_error").html("");
        $(".projects_description .projects_error").html("");
        $(".projects_file .projects_error").html("");
        if(value.success) {
            if(typeof(value.errorsType) != "undefined") {
              for(var i = 0; i < value.errorsType.length;i++) {
                $(".projects_file .projects_error").append("<p>"+ value.errorsType[i] + "</p>");
              }
            }

          // vide les champs si tous les données,champs sont respectés
          $(".projects_title input[name='titleProject']").val("");
          $(".projects_description textarea[name='contentProject']").val("");
          $(".projects_file input[type='file']").val("");
          // vide la partie du menu de gauche et la remplace par sa maj
          $.ajax({
            url: "projectsAjaxModify",
            type:"post",
            data: data,
            dataType:"html",
            processData:false,
            contentType:false,
            success: function(value) {
              $(".listProjectContent").html(value);
              $('.project').on("click",'.glyphicon-trash', ajaxDelete);
              $('.project').on("click",'.glyphicon-eye-open',ajaxFillForm);
            }
          });
        } else { // affichage des messages d'erreur pour les champs mal remplis
            if(typeof(value.errorsChamp) != "undefined") {
              if(typeof(value.errorsChamp['content']) != "undefined") {
                $(".projects_description .projects_error").html("Veuillez remplir ce champ");
              }
              if(typeof(value.errorsChamp['title']) != "undefined") {
                $(".projects_title .projects_error").html("Veuillez remplir ce champ");
              }
            }
        }
      }
    });
  });

  function ajaxDelete(e) {
    var data = { 'id':$(this).attr('id') };
    $.ajax({
      url: "deleteFile",
      type: "post",
      data: data,
      success: function(value) {
        var li='#lifileID'+value.id;
        if (value.Success===true){
          text='<li id="lifileID'+value.id+'">Fichier supprimé</li>'
          $(li).replaceWith(text);
          $(li).delay(1500).hide(300);

        } else {
          $(li).append("<p>Le fichier n'a pu être supprimé</li>");
        }

      }
    });
  };

  // clic sur le bouton de visualisation du projet
  list.on("click",'.glyphicon-eye-open',ajaxFillForm);

  // clic sur le bouton de suppression d'un fichier
  list.on("click",'.glyphicon-trash', ajaxDelete);


});
