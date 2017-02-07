var lock_maj = false;
var time_before_read = 200; // Il faut ouvrir la fenetre au moins 0,2 secondes avant de marquer les notifications comme lues
var time_maj_active = 5000; // on met à jour toute les 5 secondes quand la page est active
var time_maj_noactive = 30000; // on met à jour toute les 30 secondes quand la page est inactive
var time_maj = time_maj_active; // on met à jour les notifications toute les 5 secondes.
var isActive = true;
var id_maj= setTimeout(getAllNotifications,time_maj);
var csrftoken = getCookie('csrftoken');
var searchBlock = false;

var filterX = 100;
var touchX = null;
var filterWidth = null;
var startTouchFilterX = null;
var lastDefinitiveX = null;

var page_request = 0;

var global_color = ["#F7464A", "#46BFBD", "#FDB45C", "#B48EAD", "#949FB1", "#4D5360"]
var global_highlight =["#FF5A5E", "#5AD3D1", "#FFC870", "#C69CBE", "#A8B3C5", "#616774"]

/* edit request */
var request_edited = false;
var old_description = "";
var old_date = "";
/* end edit request */

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

    function Hide (addr) { document.getElementById(addr).style.visibility = "hidden";	}
    function Show (addr) { document.getElementById(addr).style.visibility = "visible";	}

    function Disable(addr) {$(addr).attr('disabled', 'disabled');}
    function Enable(addr){$(addr).removeAttr('disabled');}

function encode(r){
return r.replace(/[\x26\x0A\<>'"]/g,function(r){return"&#"+r.charCodeAt(0)+";"})
}

// Permettre de mettre en forme les catégories dans le template mprofil
function checkCategories(identifier){

 $.ajax({
        url:'/mprofil/categories/' + identifier,
        dataType: "JSON",
        success:function(data){
            for(i = 0 ; i < data.categories.length-1; i++){
                for(j = 0 ; j < 100;j++){
                    if(document.getElementById("id_objects_"+j)){
                        if( parseInt(document.getElementById("id_objects_"+j).value) == parseInt(data.categories[i]['id'])){
                            document.getElementById("id_objects_" + j).checked = true;
                            break;
                        }
                    }

                    if(document.getElementById("id_services_" + j )){
                        if(parseInt(document.getElementById("id_services_" + j ).value) == parseInt(data.categories[i]['id'])){
                            document.getElementById("id_services_" + j ).checked = true;
                            break;
                        }

                    }
                }
            }
        }
    });
}



function checkNotifAfterPageLoad() {
/*
    $.ajax({
        url:'/notifications/number',
        dataType: "JSON",
        success:function(data){
        var tim = new Date().getTime();
             //console.log("number:" + data.unread + " " + tim);
            if(parseInt(data.unread) > 0){
                var thetitle = $('title').text();
                if(thetitle[0] == '(')
                    thetitle = thetitle.substring(thetitle.indexOf(')') + 1);
                $('title').text("("+data.unread+") " + thetitle);
            }else{
                var thetitle = $('title').text();
                if(thetitle[0] == '(')
                    $('title').text(thetitle.substring(thetitle.indexOf(')') + 1));
            }
            $('#unread-notifications').html(data.unread);
        }
    });*/
}

window.onfocus = function () {
  isActive = true;
  time_maj = time_maj_active;
  clearInterval(id_maj);
  id_maj = setTimeout(getAllNotifications,time_maj);
}; 

window.onblur = function () {
  isActive = false; 
  time_maj = time_maj_noactive;
  clearInterval(id_maj);
  id_maj = setTimeout(getAllNotifications,time_maj);
};

function getAllNotifications(){
/*
    if(lock_maj){
        id_maj = setTimeout(getAllNotifications,time_maj);
        return;
    }
    $.ajax({
        url:'/notifications/number',
        dataType: "JSON",
        success:function(data){
        var tim = new Date().getTime();
            if(parseInt(data.unread) > 0){
                var thetitle = $('title').text();
                if(thetitle[0] == '(')
                    thetitle = thetitle.substring(thetitle.indexOf(')') + 1);
                $('title').text("("+data.unread+") " + thetitle);
            }else{
                var thetitle = $('title').text();
                if(thetitle[0] == '(')
                    $('title').text(thetitle.substring(thetitle.indexOf(')') + 1));
            }
            $('#unread-notifications').html(data.unread);
            $('#unread-notifications-mobile').html(data.unread);

            id_maj = setTimeout(getAllNotifications,time_maj);
        }
    });
    */
}

function check_before_publish(id){

        var urlSubmit = "/ajax/company/check_before_publish/" + id;
        $.ajaxSetup({
          beforeSend: function(xhr, settings) {
               if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                  xhr.setRequestHeader("X-CSRFToken", csrftoken);

               }
          }
    });
        $.ajax({
            type: "POST",
            url: urlSubmit,
            dataType: "JSON",
            success: function(data) {
                 $('#modal_publish_request').modal("show");
                 $('.modal-publish-request-text-info').html('<div class="alert alert-danger" role="alert">Vous vous apprêtez à envoyer <b>' + data.count + '</b> emails.</div>')
                 var zone = "";
                 var strline = "<ul>";
                for(i = 0 ; i < data.users.length-1; i++){
                    if(data.users[i].zone != zone){
                    zone = data.users[i].zone;
                    strline += '</ul>';
                    strline += '<h2>' + zone + '</h2>';
                    strline += '<ul>';

                    }
                    strline += '<li>' + data.users[i].email + '</li>';
                }
                strline += '</ul>';
                $('.modal-publish-request-list-email').html(strline);

                $('#modal-publish-request-confirm').html('<div id="generate_code" class="btn btn-info center" onclick="publish_request_company(' + data.id + ');"> Je suis sûr de vouloir publier cette annonce !</div>');
            },
            error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
        });

}

function publish_request_company(id){
window.location='/demandes_company/publish/' + id;
}



function generate_code_confirm_mail(){
    $('#info_generate_code').html('<div class="bar bar-1"></div><div class="bar bar-2"></div><div class="bar bar-3"></div>');
    $('#info_generate_code').css('width', '50px');
    $.ajax({
        url:'/generateConfirmMailCode',
        dataType: "JSON",
        success:function(data){
            $('#info_generate_code').css('width', '100%');
            if(data.message){
            $('#info_generate_code').html(data.message);
            }
            else{
            $('#info_generate_code').html("Un email vous a été envoyé ! Recopiez le code ci-dessous: ");
            }


        }
    });
}

$(document).ready(function(){

    $("#confirmEmail-submit").click( function() {
    code = $("#id_code").val();
    toSend = { code : code}
        var urlSubmit = "/confirmMailCode/"
        $.ajaxSetup({
          beforeSend: function(xhr, settings) {
               if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                  xhr.setRequestHeader("X-CSRFToken", csrftoken);

               }
          }
    });
        $.ajax({
            type: "POST",
            url: urlSubmit,
            dataType: "JSON",
            data      : toSend,
            success: function(data) {
                 if(data.code_match == 'True'){
                 var form_send_requestExist = document.getElementById('form_send_request');
                 if (form_send_requestExist){
                    $('#form_send_request').html('<button type="submit" name="action" value="newRequest" class="btn btn-info btn-md pull-right">Valider ma demande</button>');
                    $('#text_confirm_mail_code').html('');
                    $('#info_generate_code').html('<btn class="btn btn-success center" data-dismiss="modal" aria-hidden="true"> Adresse mail vérifiée avec succès ! </btn>');
                    $('#form_confirm_email').html('')
                    }
                 else{
                    window.location.reload();
                 }
                 }
                 else{
                    $('#info_generate_code').html('<div id="generate_code" class="btn btn-info center" onclick="generate_code_confirm_mail();"> Re-Générer mon code !</div>Le code entré n\'est pas le bon !');
                 }

                //e.preventDefault()
            }
        });

        return false;

    });


});

