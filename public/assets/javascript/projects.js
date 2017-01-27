$(function(){


  var list = $('.project');

  // clic sur le bouton de visualisation du projet
  list.on("click",'.glyphicon',function(e) {

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
  });

  // clic sur le bouton créer
  $(".detailProject").on("submit",function(e) {
    e.preventDefault();
    var buttonActive = $(document.activeElement).attr('id');
    var data = $(this).serialize() + "&action=" + buttonActive;
    $.ajax({
      url: "projectsModify",
      type: "post",
      data: data,
      success: function(value) {
      }
    });


  });

  // clic sur le bouton Modifier





});
