    var csrftoken = getCookie('csrftoken');


    function getCookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }

    function csrfSafeMethod(method) {
        // these HTTP methods do not require CSRF protection
        return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
    }


    String.prototype.replaceAll = function(str1, str2, ignore)
    {
        return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
    }

    function deleteCookie(c_name) {
        document.cookie = encodeURIComponent(c_name) + "=deleted; expires=" + new Date(0).toUTCString();
    }

    // Show the connexion's modal
    function loginmobile(){

        $("#login-mobile").modal('show');

        $(function() {
            $('#login-mobile').submit(function() {;
                return true; // return false to cancel form action
            });
        });
    }

    // Show the sign up's modal
    function signupmobile(){

        $("#sign-up-mobile").modal('show');

        $(function() {
            $('#sign-up-mobile').submit(function() {
                return true; // return false to cancel form action
            });
        });
    }

    function share_city(){

        $("#id_share_city").modal('show');

        $(function() {
            $('#id_share_city').submit(function() {
                return true; // return false to cancel form action
            });
        });
    }

    $(document).ready(function(){

        var infoHidden = true;

        // Put the email address on lower case
        $("input#id_email").focusout(function(){
            var mail = $(this).val().toLowerCase();
            $(this).val(mail);
        });



        $( "#firstStep").click(function(){

            city = document.getElementById('id_city').value;
            school = document.getElementById('id_school').value;
            if ((city.length > 2) && (school.length > 2)){
                setCookie();
                Hide("firstStepError");
                if(infoHidden){
                    if ($( window ).width() > 767){
                    $(".sign-up-modal-body").css('height', '250px');
                    }
                    else{
                    $(".sign-up-modal-body").css('height', '380px');
                    }
                    Show("facebookInformation");
                    }
                else{
                    Hide("personnalInformation");
                    Hide("facebookInformation");
                    if ($( window ).width() > 767){
                        $(".sign-up-modal-body").css('height', '160px');
                        }
                    else{
                    $(".sign-up-modal-body").css('height', '230px');
                    }
            }
            infoHidden = !infoHidden;
            }
            else {
               Show("firstStepError");

            }
        });

        $("#signup-email").click(function(){
        if ($( window ).width() > 767){
            $(".sign-up-modal-body").css('height', '470px');
            }
        else{
        $(".sign-up-modal-body").css('height', 'auto');
        }
            Show("personnalInformation");

        });

        function setCookie(){
            deleteCookie('id_school');
            deleteCookie('nameSchool');
            deleteCookie('id_city');
            deleteCookie('nameCity');
            deleteCookie('department');
            deleteCookie('promoCode');
            deleteCookie('sponsorship');

            document.cookie = "nameCity=" + encodeURIComponent(document.getElementById('id_city').value) + ";path=/";
            document.cookie = "id_school=" + id_school_selected + ";path=/";
            document.cookie = "nameSchool=" + encodeURIComponent(document.getElementById('id_school').value) + ";path=/";
            document.cookie = "id_city=" + id_city_selected + ";path=/";
            document.cookie = "department=" + document.getElementById('id_department').value + ";path=/";
            document.cookie = "promoCode=" + encodeURIComponent(document.getElementById('id_promo_code').value) + ";path=/";
            document.cookie = "sponsorship=" + encodeURIComponent(document.getElementById('id_sponsorship').value) + ";path=/";
        }

        $('.facebook-sign-up').click(function(){

            document.getElementById('facebook-sign-up').click();

        });

            $('.facebook-login').click(function(){

            document.getElementById('facebook-login').click();

        });



    });


function share_on_facebook_go(id, picture, caption, description, request_type){

    var link = 'http://styx-students.com/';
    var redirect_uri = 'http://styx-students.com/';

    if(request_type=='user'){
        link += 'demandes/';
        redirect_uri += 'demandes/';
    }
    else if (request_type=='company'){
        link += 'demandes_company/';
        redirect_uri += 'demandes_company/';
    }
    else{
        link += 'p/';
        redirect_uri += 'p/';
        picture = "http://www.styx-students.com/static/images/styx-parrainage.png";
        caption = "Rejoins-moi sur Styx !";
        description = "Styx, c’est le partage géolocalisé entre étudiants ! T'as besoin d'un déguisement pour ta prochaine soirée ? D’un covoiturage pour aller sur le campus ? D’un bon plan pour sortir ce soir ? Fais appel aux étudiants autour de chez toi qui pourront surement t’aider !! Tu vois l'idée ? Inscris-toi gratuitement et rejoins les étudiants de ta ville.";
    }


    FB.ui(
             {
                method: 'feed',
                name: caption,
                link: link + id,
                redirect_uri: redirect_uri + id,
                picture: picture,
                caption: 'styx-students.com',
                description: description,
                message: ''
             });


}