$(document).ready(function(){
 $("#notif_click").click(function(){
  $("#notif_wrap").fadeToggle(400);
  var time_click = new Date().getTime();
  lock_maj = false;

  $.ajax({
        url:'/notifications/ajax',
        dataType: "JSON",
        success:function(data){
            $('.notif_body #content').html("");
            var strline = "";
            for(i = 0 ; i < data.notifs.length-1; i++){
                strline = "";
                strline += '<li><div class="panel notif-panel';

                if(data.notifs[i]['unread'] == 1){
                   strline += ' notification_unread ';
                  }

                strline+= '" ><a href="' + data.notifs[i]['url'] + '">';
                strline+= data.notifs[i]['title'];
                strline += ' <div class="date-notif" style="margin-right:15px"><i>'+data.notifs[i]['date']+'</i></div></a></div></li>';

                $('.notif_body #content').append(strline);
            }
        }
        });

  setTimeout(function(){
    var start = new Date();
    console.log("setTimeout");
    if($("#notif_wrap").is(":visible")){
        console.log("read !");
        lock_maj = true;
        $.ajax({
        url:'/notifications/ajax/read'});
    }
  }, time_before_read);

  return false;
 });

 $(document).click(function(){
    lock_maj = false;
    $("#notif_wrap").hide();
 });


});


function displayNewsFeedForm(){
  $('.news-feed-new-request').slideUp(300);
  $('.news-feed-request-form').slideDown(500);

}

function hideNewsFeedForm(){
  $('.news-feed-new-request').slideDown(300);
  $('.news-feed-request-form').slideUp(500);
}

function goToRequest(id){
    window.location='/demandes/' + id;
}
function goToRequestCompany(id){
    window.location='/demandes_company/' + id;
}

function notifLink(url){
    window.location=url;
}

function goToProfil(id){
    window.location='/profil/' + id;
}

function goToNotif(){
    $.ajax({
        url:'/notifications/ajax/read',
        success : function(data){
        window.location='/notifications';
        }
        });
}

function quickAnswer(point){

$('#id_point').val(point);
$('#id_comment').val("Je suis partant(e) !");
$('#id_quick_answer').val(true);
document.getElementById("id_sendAnswer").click();
}

function commentAnswer(){
document.getElementById("id_comment").focus();
}

function closeRequest(idRequest){

window.location='/demandes/close/' + idRequest;
}

function conclude(idRequest){

window.location='/demandes/conclude/' + idRequest;
}

function updateCategories(idCategory, nameCategory, id_category){
    $.ajax({
        url:'/api/type/'+ idCategory + '/categories/',
        dataType : "JSON",
        type: 'GET',
        success : function(data){

            $('#id_category').empty();
            //$('#id_category').append("<option value='0'> --Catégories-- </option>")

            $.each( data, function(key_categories, category){
                    $('#id_category').append("<option value='" + category['id'] + "'> " + category['nameCategory'] + " </option>")
            });
        },
    });
}


$( document ).ready(function(){
var saviorSliderIDExist = document.getElementById('saviorSliderID');
var ownerSliderIDExist = document.getElementById('ownerSliderID');

if (saviorSliderIDExist != null){
var slider = new Slider('#saviorSliderID', {
    formatter: function(value) {
        $('#id_noteGivenBySavior').val(value);
        document.getElementById("badgeSavior").innerHTML = value;
        return 'Note actuelle: ' + value;
    }
});
}

if (ownerSliderIDExist != null){
var slider = new Slider('#ownerSliderID', {
    formatter: function(value) {
        $('#id_noteGivenByRequestOwner').val(value);
        document.getElementById("badgeOwner").innerHTML = value;
        return 'Note actuelle: ' + value;
    }
});

}


});

$( document ).ready(function(){

var date = new Date();
var hours = date.getHours().toString();
var minutes = date.getMinutes().toString();
var minTimeExpiration = hours + ':' + minutes;
/*      format: 'd/m/Y H:i',
    minTime:minTimeExpiration,
*/
$('#id_expiration').datetimepicker({
    format: 'd/m/Y',
    lang:'fr',
    minDate:'-1970/01/01',
    timepickerScrollbar:false,
    timepicker:false,
    dayOfWeekStart:1,
});
});

$( document ).ready(function(){
$('#id_birthday').datetimepicker({
    format: 'Y-m-d',
    lang:'fr',
    timepickerScrollbar:false,
    dayOfWeekStart:1,
    timepicker:false,
    maxDate:'1998/01/01',
    startDate:'1997/01/01',
});


$('body').click(function (e) {
    $('[data-toggle="social-share-content"]').each(function (index, element) {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });

    $('[data-toggle="social-share-content-company"]').each(function (index, element) {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('hide');
        }
    });
});


});


$(document).ready(function(){


    $('[data-toggle="report-request"]').popover({
        placement : 'bottom',
        animation : 'true',
        html : 'true',
        delay: { "show": 100, "hide": 100 }
    });

    $('[data-toggle="report-message"]').popover({
        placement : 'bottom',
        animation : 'true',
        html : 'true',
        delay: { "show": 100, "hide": 100 }
    });

     $('[data-toggle="report-answer"]').popover({
        placement : 'bottom',
        animation : 'true',
        html : 'true',
        delay: { "show": 100, "hide": 100 }
    });


});


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


function share_on_facebook(id, request_type){

    var picture = "test";
    var caption = '';
    var description = '';
    var url = '';
    var tiny_url = '';

    if (request_type == 'user'){
        url = 'ajax/request/';
    }
    else{
        url = 'ajax/request/company/';
    }

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

    $.ajax({
        type: "get",
        dataType: 'json',
        url: url + id,
        async: false,
        success: function(data) {
            console.log(data);
            picture = 'http://styx-students.com/' + data.url_picture;
            caption = decodeURIComponent(data.title).replace("&#39;", "'");
            description = data.description.replace('&#39;', "'");
            tiny_url = data.tiny_url;
        },
        error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
        }
    });
    share_on_facebook_go(id, picture, caption, description, tiny_url, request_type);

    $('[data-toggle="social-share-content"]').each(function(index, element) {
        var contentElementId = $(element).attr('id');
        $(element).popover('hide');
    })

    $('[data-toggle="social-share-content-company"]').each(function(index, element) {
        var contentElementId = $(element).attr('id');
        $(element).popover('hide');
    })
}


function add_share_content(id, request_type){

    var caption = '';
    var url = '';
    var tiny_url = '';

    if (request_type == 'user'){
        url = 'ajax/request/';
    }
    else{
        url = 'ajax/request/company/';
    }

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

    $.ajax({
        type: "get",
        dataType: 'json',
        url: url + id,
        async: false,
        success: function(data) {
                caption = decodeURIComponent(data.title).replace("&#39;", "'");
                tiny_url = data.tiny_url;
            },
        error : function(resultat, statut, erreur){
        console.log("error :" + resultat + " " + statut+ " " + erreur);
       }
    });

    if (request_type == 'user'){
        $('[data-toggle="social-share-content"]').each(function(index, element) {
            var contentElementId = $(element).attr('id');
            if(contentElementId == ("social-share-content-" + id)){
                $(element).popover({ content :'<div id="share_button-' + id + '" class="btn-facebook" onclick="share_on_facebook(\'' + id + '\', \'user\');"><img src="https://www.facebook.com/favicon.ico"></img>Partager</div> <br><center><a class="twitter-share-button"  data-text="Nouvelle annonce sur #Styx : ' + caption + '. Rends-toi sur -->" data-via="styx_fr" data-url="http://www.styx-students.com/' + tiny_url + '" original_referer="http://styx-students.com/' + tiny_url + '">Tweet</a></center>',
                                     placement : 'bottom',
                                     animation : 'true',
                                     html : 'true',
                                     delay: { "show": 100, "hide": 100 }
                                   });

                $(element).popover('show');
                twttr.widgets.load();
            }
            else {
                $(element).popover('hide');
                }
            $('[data-toggle="social-share-content-company"]').each(function(index, element) {
                $(element).popover('hide');
            });
        });
    }
    else{
        $('[data-toggle="social-share-content-company"]').each(function(index, element) {
            var contentElementId = $(element).attr('id');
            if(contentElementId == ("social-share-content-company-" + id)){
                $(element).popover({ content :'<div id="share_button-company-' + id + '" class="btn-facebook" onclick="share_on_facebook(' + id + ', \'company\');"><img src="https://www.facebook.com/favicon.ico"></img>Partager</div> <br><center><a class="twitter-share-button"  data-text="Nouvelle annonce sur #Styx : ' + caption + '. Rends-toi sur -->" data-via="styx_fr" data-url="http://www.styx-students.com" original_referer="http://styx-students.com/demande/' + id + '">Tweet</a></center>',
                                     placement : 'bottom',
                                     animation : 'true',
                                     html : 'true',
                                     delay: { "show": 100, "hide": 100 }
                                    });

                $(element).popover('show');
                twttr.widgets.load();
            }
            else {
                $(element).popover('hide');
            }
            $('[data-toggle="social-share-content"]').each(function(index, element) {
                $(element).popover('hide');
            });
        });
    }

}

