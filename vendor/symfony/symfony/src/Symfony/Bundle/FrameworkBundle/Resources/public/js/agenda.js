var monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin",
  "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"
];

function update_categories(id_type){

    /* On affiche la form correspondant au type de Post */
    var i;
    var x = document.getElementsByClassName("new_post_form");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById('type_' + id_type).style.display = "block";

    /* On remplit le select des catégories suivant le type */
    $.ajax({
        url:'/api/type/'+ id_type + '/categories/',
        dataType : "JSON",
        type: 'GET',
        success : function(data){
            var select = $('#type_' + id_type + ' > .select-box.categories > #id_category');
            select.empty();
            $('.label-desc').text('Catégories');
            select.append("<option value='0'> ------------ </option>")

            $.each( data, function(key_categories, category){
                    select.append("<option value='" + category['id'] + "'> " + category['nameCategory'] + " </option>")
            });

        },
    });
}

function new_year(year){
    html = '<div class="blocks annee">';
    html += '<h2>Évènements de '+ year +'</h2>';
    return html;
}


function new_month(month){
    html = '<h3>' + monthNames[month].toUpperCase() + '</h3>';
    return html;
}
// test de commit
function html_event(event){
    var date_event = new Date(event['date']);
    var date_created = new Date(event['created_at']);

    html = '<div class="actus">';
    html += '<div class="pt1" id="' + event['identifier'] + '">';
    html += '<img class="category" src="' + event['avatar'] + '">';
    html += '<span class="titre">' + event['title'] + '</span>';
    html += '<span class="text">';
    html += event['description'];
    html += '</span>';
    html += '<span class="date">' + date_event.getDate() + ' ' + monthNames[date_event.getMonth()] + '</span>';
    html += '</div>';
    html += '<div class="pt2">';
    html += '<div class="left">';
    html += '<div class="coms action">';
    html += '<img src="/bundles/framework/images/icons/coms.png">';
    html += '<span class="cpt">' + event['count_comment'] + '</span>';
    html += '</div>';
    html += '<div class="vues action">';
    html += '<img src="/bundles/framework/images/icons/vues.png">';
    html += '<span class="cpt">' + event['post_interest'] + '</span>';
    html += '</div>';
    html += '<div class="partages action">';
    html += '<img src="/bundles/framework/images/icons/partages.png">';
    html += '<span class="cpt">0</span>';
    html += '</div>';
    html += '</div>';
    html += '<div class="right">';
    if (event['owner']['avatar']){
        html += '<img class="pp" src="' + event['owner']['avatar'] + '">';
    }
    else{
        html += '<img class="pp" src="/bundles/framework/images/user/user.jpg">';
    }

    html += '<span class="pseudo">' + event['owner']['name'] + '</span>';
    html += '<span class="date_post">Posté le ' + date_created.getDate() + ' ' + monthNames[date_created.getMonth() ] + ' ' + date_created.getFullYear() + '</span>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    return html;
}

function get_event(id_zone){

    var year = '1960';
    var month = '0';

    $('.blocks.annee').remove();

     $.ajax({
        type: "GET",
        url: "/api/events/zone/" + id_zone,
        dataType: "JSON",
        success: function(data) {
            if (data != []){
                var html = '';
                $.each( data, function(key, event){
                    var date_event = new Date(event['date']);

                    // On regarde si c'est une nouvelle année
                    if(date_event.getFullYear() != year){
                        // Si ce n'est pas la première année, on ferme la balise de la div de l'année précédente
                        if(year != '1960'){
                            html += '</div>';
                        }
                        year = date_event.getFullYear();
                        html += new_year(year);
                        month = '';
                    }

                    // On regarde si c'est un nouveau mois
                    if (date_event.getMonth() != month){
                        month = date_event.getMonth();
                        html += new_month(month);
                    }

                    html += html_event(event);

                });
                // On ferme la balise de la dernière année.
                html += '</div>';
                $('.event').html(html);
            }

        },
                error : function(resultat, statut, erreur){
                console.log("error :" + resultat + " " + statut+ " " + erreur);
            }
         });
}


$(document).ready(function(){

    $("#select-box1").change(function(){
            window.location='/agenda?zone=' + $(this).val();
    });

    $('.select-box.categories > .select').change(function(){
        $('.label-desc').text($(this).find('option:selected').text());
    });
});
