var comment_opened_id = 0;  // Commentaire qui a ses fils visibles
var post_opened_id = 0; // Commentaire ouvert dans la modale.

var monthNumber = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

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



function set_user_info(id){

    var url = "/api/user/" + id;

    $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function(data) {

            var name = '';

            if (data['styxuserstudent']){
                name += data['styxuserstudent']['firstname'] + ' ';
            }
            name += data['name'];

            $( ".zoom").find( ".pt2 .right .pseudo" ).text(name);

            if(data['avatar']){
                $( ".zoom").find( ".pt2 .right img" ).attr('src', data['avatar']);
            }
            else {
                $( ".zoom").find( ".pt2 .right img" ).attr('src', '/bundles/framework/images/user/user.jpg');
            }
            $( ".zoom").find( ".pt2 .right a" ).attr('href', '/profil/' + data['identifier']);
        },
         error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
            }
    });
}

// Show comments for a post
function get_comment(id){

    $('.un_com').remove();
    $('#c_coms').html($('#c_coms').html() + loader_svg);
    var url = "/api/post/" + id + "/comment/";

         $.ajax({
                type: "GET",
                url: url,
                dataType: "JSON",
                success: function(data) {
                   var comments = $('#c_coms').html();

                   $.each( data, function(key, comment){
                        comments += '<div class="un_com">';
                        comments += '<div class="principal">';
                        if (comment['user']['avatar']){
                            comments += '<img class="pp" src="' + comment['user']['avatar'] + '">';
                        }
                        else{
                            comments += '<img class="pp" src="/bundles/framework/images/user/user.jpg">';
                        }
                        comments += '<a href="/profil/' +  comment['user']['identifier'] + '">';
                        comments += '<span class=pseudo>';
                        if (comment['user']['styxuserstudent']){
                        comments += comment['user']['styxuserstudent']['firstname'] + ' ';
                        }
                        comments +=  comment['user']['name'] + '</span></a>';
                        comments += '<span class=text>' + comment['comment'] + '</span>';
                        comments += '<span class="nb_reponses" id=' + comment['identifier']  + '>' + comment['children'] + ' réponses pour ce commentaire</span>';
                        comments += '</div>';

                        if(typeof comment['already_pick'] == 'string'){
                                comments += '<a href="/conversation/'+ comment['already_pick'] + '" class="link_conv" id_conv="' + comment['already_pick'] + '">Message</a>'
                        }
                        else if (! comment['already_pick']){
                            comments += '<div class="accept" id_user="' + comment['user']['identifier'] + '" id_post="' + id + '">Accepter</div>'
                        }



                        comments += '</div>';
                    });

                   $('#c_coms').html(comments);
                },
                error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
            },
            complete : function(){
                $('#c_coms .spinner').remove();
            }
         });
}

function reset_modal(){
    $( ".zoom").find( ".pt1 span.titre" ).text('');
    $( ".zoom").find( ".pt1 span.text" ).html('');
    $( ".zoom").find( ".pt1 img" ).attr('src', '#');
    $( ".zoom").find( ".pt2 .left .coms.action .cpt" ).text('');
    $( ".zoom").find( ".pt2 .left .vues.action .cpt" ).text('');
    $( ".zoom").find( ".pt2 .right .pseudo" ).text('');
    $('.pt3').remove();
    $( ".zoom").find( ".pt2 .right img" ).attr('src', '/bundles/framework/images/user/user.jpg');
    $('.un_com').remove();
    $('.zoom .pt1').html($('.zoom .pt1').html() + loader_svg);
}

function show_modale(id){
    var url = "/api/post/" + id;
    reset_modal();
    $(".zoom").css({"display":"block"});
    $(".effet_zoom").css({"display":"block"});
    $(".c_zoom_commentaires").css({"display":"block"});
    $(".close_zoom_commentaires").css({"display":"block"});
    $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function(data) {
            // set data for the first part
            $( ".zoom").find( ".pt1 span.titre" ).text(data['title']);
            $( ".zoom").find( ".pt1 span.text" ).html(data['description'].replace(new RegExp('\r?\n','g'), '<br />'));
            $( ".zoom").find( ".pt1 img" ).attr('src', data['category']['image']);
            $( ".zoom").find( ".pt2 .left .coms.action .cpt" ).text(data['count_comment']);
            $( ".zoom").find( ".pt2 .left .vues.action .cpt" ).text(data['post_interest']);
            // set data for the second part
            var d = new Date(data['created_at']);
            var created_at = 'Posté le ' + d.getDate() + '/' + monthNumber[d.getMonth()] + '/' + d.getFullYear();
            $( ".zoom").find( ".pt2 .right .date_post" ).text(created_at);
            set_user_info(data['owner']['identifier']);

            if (data['event']){
                d = new Date(data['event']['date']);
                var div_pt3 = '';
                div_pt3 += '<div class="pt3">';
                div_pt3 += '<img src="' + data['event']['avatar'] + '">';
                div_pt3 += '<span class="text">';
                div_pt3 += 'Rendez vous le ' + d.getDate() + '/' + monthNumber[d.getMonth()] + '/' + d.getFullYear() + ' à ' + data['event']['hour'] + ' à ' + data['event']['place'] + ' !';
                div_pt3 += '</span>';
                div_pt3 += '</div>';

                $(div_pt3 ).insertAfter( '.zoom .pt1' );


            }

            // show the modal



            get_comment(id);
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        },
        complete : function(){
            $('.pt1 .spinner').remove();
        }
    });
}