// Request

$(document).on('click','#request-accept-edit',function(){

    if(request_edited){

        new_description = $('#id_description').val();
        new_expiration = $("#id_expiration_edit").val();
        if((new_description != old_description) || (old_date != new_expiration)){
            console.log("edited !");

            var formData = {'date':new_expiration, 'description': new_description};
            $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                        }
                }
                });
            var pathArray = window.location.pathname.split( '/' );
            var last_element = pathArray[pathArray.length - 1];

            $.ajax({
                type: "POST",
                url: 'ajax/request/edit/' + last_element,
                data: formData,
                dataType: 'JSON',
                async:false,
                success: function(){
                    console.log("test");

                }
            });
        }

        $('#request-description').html(new_description);
        $('#request-expiration').html('<span  class="label label-warning label-date"><span class="glyphicon glyphicon-calendar white request-inline-point"></span>' +   new_expiration + '</span>');
        request_edited = false;
     $('#request-accept-edit').html('');
     window.location= window.location.pathname;
    }

});

$(document).on('click','#request-cancel-edit',function(){

    if(request_edited){
        window.location= window.location.pathname;

        }

});



$(document).ready(function(){

$('#request-edit-request').click(function(){

    old_description = encode($('#request-description').text());
    old_date = $('#request-date-expiration').text().replace(" ", "");

    $('#request-description').html('<textarea cols="40" id="id_description" name="description" placeholder="Description" rows="10" style="height: 75px; width:100%">' + old_description + '</textarea>');
    $('#request-expiration').html('<input id="id_expiration_edit" name="expiration" readonly="True" type="text">');

    $('#request-accept-edit-div').html('<div class="container container-request"> <div class="quicsk-choice"> <div class="col-sm-2 col-sm-offset-4 col-xs-offset-0 col-xs-6"> <div id="request-cancel-edit" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove white"></span> Annuler</div> </div> <div class="col-md-2 col-md-offset-4 col-xs-6"> </div> <div class="col-md-3 col-xs-5"> <div id="request-accept-edit" class="btn btn-info"> <span class="glyphicon glyphicon-floppy-disk white"></span> Valider les modifications</div> </div> </div> </div>');

    var date = new Date();
    var hours = date.getHours().toString();
    var minutes = date.getMinutes().toString();
    var minTimeExpiration = hours + ':' + minutes;

    $('#id_expiration_edit').datetimepicker({
        format: 'd/m/Y',
        lang:'fr',
        minDate:date,
        timepickerScrollbar:false,
        timepicker:false,
        dayOfWeekStart:1,
        value: old_date
    });

    request_edited = true
        $(".container-request").css("background-color", "beige");
        $(".container-request").css("padding-bottom", "20px");
});


$('#request-edit-request-mobile').click(function(){

    old_description = encode($('#request-description-mobile').text());
    old_date = $('#request-date-expiration').text().replace(" ", "");

    $('#request-description-mobile').html('<textarea cols="40" id="id_description" name="description" placeholder="Description" rows="10" style="height: 75px; width:100%">' + old_description + '</textarea>');
    $('#request-expiration-mobile').html('<input id="id_expiration_edit" name="expiration" readonly="True" type="text">');

    $('#request-accept-edit-div').html('<div class="container container-request"> <div class="quicsk-choice"> <div class="col-xs-3"> <div id="request-cancel-edit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-floppy-remove white"></span> Annuler</div> </div> <div class="col-xs-2"> </div> <div class="col-xs-5"> <div id="request-accept-edit" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-floppy-disk white"></span> Valider les modifications</div> </div> </div> </div>');

    var date = new Date();
    var hours = date.getHours().toString();
    var minutes = date.getMinutes().toString();
    var minTimeExpiration = hours + ':' + minutes;

    $('#id_expiration_edit').datetimepicker({
        format: 'd/m/Y',
        lang:'fr',
        minDate:date,
        timepickerScrollbar:false,
        timepicker:false,
        dayOfWeekStart:1,
        value: old_date
    });

    request_edited = true
        $(".container-request").css("background-color", "beige");
        $(".container-request").css("padding-bottom", "20px");
});

});
// Edit Answer
var old_comment = "";
var answer_edited = false;


function request_edit_answer(id, device){

    if(device == 'laptop'){
        old_comment = $('#request-answer-comment-' + id).text().trim();
        $('#request-answer-comment-' + id).html('<textarea cols="40" id="id_comment-' + id + '" name="description" placeholder="Description" rows="10" style="height: 75px; width:100%">' + old_comment + '</textarea>');
        $('#request-answer-accept-edit-'+ id).html('<div class="btn btn-info btn-xs btn-edit"><span class="glyphicon glyphicon-floppy-disk white request-inline-point"></span> Envoyer</div>');
        $('#request-answer-cancel-edit-'+ id).html('<div class="btn btn-danger btn-xs btn-edit"><span class="glyphicon glyphicon-floppy-remove white request-inline-point"></span> Annuler</div>');
        $('#request-answer-delete-edit-'+ id).html('<div class="btn btn-default-styx btn-xs btn-edit"> <span class="glyphicon glyphicon-trash white request-inline-point"></span> Supprimer</div>');

    }
    else if(device == 'mobile'){
        old_comment = $('#request-answer-comment-mobile-' + id).text().trim();
        $('#request-answer-comment-mobile-' + id).html('<textarea cols="40" id="id_comment-' + id + '" name="description" placeholder="Description" rows="10" style="height: 75px; width:100%">' + old_comment + '</textarea>');
        $('#request-answer-accept-edit-mobile-'+ id).html('<div class="btn btn-info btn-xs btn-edit-mobile"><span class="glyphicon glyphicon-floppy-disk white request-inline-point"></span> Envoyer</div>');
        $('#request-answer-cancel-edit-mobile-'+ id).html('<div class="btn btn-danger btn-xs btn-edit-mobile"><span class="glyphicon glyphicon-floppy-remove white request-inline-point"></span> Annul.</div>');
        $('#request-answer-delete-edit-mobile-'+ id).html('<div class="btn btn-default-styx btn-xs btn-edit-mobile"> <span class="glyphicon glyphicon-trash white request-inline-point"></span> Supp.</div>');

    }
    answer_edited = true;
}

function request_edit_delete_answer(id, device){

window.location= '/demandes/answer/delete/' + id;

}

