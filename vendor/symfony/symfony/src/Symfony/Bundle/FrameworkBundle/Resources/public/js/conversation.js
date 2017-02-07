var monthNumber = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
var rating_html = '<section id="rate" class="rating"><input type="radio" id="star_5" name="rate" value="5"><label for="star_5" title="Five">★</label><input type="radio" id="star_4" name="rate" value="4"><label for="star_4" title="Four">★</label><input type="radio" id="star_3" name="rate" value="3"><label for="star_3" title="Three">★</label><input type="radio" id="star_2" name="rate" value="2"><label for="star_2" title="Two">★</label><input type="radio" id="star_1" name="rate" value="1"><label for="star_1" title="One">★</label></section>';

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


function show_conversation(id_conversation){

    $('.chat').html('');

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && sameOrigin(settings.url)) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
         }
    });

    $.ajax({
        type: "GET",
        url: '/api/conversation/' + id_conversation,
        dataType: "JSON",
        success: function(data) {
            var info = '<div class="title" title="' + data['title_post'] + '">' + data['title_post'] + '</div>';
            info += rating_html;
            $.each( data['participant'], function(key, user){
                if(user['identifier'] != data['connected_user']){
                    if(user['avatar']){
                        info += '<a href="/profil/' + user['identifier']+ '"><img src="' + user['avatar'] + '" title="' + user['name'] + '"></a>';
                    }
                    else{
                        info += '<a href="/profil/' + user['identifier']+ '"><img src="/static/user/user.jpg" title="' + user['name'] + '"></a>';
                    }
                }
             });
             $('.container-message .right .top').html(info);

             if(data['avis_note']){
                $("#star_" + data['avis_note']).attr('checked', 'checked');
             }
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
    });


    $.ajax({
        type: "GET",
        url: '/api/conversation/' + id_conversation + '/messages/',
        dataType: "JSON",
        success: function(data) {
            var date = new Date('1970-01-01 00:00:00');

            $.each( data, function(key, message){

                var chat = $('.chat').html();

                var message_date = new Date(message['created_at']);
                tmp = message_date - date;

                if( tmp > 600000){
                    chat += '<div class="conversation-start"><span>' +  message_date.getDate() + '/' + monthNumber[message_date.getMonth()] + '/' + message_date.getFullYear() + ' '+ message_date.getHours()+ ':' + message_date.getMinutes() + '</span></div>';
                    date = message_date;
                }

                if (message['is_me'] == true){
                    chat += '<div class="bubble me" id="' + message['identifier'] + '"></div>';
                }
                else{
                    chat += '<div class="bubble you" id="' + message['identifier'] + '"></div>';
                }
                 $('.chat').html(chat);
                $('#' + message['identifier']).text(message['message']);
             });

                $('.write-link.send').attr('id_conversation', id_conversation);
                $(".chat").scrollTop($(".chat")[0].scrollHeight);
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
    });

}

function add_message(){

    var id_conversation = $('.write-link.send').attr('id_conversation');
    var message = $('.right .write input').val();

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && sameOrigin(settings.url)) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
         }
    });

    $.ajax({
        type: "POST",
        url: '/api/conversation/' + id_conversation + '/messages/',
        dataType: "JSON",
        data:{message: message},
        success: function(data) {

            var chat = $('.chat').html();
            if (data['is_me'] == true){
                chat += '<div class="bubble me" id="' + data['identifier'] + '"></div>';
            }
            else{
                chat += '<div class="bubble you" id="' + data['identifier'] + '"></div>';
            }

            $('.chat').html(chat);
            $('#' + data['identifier']).text(data['message']);
            $('.right .write input').val('');
            $(".chat").scrollTop($(".chat")[0].scrollHeight);
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
    });
}

function set_avis(){

    var recipient = $('.right .top a').attr('href').split('/')[2];
    var conversation = $('.right .write a').attr('id_conversation');
    var note = $('input[name="rate"]:checked').val();

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && sameOrigin(settings.url)) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
         }
    });

    $.ajax({
        type: "POST",
        url: '/api/avis/',
        dataType: "JSON",
        data:{note: note, comment:'', conversation:conversation, recipient:recipient},
        success: function(data) {
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
    });

}

$(document).ready(function(){

    $(document).on("click", 'input[name="rate"]', function () {
       set_avis();
     });

    $(document).on("click", ".posts .post", function () {
        show_conversation($(this).attr('id_conversation'));
     });
    $(document).on("click", ".write-link.send", function () {
        add_message();
    });

});