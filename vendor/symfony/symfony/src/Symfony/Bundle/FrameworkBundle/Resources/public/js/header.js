var monthName = ["Jan", "Fév", "Mars", "Avr", "Mai", "Juin", "Juil", "Aout", "Sept", "Oct", "Nov", "Déc"];
var TIME_MAJ_ACTIVE = 5000; // on met à jour toute les 5 secondes quand la page est active
var TIME_MAJ_NOACTIVE = 30000; // on met à jour toute les 30 secondes quand la page est inactive
var TIME_MAJ = TIME_MAJ_ACTIVE;
var ID_MAJ= setTimeout(get_notification_count, TIME_MAJ);
var IS_ACTIVE = true;


window.onfocus = function () {
  IS_ACTIVE = true;
  TIME_MAJ = TIME_MAJ_ACTIVE; //
  clearInterval(ID_MAJ);
  ID_MAJ = setTimeout(get_notification_count, TIME_MAJ);
};

window.onblur = function () {
  IS_ACTIVE = false;
  TIME_MAJ = TIME_MAJ_ACTIVE; //
  clearInterval(ID_MAJ);
  ID_MAJ = setTimeout(get_notification_count, TIME_MAJ);
};


function get_notification_count(){

    var url = "/api/notification/unsaw/";

    $.ajax({
        type: "GET",
        url: url,
        dataType: "JSON",
        success: function(data) {
            console.log(data['notif_count']);
            if (data['notif_count'] != 0){
                $('.l_notif.icons_header.no_r_header').addClass('new_notif');
            }
        }
    });
}

$(document).ready(function () {


    // Menu Responsive

    $(".l_menu").on("click", function () {
        $(".x_menu").css({"display":"block"});
        $(".recherche2").css({"display":"block"});
        $(".c_header_responsive").css({"display":"block"});
        $(this).css({"display":"none"});
        $("header").css({"height":"106px"});
        $(".logo").css({"display":"none"});
        $(".container").css({"margin-top":"130px"});
    });

    $(".x_menu").on("click", function () {
        $(".l_menu").css({"display":"block"});
        $(".recherche2").css({"display":"none"});
        $(".c_header_responsive").css({"display":"none"});
        $(this).css({"display":"none"});
        $("header").css({"height":"55px"});
        $(".logo").css({"display":"block"});
        $(".container").css({"margin-top":"100px"});
    });


    // Autres reglages

    larg = window.innerWidth;

    if(larg > 640) {
        $(".l_menu").css({"display":"none"});
        $(".x_menu").css({"display":"none"});
        $(".recherche2").css({"display":"none"});
        $(".c_header_responsive").css({"display":"none"});
        $("x_menu").css({"display":"none"});
        $("header").css({"height":"55px"});
        $(".logo").css({"display":"block"});
        $(".container").css({"margin-top":"100px"});
    }
    else {
       $(".l_menu").css({"display":"block"});
    }

    $(window).resize(function(){
        larg = window.innerWidth;
            if(larg > 640) {
                $(".l_menu").css({"display":"none"});
                $(".x_menu").css({"display":"none"});
                $(".recherche2").css({"display":"none"});
                $(".c_header_responsive").css({"display":"none"});
                $("x_menu").css({"display":"none"});
                $("header").css({"height":"55px"});
                $(".logo").css({"display":"block"});
                $(".container").css({"margin-top":"100px"});
            }
            else {
               $(".l_menu").css({"display":"block"});
            }
    });

    $('#header_notif').on("click", function () {
        if ($('#notif_dropdown').css('display') === "none"){
            $('#notif_dropdown').css({'display':'block'});
            get_notification();
        }
        else{
        $('#notif_dropdown').css({'display':'none'});
        }
    });


    function get_notification(){

        var url = "/api/notification/";
        var name, avatar = '';
        $.ajax({
            type: "GET",
            url: url,
            dataType: "JSON",
            success: function(data) {
                $('.notif_resume').remove();
                var notif_resume_html = '<a href="" identifier="" class="notif_resume"><img class="pp" src="" width="48" height="48"><p></p><p></p><div></div></div>';
                $.each( data, function(key, notif){
                    name, avatar = "";
                    $('#notif_dropdown').html($('#notif_dropdown').html() + notif_resume_html);
                    notif_resume = $('#notif_dropdown .notif_resume').last();
                    notif_resume.attr('href', notif['data']['data']['link']);
                    if(notif['unread']){
                        notif_resume.addClass('unread');
                    }
                    if(notif['description']){
                        notif_resume.attr('identifier', notif['description']);
                    }
                    if(notif['actor']['avatar']){
                        avatar = notif['actor']['avatar'];
                    }
                    else{
                        avatar = '/bundles/framework/images/user/user.jpg';
                    }
                    notif_resume.children('img').attr('src', avatar);
                    if(notif['actor']['styxuserstudent']['firstname']){
                        name = notif['actor']['styxuserstudent']['firstname'] + " "
                    }
                    name += notif['actor']['name']
                    notif_resume.children('p').first().text( name + ' ' + notif['verb']);
                    notif_resume.children('p').last().text(notif['data']['data']['text']);
                    var d = new Date(notif['timestamp']);
                    var created_at = d.getDate() + ' ' + monthName[d.getMonth()] + ' à ' + d.getHours() + ':' + d.getMinutes();
                    notif_resume.children('div').text(created_at);
                });
                $('.l_notif.icons_header.no_r_header').removeClass('new_notif');

            },
             error : function(resultat, statut, erreur){
                    console.log("error :" + resultat + " " + statut+ " " + erreur);
                }
        });
    }


    $(document).on("click", "a.unread", function () {
        var link = $(this);
        if($(this).attr('identifier')){
        $.ajax({
            type: "GET",
            url: '/api/notification/' + $(this).attr('identifier') + '/read',
            dataType: "JSON",
            success: function(data) {

            }
            });

        }
        location.href = this.getAttribute('href');

        return false;
    });

    // Notification check after page load
    get_notification_count();
});