function request_edit_cancel_answer(id, device){
    if(device == 'laptop'){
         $('#request-answer-comment-' + id).html('<p>' + old_comment + '</p>');
         $('#request-answer-accept-edit-'+ id).html('');
         $('#request-answer-delete-edit-'+ id).html('');
         $('#request-answer-cancel-edit-'+ id).html('');
    }
    else if(device == 'mobile'){
         $('#request-answer-comment-mobile-' + id).html('<p>' + old_comment + '</p>');
         $('#request-answer-accept-edit-mobile-'+ id).html('');
         $('#request-answer-cancel-edit-mobile-'+ id).html('');
         $('#request-answer-delete-edit-mobile-'+ id).html('');

    }

 answer_edited = false
}

function request_edit_accept_answer(id, device){
    if(answer_edited){


    new_comment = $('#id_comment-' + id).val();

    if(new_comment != old_comment){
        console.log('edited');

            var formData = {'comment': new_comment};
            $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                        }
                }
            });

            $.ajax({
                type: "POST",
                url: 'ajax/comment/edit/' + id,
                data: formData,
                dataType: 'JSON',
                success: function(){
                    console.log("test");

                }
            });

        if (device == 'laptop'){
        $('#request-answer-comment-' + id).html('<p>' + new_comment + '</p>');
        }
        else{
        $('#request-answer-comment-mobile-' + id).html('<p>' + new_comment + '</p>');
        }



    }
    else{
    if (device == 'laptop'){
     $('#request-answer-comment-' + id).html('<p>' + old_comment + '</p>');
     }
     else{
     $('#request-answer-comment-mobile' + id).html('<p>' + old_comment + '</p>');
     }

    }
    if (device == 'laptop'){
        $('#request-answer-accept-edit-'+ id).html('');
        $('#request-answer-delete-edit-'+ id).html('');
        $('#request-answer-cancel-edit-'+ id).html('');
        }
    else{
            $('#request-answer-accept-edit-mobile-'+ id).html('');
        $('#request-answer-delete-edit-mobile-'+ id).html('');
        $('#request-answer-cancel-edit-mobile-'+ id).html('');

    }
        answer_edited = false
    }

}


function request_report_date(id, device){
    old_date = $('#request-date-expiration').text().replace(" ", "");


    if( device == 'laptop'){
        $('#request-accept-edit-div').html('<div class="container container-request"> <div class="quicsk-choice"> <div class="col-sm-2 col-sm-offset-4 col-xs-offset-0 col-xs-6"> <div id="request-cancel-edit" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove white"></span> Annuler</div> </div> <div class="col-md-2 col-md-offset-4 col-xs-6"> </div> <div class="col-md-3 col-xs-5"> <div id="request-accept-edit" class="btn btn-info"> <span class="glyphicon glyphicon-floppy-disk white"></span> Valider les modifications</div> </div> </div> </div>');
            $('#request-expiration-past-due').html('<input id="id_expiration_edit" name="expiration" readonly="True" type="text">');
    }
    else{
        $('#request-accept-edit-div').html('<div class="container container-request"> <div class="quicsk-choice"> <div class="col-xs-3"> <div id="request-cancel-edit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-floppy-remove white"></span> Annuler</div> </div> <div class="col-xs-2"> </div> <div class="col-xs-5"> <div id="request-accept-edit" class="btn btn-info btn-xs"> <span class="glyphicon glyphicon-floppy-disk white"></span> Valider les modifications</div> </div> </div> </div>');
        $('#request-expiration-mobile').html('<input id="id_expiration_edit" name="expiration" readonly="True" type="text">');
    }
    var date = new Date();
    var hours = date.getHours().toString();
    var minutes = date.getMinutes().toString();
    var minTimeExpiration = hours + ':' + minutes;

    $('#id_expiration_edit').datetimepicker({
        format: 'd/m/Y',
        lang:'fr',
        minDate:date,
        timepickerScrollbar:false,
        timepicker:false,
        dayOfWeekStart:1,
        value: old_date
    });

    request_edited = true
     $(".container-request").css("background-color", "beige");
     $(".container-request").css("padding-bottom", "20px");
}



function reportRequest(idRequest) {
        var com = $("#report-com-request").val();
        var formData = {'commentaire':com};
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
            }
            });
        $.ajax({
            type: "POST",
            url: 'report/request/' + idRequest,
            data: formData,
            success: function(){
              $('[data-toggle="report-request"]').each(function() {
                 $(this).popover('hide');
                });

            }
        });
    };

function reportMessage(idMessage) {
        var com = $("#report-com-message").val();
        var formData = {'commentaire':com};
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
            }
            });
        $.ajax({
            type: "POST",
            url: 'report/message/' + idMessage,
            data: formData,
            success: function(){
              $('[data-toggle="report-message"]').each(function() {
                 $(this).popover('hide');
                });

            }
        });
    };

function reportAnswer(idAnswer) {
        var com = $("#report-com-answer").val();
        var formData = {'commentaire':com};
        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
            }
            });
        $.ajax({
            type: "POST",
            url: 'report/answer/' + idAnswer,
            data: formData,
            success: function(){
              $('[data-toggle="report-answer"]').each(function() {
                 $(this).popover('hide');
                });

            }
        });
    };


    // Contact Admin
$(document).ready(function(){

    $("#contactAdmin-submit").click( function() {
    $("#contactAdmin-submit").removeClass("btn-info");
    $("#contactAdmin-submit").addClass("btn-warning");
    subject = $("#id_subject").val();
    comment = $("#id_comment").val();
    toSend = { comment : comment, subject:subject}
        var urlSubmit = "/manage/contactadmin/"//$(this).attr('action');
        $.ajaxSetup({
          beforeSend: function(xhr, settings) {
               if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                  xhr.setRequestHeader("X-CSRFToken", csrftoken);

               }
          }
    });
        $.ajax({
            type: "POST",
            url: urlSubmit,
            data      : toSend,
            success: function(data) {
                 $("#contactAdmin").modal('hide');
                //e.preventDefault()
            }
        });

        return false;

    });
    $("#profil-button-contactAdmin").click( function() {
        $("#contactAdmin-submit").removeClass("btn-warning");
        $("#contactAdmin-submit").addClass("btn-info");

    })

});





