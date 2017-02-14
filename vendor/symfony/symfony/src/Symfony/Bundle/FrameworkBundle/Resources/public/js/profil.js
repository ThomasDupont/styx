/* New Post */


$(document).ready(function(){
    $(".l_c_coms").on("click", function () {
        $("content").css({"display":"none"});
        $(".coms").css({"display":"block"});
    });
    $(".l_c_services").on("click", function () {
        $("content").css({"display":"none"});
        $(".services").css({"display":"block"});
    });
    $(".l_c_prets").on("click", function () {
        $("content").css({"display":"none"});
        $(".prets").css({"display":"block"});
    });
    $(".l_c_demandes").on("click", function () {
        $("content").css({"display":"none"});
        $(".demandes").css({"display":"block"});
    });
    $(".l_c_news").on("click", function () {
        $("content").css({"display":"none"});
        $(".news").css({"display":"block"});
    });
    $(".l_c_evenements").on("click", function () {
        $("content").css({"display":"none"});
        $(".evenements").css({"display":"block"});
    });
    $(".l_modifs_av").on("click", function () {
        $(".container1").css({"display":"none"});
        $(".container2").css({"display":"block"});
    });
});

function go_to_request(id){
    window.location='/post/' + id;
}

function share_on_facebook_go(id, picture, caption, description, tiny_url, request_type){

    var link = 'http://styx-students.com/';
    var redirect_uri = 'http://styx-students.com/';

    if(request_type=='user'){
        link += tiny_url;
        redirect_uri += tiny_url;
    }
    else if (request_type=='company'){
        link += 'demandes_company/' + id;
        redirect_uri += 'demandes_company/';
    }
    else{
        link += tiny_url;
        redirect_uri += tiny_url;
        picture = "http://www.styx-students.com/static/images/styx-parrainage.png";
        caption = "Rejoins-moi sur Styx !";
        description = "Styx, c’est le partage géolocalisé entre étudiants ! T'as besoin d'un déguisement pour ta prochaine soirée ? D’un covoiturage pour aller sur le campus ? D’un bon plan pour sortir ce soir ? Fais appel aux étudiants autour de chez toi qui pourront surement t’aider !! Tu vois l'idée ? Inscris-toi gratuitement et rejoins les étudiants de ta ville.";
    }

    FB.ui(
             {
                method: 'feed',
                name: caption,
                link: link,
                redirect_uri: redirect_uri,
                picture: picture,
                caption: 'styx-students.com',
                description: description,
                message: ''
             });
}

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
var csrftoken = getCookie('csrftoken');

function csrfSafeMethod(method) {
    // these HTTP methods do not require CSRF protection
    return (/^(GET|HEAD|OPTIONS|TRACE)$/.test(method));
}
function sameOrigin(url) {
    // test that a given url is a same-origin URL
    // url could be relative or scheme relative or absolute
    var host = document.location.host; // host + port
    var protocol = document.location.protocol;
    var sr_origin = '//' + host;
    var origin = protocol + sr_origin;
    // Allow absolute or scheme relative URLs to same origin
    return (url == origin || url.slice(0, origin.length + 1) == origin + '/') ||
        (url == sr_origin || url.slice(0, sr_origin.length + 1) == sr_origin + '/') ||
        // or any other URL that isn't scheme relative or absolute i.e relative.
        !(/^(\/\/|http:|https:).*/.test(url));
}


var prev_following_p = '';
var next_following_p = '';

function update_followers(identifier, way){
    var url = null;

    if (way == 'next'){
        if(next_following_p == ''){
            url = '/api/user/' + identifier + '/following/';
        }
        else {
            url = next_following_p;
        }
    } else if (way == 'previous'){
        if(next_following_p == ''){
            url = '/api/user/' + identifier + '/following/';
        }
        else {
            url = prev_following_p;
        }
    }

    if (url != null){
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && sameOrigin(settings.url)) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                }
            }
        });

        $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function(data) {
                    prev_following_p = data['previous'];
                    next_following_p = data['next'];

                    html = '';
                    console.log(data['results']);
                    $.each( data['results'], function(key, user){

                        html += '<a class="followers" href="/profil/' + user['identifier'] + '">';

                        if(user['avatar'] != null){
                            html += '<img class="pp" src="' + user['avatar'] + '">';
                        }
                        else{
                            html += '<img class="pp" src="/bundles/framework/images/user/user.jpg">';
                        }

                        html += '<span class="pseudo">';

                        if(user['styxuserstudent'] != null){
                            html += user['styxuserstudent']['firstname'];
                        }

                        html += user['name'] + '</span></a>';



                    });
                    $('.following_list').html(html);
                },
                error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
            }
            });
    }
}

// Update profil

function set_categories(){
    location.origin = location.protocol + "//" + location.host;
    $.ajax({
        type: "GET",
        url: location.origin = '/api/user/categories/',
        dataType: "JSON",
        success:function(data){
            $.each( data, function(key, value){
                id = value['id'];
                $('.service_checkbox:input[value="' + id + '"]').next().removeClass('category_checked');
                $('.service_checkbox:input[value="' + id + '"]').prop( "checked", true );
            });
        }
    });
}

function update_following(status){


    var id_user = window.location.href.split("/").pop();
    var url = '/api/user/' + id_user;

    if (status == 'follow'){
        url += '/follow/';
    }
    else{
        url += '/unfollow/';
    }
    $.ajax({
        url: url,
        dataType : "JSON",
        type : 'GET',
        // Si la requête est correct, on change visuellement le prix du produit
        success : function(data){

            if (data['status'] == 'removed'){
                $('.modif_profil.follow').removeClass('follow').addClass('unfollow').text('Suivre');
            }
            else{
               $('.modif_profil.unfollow').removeClass('unfollow').addClass('follow').text('Ne plus suivre');
            }

        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
            console.log(jQuery.parseJSON(request.responseText));
        },

    });

}

$(document).ready(function(){

    $('.icone').click(function(){

        if($(this).prev().is(':checked')){

            $(this).addClass('category_checked');
        }
        else {
            $(this).removeClass('category_checked');
        }
    });

    $(document).on("click", ".modif_profil.follow", function () {
        update_following('unfollow');
     });

     $(document).on("click", ".modif_profil.unfollow", function () {
            update_following('follow');
     });


        $('.c_pp').click(function(){
            $('#update_profil_avatar').click();

        });

        var datefield=document.createElement("input")
        datefield.setAttribute("type", "date")
        if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
        jQuery(function($){ //on document.ready


            $('#id_birthday').datepicker({
                dateFormat: 'yy-mm-dd',
                dayNames:[ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
                dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
                firstDay:1,
                maxDate:'1998/01/01',
            });
        });
    }

});