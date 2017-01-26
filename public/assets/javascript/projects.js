$(function(){


  var clkBtn = "";
  $('input[type="submit"]').click(function(evt) { clkBtn = evt.target.id;  });

  // $("#modifyProject").hide();
  var list = $('.project');

  // clic sur le bouton de visualisation du projet
  list.on("click",'.glyphicon',function(e) {
    //$("#modifyProject").show();
    //$("#createProject").attr({"type":"button"});
    //$("#createProject").empty();
    //$("#createProject").html("Vider le formulaire");

    var data = { 'id':$(this).attr('id') };
    $.ajax({
      url: "ProjectsShow",
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
    var btnID = clkBtn;
    e.preventDefault();
    console.log(btnID);
    var data = $(this).serialize();

  });

  // clic sur le bouton Modifier





});