function isScrolledIntoView(elem)
{
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
$(document).ready(function(){
$("#id_filter-city-feed").change(function(){

        window.location='/feed?filter=2&zone=' + $(this).val();
    });
});


function isInArray(array, search)
{
    return array.indexOf(search) >= 0;
}


$(document).ready(function(){
    $(window).scroll(function () {
        var h = window.innerHeight
        || document.documentElement.clientHeight
        || document.body.clientHeight;

        if ($(window).scrollTop() + h >= $(document).height() - 10 && !searchBlock) {
            searchBlock = true;
            var loaderIDExist = document.getElementById('loader');
            if(loaderIDExist != null){
                Show('loader');
                var pathArray = window.location.pathname.split( '/' );

                if (isInArray(pathArray, "search")){
                    var toSend = { result : $('#result').text()};
                    var nextpage = parseInt($('#page').text())+10;
                    var urlSubmit = "/search/" + nextpage;

                    $.ajaxSetup({
                        beforeSend: function(xhr, settings) {
                            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                                xhr.setRequestHeader("X-CSRFToken", csrftoken);
                            }
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: urlSubmit,
                        dataType : "JSON",
                        data      : toSend,
                        success: function(data) {
                            for(i = 0 ; i < data.users.length-1; i++){
                                strline = "";
                                strline += '<div class="news-feed-request-contrainer hidden-xs" onmouseover="this.style.background=\'#EDEDED\'; "onmouseout="this.style.background=\'#FAFAFA\';">';
                                strline += '<div class="row">';
                                strline += '<div class="col-md-4 cursor-pointer request-block-icone vcenter" onclick="goToProfil(\'' + data.users[i]['identifier'] + '\');">';
                                strline += '<div class="col-md-4 request-icone vcenter">';
                                strline += '<ul class="img-list">';
                                strline += '<li>';
                                strline += '<img src="' + data.users[i]['avatar'] + '" style="height:70px; width:70px;">';
                                strline += '</li>';
                                strline += '</ul>';
                                strline += '</div><!--';
                                strline += '--><div class="col-md-8 request-title vcenter">';
                                strline += '<h4 class="filmotypeAlice-font"><b>'+ data.users[i]['firstname']  + ' ' + data.users[i]['name'] + '</b></h4>';
                                strline += '</div>';
                                strline += '</div><!--';
                                strline += '--><div class="col-md-8 cursor-pointer request-block-resume vcenter">';
                                strline += '<div class="row">';
                                strline += '<div class="col-md-6 cursor-pointer vcenter" onclick="goToProfil(\'' + data.users[i]['identifier'] + '\');">';
                                strline += '<p class="text-justify filmotypeAlice-font"><em>' + data.users[i]['averagenote'] + '/5</em> <img class="profil-stars" src="/static//images/note_' + data.users[i]['averagenote'] + '.png" alt="Note"></p>';
                                strline += '</div><!--';
                                strline += ' --><div class="col-md-3 vcenter">';
                                strline += data.users[i]['school'];
                                strline += '</div><!--';
                                strline += '--><div class="col-md-3 vcenter">';
                                strline += data.users[i]['department'] + '(' + data.users[i]['zipcode'] + ')';
                                strline += '</div>';
                                strline += ' </div>';
                                strline += ' </div>';
                                strline += ' </div>';
                                strline += ' </div>';

                                strline += '<div class="news-feed-request-contrainer hidden-md hidden-lg hidden-sm">';
                                strline += '<div class="row" onclick=' + data.users[i]['id'] +'>';
                                strline += '<div class="col-xs-3">';
                                strline += '<ul class="img-list">';
                                strline += '<li>';
                                strline += '<img src="' + data.users[i]['avatar'] + '" style="height:60px; width:60px;">';
                                strline += '</li>';
                                strline += '</ul>';
                                strline += '</div>';
                                strline += '<div class="col-xs-9">';
                                strline += '<div class="row">';
                                strline += '<h5 class="text-center filmotypeAlice-font"><b>'+ data.users[i]['firstname']  + ' ' + data.users[i]['name'] + '</b></h5>';
                                strline += '</div>';
                                strline += '<div class="row">';
                                strline += '<p class="text-justify filmotypeAlice-font"><em>' + data.users[i]['averagenote'] + '/5</em> <img class="profil-stars" src="/static//images/note_' + data.users[i]['averagenote'] + '.png" alt="Note"></p>';
                                strline += '</div>';
                                strline += '</div>';
                                strline += '</div>';
                                strline += ' <div class="row">';
                                strline += '<div class="col-xs-7">';
                                strline += data.users[i]['school'];
                                strline += '</div>';
                                strline += '<div class="col-xs-5">';
                                strline += data.users[i]['department'] + '(' + data.users[i]['zipcode'] + ')';
                                strline += '</div>';
                                strline += '</div>';
                                strline += '</div>';

                                $('.results').append(strline);

                            }
                            $('#page').text(nextpage);
                            if(data.users.length < 10){
                                $('#loader').remove();
                            }
                        },

                   error : function(resultat, statut, erreur){
                    console.log("error :" + resultat + " " + statut+ " " + erreur);
                   },
                   complete : function(resultat, statut){
                        searchBlock = false;
                   }

                    });
               }

              else if (isInArray(pathArray, "feed")){
                    page_request += 1;
                    var toSend = { page_request : page_request};
                    var urlSubmit = "/ajax/request/page/";

                    $.ajaxSetup({
                        beforeSend: function(xhr, settings) {
                            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                                xhr.setRequestHeader("X-CSRFToken", csrftoken);
                            }
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: urlSubmit,
                        dataType : "JSON",
                        data      : toSend,
                        success: function(data) {
                            for(i = 0 ; i < data.requests.length-1; i++){

                                strline  = "";
                                strline += '<div class="news-feed-request-contrainer hidden-xs" onMouseOver="this.style.background=\'#EDEDED\';" onMouseOut="this.style.background=\'#FAFAFA\';">';
                                strline += '<div class="row">';
                                strline += '<div class="col-md-4 cursor-pointer request-block-icone vcenter" onclick="goToRequest('+ data.requests[i].id + ');">';
                                strline += '<div class="col-md-4 request-icone vcenter">';
                                strline += '<ul class="img-list"><li>';
                                strline += '<img style="height:auto; max-width:80px;" src="' + data.requests[i].category_image_url + '">';
                                strline += '<span class="text-content"><span>' + data.requests[i].category_name + '</span></span>';
                                strline += '</li></ul>';
                                strline += '</div><!--';
                                strline += '--><div class="col-md-8 vcenter">';
                                strline += '<h4 class="filmotypeAlice-font request-title"><b>' + data.requests[i].title_pc + '</b></h4>';
                                strline += '</div></div><!--';
                                strline += '--><div class="col-md-8 cursor-pointer request-block-resume vcenter">';
                                strline += '<div class="row">';
                                strline += '<div class="col-md-9 cursor-pointer vcenter" onclick="goToRequest(' + data.requests[i].id + ');">';
                                strline += '<p class="text-justify text-inline-request filmotypeAlice-font">' + data.requests[i].description_pc + '</p>';
                                strline += '</div><!-- --><div class="col-md-2 request-avatar vcenter">';

                                if ( data.requests[i].owner_picture_url != ""){
                                    strline += '<a href="/profil/' + data.requests[i].owner_identifier + '"> <img src="/media/' + data.requests[i].owner_picture_url + '" style="height:70px; width:70px;"></a>';
                                }
                                else{
                                    strline += '<a href="/profil/' + data.requests[i].owner_identifier + '"> <img src="/static/images/user.jpg" style="height:70px; width:70px;"></a>';
                                }

                                strline += '</div><!-- --><div class="col-md-1 cursor-pointer vcenter-not">';

                                if ( data.requests[i].owner_identifier != data.connected_user_identifier ){

                                    //strline += '<div class="pull-right"><a tabindex="0" id="report-request" data-toggle="report-request"data-content="<p><input id="report-com-request" placeholder="Ajouter un commentaire" type="text" name="commentaire" /></p>';
                                    //strline += '<button id="report-form-request" onclick="reportRequest(' + data.requests[i].id + ')">Confirmer</button> " title="Signaler la demande"> <span class="glyphicon glyphicon-menu-down"></span> </a></div>';
                                }

                                strline += '</div></div> <div class="row request-bottom-information">';
                                strline += '<div class="col-md-7 cursor-pointer news-feed-request-contrainer-date" onclick="goToRequest(' + data.requests[i].id + ');">';

                                if ( data.requests[i].validated == "True"){

                                    strline += '<span class="label label-info label-date"><span class="glyphicon glyphicon-ok white request-inline-point"></span>  Un deal a été conclu !</span>';
                                    strline += '<span class="label label-info label-point"> <span class="glyphicon glyphicon-piggy-bank white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].point + '</p></b></span>';
                                    strline += '<span class="label label-info label-participant"> <span class="glyphicon glyphicon-user white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].user_selected_count + '/' + data.requests[i].max_participant + '</p></b></span>';
                                }
                                else if ( data.requests[i].is_past_due == "True" ) {

                                    strline += '<span class="label label-default label-date"><span class="glyphicon glyphicon-time white request-inline-point"></span> Demande expirée</span>';
                                    strline += '<span class="label label-default label-point"> <span class="glyphicon glyphicon-piggy-bank white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].point + '</p></b></span>';
                                    strline += '<span class="label label-default label-participant"> <span class="glyphicon glyphicon-user white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].user_selected_count + '/' + data.requests[i].max_participant + '</p></b></span>';
                                }
                                else{
                                    strline += '<span class="label label-warning label-date"><span class="glyphicon glyphicon-calendar white request-inline-point"></span>' +  data.requests[i].expiration + '</span>';
                                    strline += '<span class="label label-warning label-point"> <span class="glyphicon glyphicon-piggy-bank white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].point + '</p></b></span>';
                                    strline += '<span class="label label-warning label-participant"> <span class="glyphicon glyphicon-user white request-inline-point"></span><b> <p class="icone-white">' + data.requests[i].user_selected_count + '/' + data.requests[i].max_participant + '</p></b></span>';
                                }

                                strline += '</div><div class="col-md-1 cursor-pointer news-feed-request-contrainer-date" onclick="goToRequest(' + data.requests[i].id + ');">';
                                strline += '<span class="glyphicon glyphicon-comment color-icone request-inline-point"></span><b> <p class="color-icone">' + data.requests[i].answer_count + '</p></b>';
                                strline += '</div><div class="col-md-1 cursor-pointer news-feed-request-contrainer-date" onclick="goToRequest(' + data.requests[i].id + ');">';
                                strline += '<span class="glyphicon glyphicon-eye-open color-icone request-inline-point"></span><b> <p class="color-icone">' + data.requests[i].count_views + '</p></b>';
                                strline += '</div><div class="col-md-2 cursor-pointer" onclick="goToRequest(' + data.requests[i].id + ');">';
                                strline += '<div class="news-feed-request-contrainer-author-xs">';
                                strline += '<a href="/profil/' + data.requests[i].owner_identifier + '"> ' + data.requests[i].owner_firstname  + ' ' + data.requests[i].owner_name + '</a>';



                                $('#feed-requests').append(strline);


                            }
                            if(data.requests.length < 10){
                                $('#loader').remove();
                            }
                        },

                   error : function(resultat, statut, erreur){
                    console.log("error :" + resultat + " " + statut+ " " + erreur);
                   },
                   complete : function(resultat, statut){
                        searchBlock = false;
                   }

                    });


              }
            }
       }
    });



});

$(document).ready(function(){
var feedfiltersIDExist = document.getElementById('feed-filters');
if (feedfiltersIDExist != null){
  // Get a reference to our touch-sensitive element
  var canvas = document.getElementById("feed-filters");
   // Get a reference to our touch-sensitive element
  var touchzone = document.getElementById("touchzone");
  // Add an event handler for the touchstart event

  document.getElementById('feed-filters').style["margin-left"] = 0;

  // Add an event handler for the touchstart event
  canvas.addEventListener("touchmove", move, false);
  canvas.addEventListener("touchstart", touchStartFilter, false);
  canvas.addEventListener("touchend", touchEndFilter, false);
  canvas.addEventListener("touchcancel", touchEndFilter, false);
}

    Chart.defaults.global.responsive = true;
});

function touchEndFilter(event){

if (filterX = 0){
lastDefinitiveX = 0;
}
else{
lastDefinitiveX = lastDefinitiveX + (touchX - startTouchFilterX);
}
}

function touchStartFilter(event){

    if(startTouchFilterX == null){
        filterX = 0;
        lastDefinitiveX = 0;
        filterWidth = parseInt(document.getElementById('feed-filters').offsetWidth);
    }

    startTouchFilterX = event.touches[0].pageX;

}

function move(event) {

      touchX = event.touches[0].pageX;
      filterX = lastDefinitiveX + (event.touches[0].pageX - startTouchFilterX);
      if(filterX > 0){
        filterX = 0;
      }

      document.getElementById('feed-filters').style["margin-left"] = filterX;
      document.getElementById('feed-filters').style["width"] = filterWidth - filterX;

}

    function deleteCookie(c_name) {
        document.cookie = encodeURIComponent(c_name) + "=deleted; expires=" + new Date(0).toUTCString();
    }
  function setCookie() {
            deleteCookie('id_school');
            deleteCookie('nameSchool');
            deleteCookie('id_city');
            deleteCookie('nameCity');
            deleteCookie('department');

            document.cookie = "nameCity=" + encodeURIComponent(document.getElementById('id_city').value) + ";path=/";
            document.cookie = "id_school=" + id_school_selected + ";path=/";
            document.cookie = "nameSchool=" + encodeURIComponent(document.getElementById('id_school').value) + ";path=/";
            document.cookie = "id_city=" + id_city_selected + ";path=/";
            document.cookie = "department=" + document.getElementById('id_department').value + ";path=/";
  };


function quick_request_click(id){

        $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                }
            }
        });

        $.ajax({
            type: "get",
            dataType: 'json',
            url: "/quickrequest/" + id,
            success: function(data) {
                displayNewsFeedForm();
                document.getElementById('id_title').value = decodeURIComponent(data.title).replace("&#39;", "'");
                document.getElementById('id_description').value = decodeURIComponent(data.description).replace('&#39;', "'");
                document.getElementById('id_point').value = data.point;
                document.getElementById('id_max_participant').value = data.max_participant;
                $( "#id_type"+data.id_type).click();
                updateCategories(data.id_type, "", data.id_category);
                $("#id_expiration").datepicker( "show" );
                },
                 error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
           },
            });

}


