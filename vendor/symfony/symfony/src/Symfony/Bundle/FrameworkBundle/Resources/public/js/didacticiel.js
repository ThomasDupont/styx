    var nextStep;
var clearStep;
var workflow = {};

/**
* ETAPES DIDACTICIEL
*/
registerStep("0", function (){
    $("#tutoFeedRequest").modal('show');
    $(function() {
        $('#tutoFeedRequest').click(function() {
            next(null);
            $("#tutoFeedRequest").modal('hide');
        });
    });
    });

registerStep("1", function (){
    $("#tutoPersonalInfo").modal('show');
    $(function() {
        $('#tutoPersonalInfo').submit(function() {
            next(null);
            return true; // return false to cancel form action
        });
    });
});

registerStep("2", function (){
 $("#tutoCategoryHobbies").modal('show');
 $(function() {
        $('#tutoCategoryHobbies').submit(function() {
            next(null);
            return true; // return false to cancel form action
        });
    });
});

registerStep("3", function (){
 $("#tutoPoint").modal('show');
 $(function() {
        $('#tutoPoint').click(function() {
            next(null);
             $("#tutoPoint").modal('hide'); // return false to cancel form action
        });
    });
});


/*

registerStep("3", function (){
    registerHighlight("#notif_click");
    setText("Vous pourrez trouver ici vos notifications récentes.", ".news-feed-requests-filter", "before", false, null);
});

registerStep("4", function (){
    registerHighlight(".news-feed-new-request > .btn");
    setText("Vous pourrez trouver ici vos notifications récentes. Cliquez dessus !", ".news-feed-new-request", "before", true, null);
    $(".news-feed-new-request > .btn").on('click', function(){next(null);}); // ici on passe au suivant quand on click sur l'élément ".news-feed-new-request > .btn"
});

registerStep("5", function (){
    registerHighlight(".news-feed-request-form");
    setText("Ceci est le formulaire pour faire une nouvelle demande. Remplissez le avec attention, plus vous etes précis plus les utilisateurs réponderont à votre demande !", 
        ".news-feed-request-form", 
        "before", 
        false,
        "/profil");
});
*/


/**
* FIN ETAPES DIDACTICIEL
*/


/**
* Ci dessous les fonctions utilitaires, ne toucher que si vous savez ce que vous faites =)
*/
function processDidacticiel(){
    var step = gcookie('didacticiel');
    if(step == ""){
        scookie('didacticiel', "0", 365);
        step = "0";
    }
    console.log(step);
    if(step in workflow)
        workflow[step]();
    else{
        console.log("out");
        scookie('didacticiel', 0, -5);
        $.ajax({url:'/endTuto'});
    }
}

function scookie(name,value,days)
{
    var expire=new Date();
    expire.setDate(expire.getDate()+days);
    document.cookie=name+'='+escape(value)+';expires='+expire.toGMTString();
    return true;
}
function gcookie(name)
{
    if(document.cookie.length>0)
    {
        start=document.cookie.indexOf(name+"=");
        pos = start+name.length+1;
        if(start!=0){
            start=document.cookie.indexOf("; "+name+"=");
            pos = start+name.length+3;
        }
        if(start!=-1){
            start=pos;
            end=document.cookie.indexOf(";",start);
            if(end==-1){
                end=document.cookie.length;
            }
            return unescape(document.cookie.substring(start,end));
        }
    }
    return '';
}

function registerHighlight(path){
    $(path).addClass("highlight");
    $('html, body').animate({
        scrollTop: $(path).offset().top - 90
    }, 1000);
    clearStep = function(){
        $(path).removeClass('highlight');
    };
}

function registerStep(key, func){
    workflow[key] = func;
}

function next(url){
    $('#didacticielBox').remove();
    console.log(gcookie('didacticiel'));
    scookie('didacticiel', parseInt(gcookie('didacticiel'))+1, 365);
    //clearStep();
    if(url != null){
       window.location = url; 
    }
    processDidacticiel();
}

function setText(text, element, position, hideClose, url){
    var text_box = "<div id='didacticielBox' style='text-align:center'>"+text+"";
    if(!hideClose){
        if(url == null)
            text_box +=  " <span class='btn btn-success btn-sm' onclick='next(null);'>Suivant</span>";
        else
            text_box +=  " <span class='btn btn-success btn-sm' onclick='next(\""+url+"\");'>Suivant</span>";
        console.log(url);
    }
        
    text_box+="</div>";
    if(position == "after"){
        $(element).append(text_box);
    }else{
        $(text_box).insertBefore(element)
    }
}

$(function(){
    processDidacticiel();
});

