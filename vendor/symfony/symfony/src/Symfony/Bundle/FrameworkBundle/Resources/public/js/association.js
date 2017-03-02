function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}


$(document).ready(function() {
    var max_fields      = 10; // Nombre de boutons maximum
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".ajout_membre"); //Ajouter un Bouton
    
    var x = 1; // Compteur
    $(add_button).click(function(e){ // Ajout membre
        e.preventDefault();
        if(x < max_fields){ // Maximum de membres
            x++; // Incremetation membre
            var div = '<div class="membre">';
            div += '<input type="text" id="id_form-' + (x - 1) + '-user_name" name="form-' + (x - 1) + '-user_name" placeholder="Nom du membre">';
            div += '<input class="poste_membre"  type="text" id="id_form-' + (x - 1) + '-role" name="form-' + (x - 1) + '-role" placeholder="Poste du membre">';
            div += '<div class="remove"><img src="/bundles/framework/images/icons/trash.png"></div></div>';
            $("#id_form-TOTAL_FORMS").attr('value', x);
            $(wrapper).append(div);
        }
    });
    
    $(wrapper).on("click",".remove", function(e){ // Supprimer Membre
        e.preventDefault(); $(this).parent('div').remove(); x--;
        $("#id_form-TOTAL_FORMS").attr('value', x);
    })


// Form

    $(".valid1").on('click', function () {

        if($("#id_name").val() == ""){
            $("#id_name").css('background-color', '#D8A5A5');
        }
        else if(! validateEmail($("#id_email").val())){
            $("#id_email").css('background-color', '#D8A5A5');
            $("#id_name").css('background-color', '#e8e8e8');
        }
        else if($("#id_password").val() == ""){
            $("#id_password").css('background-color', '#D8A5A5');
            $("#id_email").css('background-color', '#e8e8e8');
            $("#id_name").css('background-color', '#e8e8e8');
        }
        else if($("#id_password").val() == "" || $("#id_password").val() != $("#id_password2").val()){
            $("#id_password2").css('background-color', '#D8A5A5');
            $("#id_password").css('background-color', '#e8e8e8');
            $("#id_email").css('background-color', '#e8e8e8');
            $("#id_name").css('background-color', '#e8e8e8');
        }
        else{
            $('#form1').css({'display':'none'});
            $('#form2').css({'display':'block'});
            $('form').css({'width':'480px','margin-left':'calc(50% - 240px)'})
        }


    });
    $(".valid2").on('click', function () {

        if($("#id_form-0-user_name").val() == ""){
            $("#id_form-0-user_name").css('background-color', '#D8A5A5');
        }
        else if($("#id_form-0-role").val() == ""){
            $("#id_form-0-user_name").css('background-color', '#e8e8e8');
            $("#id_form-0-role").css('background-color', '#D8A5A5');

        }
        else{
        	$('#form2').css({'display':'none'});
	        $('#form3').css({'display':'block'});
        }

	});

    $(".modif_pp").on('click', function(){
        $("#id_avatar").click();
    });


    $(function() {
     $("input:file").change(function (){
        var reader = new FileReader();
        reader.onload = function (e) {

            var image = new Image();
            image.src = e.target.result;

            image.onload = function() {
                $('.pp').attr('src', this.src);
            };

        };

        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
     });
  });




});