function accept_gift(id){

if( $('.navbar-mobile-profil').css('display')=='none') {
        $(".gift").animate({left:'120%', marginTop:'-100px', width:'20px', height:'20px'}, 3000);
    }
else{

    $(".gift").animate({left:'-70%', marginTop:'-150px', width:'20px', height:'20px'}, 3000);
}

 $.ajaxSetup({
            beforeSend: function(xhr, settings) {
                if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                    xhr.setRequestHeader("X-CSRFToken", csrftoken);
                }
            }
        });

        $.ajax({
            type: "get",
            dataType: 'json',
            url: "/ajax/user/gift/" + id,
            success: function(data) {

                },
                 error : function(resultat, statut, erreur){
            console.log("error :" + resultat + " " + statut+ " " + erreur);
           },
            });
    window.setTimeout(reload_page, 2500);
}

function reload_page(){
window.location='/feed'
}

// REQUEST COMPANY

function get_code(id_c_request){

$('#id_comment').val("J'en profite");
$('#id_advantage').val(true);
document.getElementById("id_sendAnswer").click();

}

// END REQUEST COMPANY




// ANALYTICS

function extract_analysis_signup_month_data(data){
    result = [];
    for(i = 0 ; i < data.months.length-1; i++){
        result.push(parseInt(data.months[i].users));
        }
        console.log(result);
    return result;
}


function show_analytics_signup_month(){
    document.getElementById("row_chart_signup_month").innerHTML = '<canvas id="chart_signup_month" width="1000" height="400"></canvas>';
    if(typeof myLineChart != "undefined"){
        myLineChart.destroy();
    }
    var options = {bezierCurve : false,};

    var data_char = {};

    $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
                }
            });

            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/ajax/admin/analytics/signup_month/",
                success: function(data) {
                    data_tmp = extract_analysis_signup_month_data(data);
                    data_char = {
                        labels: ["Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre", "Janvier", "Fevrier", "Mars"],
                        datasets: [
                            {
                                label: "My First dataset",
                                fillColor: "rgba(220,220,220,0.2)",
                                strokeColor: "rgba(220,220,220,1)",
                                pointColor: "rgba(220,220,220,1)",
                                pointStrokeColor: "#fff",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(220,220,220,1)",
                                data: data_tmp
                            }]
                        };
                        var ctx = document.getElementById("chart_signup_month").getContext("2d");
                        var myLineChart = new Chart(ctx).Line(data_char, options);

                    },
                     error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
               },
                });

}

function show_analytics_signup_day(){


}

function extract_analysis_zone_labels(data){
    result = [];
    for(i = 0 ; i < data.zones.length-1; i++){
        result.push(data.zones[i].label);
        }
    return result;
}

function extract_analysis_zone_population(data){
    result = [];
    for(i = 0 ; i < data.zones.length-1; i++){
        result.push(parseInt(data.zones[i].population));
        }
    return result;
}