// Permet de voir les réponses à un commentaire
function show_comment_children(div_clicked){



    $('.reponses').remove(); // Suppression des réponses précédentes
    $('.un_com .new_com').remove(); // Suppression de la form pour répondre à un commentaire
    div_father = div_clicked.parent().parent(); // Récupération de la nouvelle div ou il faut afficher les réponses.
    div_clicked.parent().html(div_clicked.parent().html() + loader_svg);

    id = div_clicked.attr('id');
    var url = "/api/comment/" + id + "/children/";
    // On récupére les réponses au commentaire
        $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function(data) {

            if (data != []){
                var children = div_father.html();
                children += '<div class="reponses"></div>';
                div_father.html(children); // On créé la balise qui contiendra les réponses

                 $.each( data, function(key, comment){

                     children = '<div class="second">';
                     children += '<a href="/profil/' +  comment['user']['identifier'] + '">';
                     if (comment['user']['avatar']){
                         children += '<img class="pp" src="' + comment['user']['avatar'] + '">';
                     }
                     else{
                         children += '<img class="pp" src="/bundles/framework/images/user/user.jpg">';
                     }


                     children += '<span class=pseudo>';

                     if (comment['user']['styxuserstudent']){
                         children += comment['user']['styxuserstudent']['firstname'] + ' ';
                     }
                     children +=  comment['user']['name'] + '</span></a>';
                     children += '<span class=text></span>';

                     children += '</div>';
                     $('.reponses').html($('.reponses').html() + children); // On injecte le code dans la balise

                     // On ne veut pas que le commentaire soit interprété comme du code s'il contient des balises, on
                     // l'ajoute donc après.
                     $('.reponses .second .text').last().text(comment['comment']);

                 });

                // On ajoute la form pour répondre à un comentaire
                children = '<div class="new_com secondary_com">';
                children += '<textarea placeholder="Répondre..."></textarea>';
                children += '<input type="submit" value="Envoyer" id_father="' + id + '">';
                children += '</div>';
                $('.reponses').html($('.reponses').html() + children);

                // On affiche les réponses.
                $(".reponses").css({"display":"block"});
            }

        },
                error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
            },
            complete : function(){
                $('.spinner').remove();
            }
         });

}

/*
 * On enregistre 2 types (status ) de commentaire, ceux qui sont commenter sur un Post et ceux sur un autre commentaire.
 * Seule l'URL pour l'API est différente.
 */

function save_comment(id, value, status){
    var data = {};
    var url = "";

    if(status == 'comment'){
        url = "/api/post/" + id + "/comment/";
    }
    else if(status == 'children'){
        url = "/api/comment/" + id + "/children/";
    }

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

     $.ajax({
        url: url,
        dataType : "JSON",
        type : 'POST',
        data:{father_identifier: id, comment: value, },
        // Si la requête est correct, on change visuellement le prix du produit
        success : function(data){
            if (status == 'comment'){
                show_modale(id);
            }
            else{
                show_comment_children($('#' + id));
            }

        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
            console.log(jQuery.parseJSON(request.responseText));
        },

    });
}


function accept_user(div_accept){

    id_user = div_accept.attr('id_user');
    id_post = div_accept.attr('id_post');

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

     $.ajax({
        url: '/api/post/' + id_post + '/accept/' + id_user,
        dataType : "JSON",
        type : 'GET',
        data:{},
        // Si la requête est correct, on change visuellement le prix du produit
        success : function(data){
            div_accept.hide();
            div_accept.replaceWith($('<a href="/conversation/' + data['identifier'] + '" class="link_conv"> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>'))
            div_accept.fadeIn(1000);
        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
            console.log(jQuery.parseJSON(request.responseText));
        },

    });

}


/* Affichage des coms */
$(document).ready(function(){
    comment_open_id = 0;
    post_opened_id = 0;

    $(document).on("click", ".nb_reponses", function () {
        if ($(this).attr('id') != comment_open_id){
            show_comment_children($(this));
            comment_open_id = $(this).attr('id');
        }
        else {
            $('.reponses').remove();
            $('.un_com .new_com').remove();
            comment_open_id = 0;
        }

    });

    $(document).on("click", ".secondary_com input", function () {
        var id_father = $(this).attr('id_father');
        var comment_text = $(this).prev().val();
        save_comment(id_father, comment_text, 'children');
    });

    $(document).on("click", ".zoom .c_coms .principal_com input", function () {
        var comment_text = $(this).prev().val();
        save_comment(post_opened_id, comment_text, 'comment');
    });

    $(document).on("click", ".actus ", function () {
        if ($(this).children('.pt1').attr('id')){
            post_opened_id = $(this).children('.pt1').attr('id');
            show_modale(post_opened_id);
        }
    });

    $(document).on("click", ".accept", function () {
        accept_user($(this));
    });

    $(document).on("mouseleave", ".link_conv", function () {
        $(this).text('Message');
    });

    $(document).on("click", ".link_conv", function () {
        $(this).text('Message');
    });

    $(".left .coms, .left .vues").on("click", function () {
        var id = $(this).parent().parent().prev().attr('id');
        show_modale(id);
    });



    $(".close_zoom_commentaires.feed").on("click", function () {
        $(".zoom").css({"display":"none"});
        $(".effet_zoom").css({"display":"none"});
        $(".c_zoom_commentaires").css({"display":"none"});
        $(this).css({"display":"none"});
        $(".reponses").css({"display":"none"});
    });

});