function show_analytics_zones(){


    document.getElementById("row_chart_zone").innerHTML = '<canvas id="chart_zone" width="1000" height="400"></canvas>';

    if(typeof myBarChart != "undefined"){
        myBarChart.destroy();
    }
    var options = {};

    var data_char = {};

    $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
                }
            });

            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/ajax/admin/analytics/zones/",
                success: function(data) {
                    data_tmp_labels = extract_analysis_zone_labels(data);
                    data_tmp_population = extract_analysis_zone_population(data);
                    data_char = {
                        labels: data_tmp_labels,
                        datasets: [
                            {
                                label: "My First dataset",
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: data_tmp_population
                            }]
                        };
                        var ctx2 = document.getElementById("chart_zone").getContext("2d");
                        var myBarChart = new Chart(ctx2).Bar(data_char, options);

                    },
                     error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
               },
                });

    canvas = $("#chart_zone");

}

function extract_analysis_user_devices(data){

    var result = '[';
    for(i = 0 ; i < data.devices.length-1; i++){
        result += '{"label":"' + data.devices[i].label + '","value":' + data.devices[i].value + ',"color":"' + global_color[i] + '","highlight":"' + global_highlight[i] + '"},';
        }
        if(result != "["){
        result = result.slice(0, -1);
        result += ']';
        }
        else{
        result = "";
        }
    return JSON.parse(result);
}

function extract_analysis_user_browsers(data){

    var result = '[';
    for(i = 0 ; i < data.browsers.length-1; i++){
        result += '{"label":"' + data.browsers[i].label + '","value":' + data.browsers[i].value + ',"color":"' + global_color[i] + '","highlight":"' + global_highlight[i] + '"},';
        }
        if(result != "["){
        result = result.slice(0, -1);
        result += ']';
        }
        else{
        result = "";
        }
    return JSON.parse(result);
}

function extract_analysis_user_supports(data){

    var result = '[';
    for(i = 0 ; i < data.supports.length-1; i++){
        result += '{"label":"' + data.supports[i].label + '","value":' + data.supports[i].value + ',"color":"' + global_color[i] + '","highlight":"' + global_highlight[i] + '"},';
        }
        if(result != "["){
        result = result.slice(0, -1);
        result += ']';
        }
        else{
        result = "";
        }
    return JSON.parse(result);
}

function extract_analysis_user_pages_labels(data){
    result = [];
    for(i = 0 ; i < data.pages.length-1; i++){
        result.push(data.pages[i].label);
        }
    return result;
}

function extract_analysis_user_pages_count(data){
    result = [];
    for(i = 0 ; i < data.pages.length-1; i++){
        result.push(parseInt(data.pages[i].value));
        }
    return result;
}

function show_analytics_user(){

    document.getElementById("row_chart_user_devices").innerHTML = '<canvas id="chart_user_devices" width="1000" height="400"></canvas>';
    document.getElementById("row_chart_user_browsers").innerHTML = '<canvas id="chart_user_browsers" width="1000" height="400"></canvas>';
    document.getElementById("row_chart_user_pages").innerHTML = '<canvas id="chart_user_pages" width="1000" height="400"></canvas>';
    document.getElementById("row_chart_user_support").innerHTML = '<canvas id="chart_user_supports" width="1000" height="400"></canvas>';

    var options = {};
    var data_devices = {};

    $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
                }
            });

            var pathArray = window.location.pathname.split( '/' );
            var last_element = pathArray[pathArray.length - 1];
            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/ajax/admin/analytics/user/" + last_element,
                success: function(data) {

                    data_devices = extract_analysis_user_devices(data);
                    data_browsers = extract_analysis_user_browsers(data);
                    data_supports = extract_analysis_user_supports(data);
                    data_pages_labels = extract_analysis_user_pages_labels(data);
                    data_pages_data = extract_analysis_user_pages_count(data);

                    data_char = {
                        labels: data_pages_labels,
                        datasets: [
                            {
                                label: data_pages_labels,
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: data_pages_data
                            }]
                    };

                    var ctx = document.getElementById("chart_user_devices").getContext("2d");
                    var myDoughnutChart = new Chart(ctx).Doughnut(data_devices ,options);

                    var ctx2 = document.getElementById("chart_user_browsers").getContext("2d");
                    var myDoughnutChart2 = new Chart(ctx2).Doughnut(data_browsers ,options);

                    var ctx3 = document.getElementById("chart_user_pages").getContext("2d");
                    var myBarChart = new Chart(ctx3).Bar(data_char, options);

                    var ctx4 = document.getElementById("chart_user_supports").getContext("2d");
                    var myDoughnutChart3 = new Chart(ctx4).Doughnut(data_supports ,options);

                    },
                     error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
               },
                });

}


function extract_analysis_zone_schools_labels(data){
    result = [];
    for(i = 0 ; i < data.schools.length-1; i++){
        result.push(data.schools[i].label);
        }
    return result;
}

function extract_analysis_zone_schools_count(data){
    result = [];
    for(i = 0 ; i < data.schools.length-1; i++){
        result.push(parseInt(data.schools[i].value));
        }
    return result;
}

function extract_analysis_zone_categories_labels(data){
    result = [];
    for(i = 0 ; i < data.categories.length-1; i++){
        result.push(data.categories[i].label);
        }
    return result;
}

function extract_analysis_zone_categories_count(data){
    result = [];
    for(i = 0 ; i < data.categories.length-1; i++){
        result.push(parseInt(data.categories[i].value));
        }
    return result;
}


function show_analytics_zone(){

    document.getElementById("row_chart_zone_schools").innerHTML = '<canvas id="chart_zone_schools" width="1000" height="400"></canvas>';
    document.getElementById("row_chart_zone_categories").innerHTML = '<canvas id="chart_zone_categories" width="1000" height="400"></canvas>';

    var options = {};
    var data = {};

     $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
                }
            });

            var pathArray = window.location.pathname.split( '/' );
            var last_element = pathArray[pathArray.length - 1];
            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/ajax/admin/analytics/zone/" + last_element,
                success: function(data) {

                    data_schools_labels = extract_analysis_zone_schools_labels(data);
                    data_schools_data = extract_analysis_zone_schools_count(data);
                    data_categories_labels = extract_analysis_zone_categories_labels(data);
                    data_categories_data = extract_analysis_zone_categories_count(data);

                    data_schools = {
                        labels: data_schools_labels,
                        datasets: [
                            {
                                label: data_schools_labels,
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: data_schools_data
                            }]
                    };

                    data_categories = {
                        labels: data_categories_labels,
                        datasets: [
                            {
                                label: data_categories_labels,
                                fillColor: "rgba(151,187,205,0.5)",
                                strokeColor: "rgba(151,187,205,0.8)",
                                highlightFill: "rgba(151,187,205,0.75)",
                                highlightStroke: "rgba(151,187,205,1)",
                                data: data_categories_data
                            }]
                    };


                    var ctx1 = document.getElementById("chart_zone_schools").getContext("2d");
                    var myBarChart = new Chart(ctx1).Bar(data_schools, options);

                    var ctx2 = document.getElementById("chart_zone_categories").getContext("2d");
                    var myBarChart = new Chart(ctx2).Bar(data_categories, options);

                    },
                     error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
               },
                });

}


function extract_company_request_user_votes(data){

    var result = '[';
    for(i = 0 ; i < data.votes.length-1; i++){
        result += '{"label":"' + data.votes[i].label + '","value":' + data.votes[i].count + ',"color":"' + global_color[i] + '","highlight":"' + global_highlight[i] + '"},';
        }
        if(result != "["){
        result = result.slice(0, -1);
        result += ']';
        }
        else{
        result = "";
        }
    return JSON.parse(result);
}

function show_company_request_vote(){


    var options = {};
    var data = {};

    document.getElementById("row_request_company_vote_chart").innerHTML = '<canvas id="request_company_vote_chart" width="1000" height="400"></canvas>';

   $.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                        xhr.setRequestHeader("X-CSRFToken", csrftoken);
                    }
                }
            });

            var pathArray = window.location.pathname.split( '/' );
            var last_element = pathArray[pathArray.length - 1];
            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/ajax/company/votes/" + last_element,
                success: function(data) {

                    data_votes = extract_company_request_user_votes(data);



    var ctx = document.getElementById("request_company_vote_chart").getContext("2d");
    var myDoughnutChart = new Chart(ctx).Doughnut(data_votes,options);

                    },
                     error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
               },
                });

}

$(document).ready(function(){
$("#id_stats_zone_specific").change(function(){

        window.location='/admin/analytics/stats/zone_specific/' + $(this).val();
    });
});

// END ANALYTICS


// COMMENTAIRE

function set_comment_children(val){
    var text = '';
    text += '<div class="request-comment-children-container hidden-sm hidden-xs">';
    text += '<div class="row">';
    text += '<div class="col-lg-1 col-md-1">';
    text += '<a href="/profil/' + val['user']['identifier'] + '">';

    if (val['user']['avatar'] != '' && val['user']['avatar'] != null){
        text += '<img class="request-owner-picture" src="' + val['user']['avatar'] + '" width="30" height="32">';
    }
    else{
        text += '<img class="request-owner-picture" src="/static/images/user/user.jpg" style="height:30px; width:32px;">';
    }
    text += '</a>';
    text += '</div>';
    text += '<div class="col-lg-10 col-md-10">';
    text += '<div class="row">';
    text += '<a class="request-answer-owner-name" href="/profil/' + val['user']['identifier'] + '">';
    text += '<p>' + val['user']['name'] + ' </p>';
    text += '</a>';
    text += '<p class="request-answer-time"> Le ' + val['created_at'] + '</p>';

    /*
                            {% if comment.edited_at %}
                            <p class="request-answer-time"> - modifié il y a {{comment.edited_at|timesince}}</p>
                            {% endif %}
    */
    text += '</div>';
    text += '<div id="request-answer-comment-{{comment.identifier}}" class="row">';
    text += '<p>' + val['comment'] + '</p>';
    text += '</div>';
    text += '</div>';
    text += '</div>';
    text += '<div class="row">';
    text += '<div class="bottom-answer col-md-offset-1 col-md-2">';
    text += '<p class="txt-answer">Répondre</p>';
    if(val['is_author']){
       text += '<span id="edit_answer_' + val['identifier'] + '" class="glyphicon glyphicon-pencil color-icone edit-answer pointer"  alt="Editer"></span>';
    }

    text += '</div>';
    text += '</div>';
    text += '</div>';


    return text;
}



function set_comment_answer_form(id_comment){

    var text = '';

    text += '<div id="answer-form-' + id_comment + '" class="row">';

    text += '<div class="col-md-1">';
    text += '<img class="request-owner-picture" src="/static/images/user/user.jpg" style="height:30px; width:32px;">';
    text += '</div>'; // end col div

    text += '<div class="col-md-5">';
    text += '<input placeholder="Répondre..." id="comment_' + id_comment + '" class="form-control"</input>';
    text += '</div>'; // end col div

    text += '<div class="col-md-3">';
    // text += '<button class="btn-xs btn-info" onclick=change_price("' + id_comment + '")>Répondre</button> <br>';
    text += '</div>'; // end col div
    text += '</div>'; // end col div

    return text;
}


$(document).ready(function(){
    $(".request-more-comment-children").click(function(){

        var comment_identifier = $(this).attr('id');
        var balise_children = $('#children-' + comment_identifier);
        var balise_new_answer = $('#new-answer-' + comment_identifier);

        if (balise_children.html() == ''){
            $.ajax({
                type: "get",
                dataType: 'json',
                url: "/api/comment/" + comment_identifier + "/children/",
                success: function(data) {
                    var text = '';
                    $.each( data, function( key, val ) {
                        text += set_comment_children(val);
                    })
                    balise_children.html(text);
                    balise_new_answer.html(set_comment_answer_form(comment_identifier));


                },
                error : function(resultat, statut, erreur){
                    console.log("error :" + resultat + " " + statut+ " " + erreur);
                },
            });
        }
        else{
            balise_children.html('');
            balise_new_answer.html('');
        }

    });

});


function save_comment_answer(id_father, value){

    var balise_children = $('#children-' + id_father);

    $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

     $.ajax({
        url:"/api/comment/" + id_father + "/children/",
        dataType : "JSON",
        type : 'POST',
        data: {father_identifier: id_father, comment: value, },
        // Si la requête est correct, on change visuellement le prix du produit
        success : function(data){
        console.log(data);
            text = balise_children.html();
            text += set_comment_children(data);
            balise_children.html(text);
        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
            console.log(jQuery.parseJSON(request.responseText));
        },

    });
}


$( document ).on( "keypress", "input[id^=comment_]", function(e) {
    // If keypress is "enter", save answer
    if(e.which == 13 ) {
        var id_father = $(this).attr('id').replace('comment_', '');
        var value = $(this).val();
        save_comment_answer(id_father, value);
    }
    console.log(e.wich);
});

$( document ).on( "click", "span[id^=edit_answer_]", function(e) {
    // If keypress is "enter", save answer
    var template = '<div class="popover awesome-popover-class"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content popover-content-answer-option"><p></p></div></div></div>';
    var content = '<div>';
    content += '<ul class="ul-popover">';
    content += '<li class="li-popover">';
    content += '<p class="p-popover">Editer...</p>';
    content += '</li>';

    content += '<li class="li-popover">';
    content += '<p class="p-popover">Supprimer...</p>';
    content += '</li>';

    content += '</ul>';
    content += '</div>';


    $(this).popover({title: "",
                     html: true,
                     content: content,
                     placement: 'bottom',
                     template: template,
                     });
    $(this).popover('show');
});


// END COMMENTAIRE


// SIGN UP ASSOCIATION

function blabla(){




}


function create_association_validated(data, step, current_div){

     $.ajaxSetup({
        beforeSend: function(xhr, settings) {
            if (!csrfSafeMethod(settings.type) && !this.crossDomain) {
                xhr.setRequestHeader("X-CSRFToken", csrftoken);
            }
        }
    });

     $.ajax({
        url:"/api/association/create/step/" + step + "/",
        dataType : "JSON",
        type : 'POST',
        data: data,
        // Si la requête est correct, on change visuellement le prix du produit
        success : function(data){
            $.each( data, function( key, val ) {
                $('#id_' + key).removeClass('input-has-error');
            });
      var curStep = current_div.closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

          nextStepWizard.removeAttr('disabled').trigger('click');
        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
             $.each( data, function( key, val ) {
                $('#id_' + key).removeClass('input-has-error');
             });
            $.each( request.responseJSON, function( key, val ) {
                $('#id_' + key).addClass('input-has-error');
            });
            return false;
        },

    });

}

$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-styx').addClass('btn-default');
          $item.addClass('btn-styx');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){

        var step = $(this).attr('step');
        var data = '';

        switch(step){
            case '1':
                data = {name: $("#id_name").val(),
                        avatar: $('#id_avatar').val(),
                        email: $('#id_email').val(),
                        mobile: $('#id_mobile').val(),
                        password: $('#id_password').val(),
                        password2: $('#id_password2').val(),
                        };
                create_association_validated(data, step, $(this));
                break;

            case '2':
                var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='url']"),
                isValid = true;

                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                  if (!curInputs[i].validity.valid){
                      isValid = false;
                      $(curInputs[i]).closest(".form-group").addClass("has-error");
                  }
                }
                if (isValid){
                    nextStepWizard.removeAttr('disabled').trigger('click');
                }
                break;

            default:
                break;
                }





  });

  $('div.setup-panel div a.btn-styx').trigger('click');
});


// END SIGN UP ASSOCIATION