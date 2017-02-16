

function init(){
  // On adapte les tab des types suivant leurs nombre.
  var posts_type = $("li.new_post_head")
  posts_type.css({"width": "calc(" + 98/posts_type.length + "% - 2px"});

  // On colorie la première tab.
  $("li.new_post_head:first").css({"color":"#E67830"});
  $("li.new_post_head:first").click();
  // On met des bordures, sauf pour la dernière tab.
  $("li.new_post_head:not(:last-child)").each(function(){
    $(this).css({"border-right": "1px solid #CCC"});
  });
}

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
      var id_selected = $('#type_' + id_type + ' > .select-box.categories > #id_category').val();
      console.log(id_selected);
      select.empty();
      $('.label-desc').text('Catégories');
      select.append("<option value='0'> ------------ </option>")

      $.each( data, function(key_categories, category){
        select.append("<option value='" + category['id'] + "'> " + category['nameCategory'] + " </option>");
      });
      if(id_selected){
        select.val(id_selected);
      }

      /* $('.label-desc').text($(this).find('option:selected').text());*/
    },
  });
}

function change_styxers(){

  var suggestions = '<div class="suggestions"><a href="/profil/"><img class="pp" src="/bundles/framework/images/user/user.jpg"><span class="pseudo">' + loader_svg + '</span></a></div>';
  suggestions += suggestions;
  suggestions += suggestions;
  $(".derniers_styxers").html(suggestions);


  suggestions = '';
  $.ajax({
    url: "api/students/random",
    dataType : "JSON",
    type : 'GET',
    // Si la requête est correct, on change visuellement le prix du produit
    success : function(data){

      $.each( data, function(key, user){

        suggestions += '<div class="suggestions">';
        suggestions += '<a href="/profil/' + user['identifier'] + '">';
        if (user['avatar']){
          suggestions += '<img class="pp" src="' + user['avatar'] + '">';
        }
        else{
          suggestions += '<img class="pp" src="/bundles/framework/images/user/user.jpg">';
        }

        suggestions += '<span class="pseudo">' + user['styxuserstudent']['firstname'] + ' ' + user['name'] + '</span>';
        suggestions += '</a></div>';
      });
      $(".suggestions").remove();
      $(".derniers_styxers").html(suggestions);

    },
    // Si la requête est incorrect, on affiche le message du problème
    error : function(request, status, error){
      console.log(jQuery.parseJSON(request.responseText));
    },

  });

}


$(document).ready(function(){
  $("li.new_post_head").on("click", function () {
    $("li.new_post_head").css({"color":"#555"});
    $(this).css({"color":"#E67830"});
  });

  $("#city_name").change(function(){
    window.location='/feed?filter=2&zone=' + $(this).val();
  });

  $('.select-box.categories > .select').change(function(){
    $('.label-desc').text($(this).find('option:selected').text());
  });

  init();

  $(document).on("mouseenter", ".nb_styxers", function () {
    change_styxers();
  });

  var datefield=document.createElement("input")
  datefield.setAttribute("type", "date")
  if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
  console.log('hey');
  jQuery(function($){ //on document.ready


    $('#id_date').datepicker({
      dateFormat: 'yy-mm-dd',
      dayNames:[ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
      dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
      firstDay:1,
      maxDate:'1998/01/01',
    });
  });
}


});

var next_post_p = '';

function update_post(idZone){
  var url = null ;

  if(next_post_p == ''){
    url = '/api/post/scroll/'+idZone;
  }
  else {
    url = next_post_p;
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
        next_post_p = data['next'];
        html = '';
        tableau = [];
        $.each( data['results'], function(key, post){


          html +='<div class="actus">'
          html +='<div class="pt1" id="'+post['identifier']+'">'
          if (post['category']['image']){
            html +='<img class="category" src="'+ post['category']['image'] +'" width="100" height="100">'
          }else{
            html +='<img class="category" src="/bundles/framework/images/user/user.jpg">'
          }


          html +='<span class="titre">'+post['title']+'</span>'
          for(reward in post['get_reward']){
            html +='<img class="reward" src="/media/'+reward.image+'">'
          }

          html +='<span class="date_responsive">'+post['created_at']+'</span>'

          html +='<span class="text">'
          html += post['description'].substring(0, 200)
          html +='</span>'
          html +='</div>'
          html +='<div class="pt2">'
          html +='<div class="left">'
          html +='<div class="coms action">'
          html +='<img src="/bundles/framework/images/icons/coms.png">'
          html +='<span class="cpt">'+post['count_comment']+'</span>'
          html +='</div>'
          html +='<div class="vues action">'
          html +='<img src="/bundles/framework/images/icons/vues.png">'
          html +='<span class="cpt">'+post['post_interest']+'</span>'
          html +='</div>'
          if(post['comment']){
            html +='<div class="partages action">'
            html +='<img src="/bundles/framework/images/icons/partages.png">'
            html +='<span class="cpt">12</span>'
            html +='</div>'

          }
          html +='</div>'
          html +='<div class="right">'
          html +='<a href="/profil/'+post['owner']['identifier']+'">'
          if(post['owner']['avatar']){
            html +='<img class="category img'+post['owner']['identifier']+'" src="'+post['category']['image']+'" width="'+post['category']['image']['width']+'" height="'+post['category']['image']['height']+'">'
          }else{
            html +='<img class="pp img'+post['owner']['identifier']+'" src="/bundles/framework/images/user/user.jpg">'
          }
          html +='<span class="pseudo ' +post['owner']['identifier']+'"></span>'
          html +='</a>'
          var date1 = new Date(post['created_at']);
          var options = {weekday: "short", year: "numeric", month: "short", day: "numeric"};
          var date = date1.toLocaleDateString("fr-FR", options);
          html +='<span class="date_post">'+date+'</span>'
          html +='</div>'

          html +='</div>'
          html +='</div>'

          html +='<div class="clearfix"></div>'

          tableau.push(post['owner']['identifier']);

        });
        $('.blocks.postlist').append(html);
        $.each( tableau, function(key, id){
          getStyxUserBaseInfo(id);
        }
      );




    },
    error : function(resultat, statut, erreur){
      console.log("error :" + resultat + " " + statut+ " " + erreur);
    }
  });
}
}

function getStyxUserBaseInfo(identifier){
  $.ajax({
    type: "GET",
    url: "api/students/"+identifier,
    dataType: "JSON",
    success: function(data) {
      console.log(data['styxuserstudent']['firstname']);
      console.log(data['avatar']);
      console.log($.trim($('span.'+identifier).text()));
      if($.trim($('span.'+identifier).text())==""){
        $('span.'+identifier).append(data['styxuserstudent']['firstname']+' '+data['name']);

        var elems = document.getElementsByClassName("img"+identifier);
        for (var i = 0; i < elems.length; i+= 1) {
          elems[i].src = data['avatar'];
        }

      }else{
        $('span.'+identifier).empty();
        $('span.'+identifier).append(data['styxuserstudent']['firstname']+' '+data['name']);

        var elems = document.getElementsByClassName("img"+identifier);
        for (var i = 0; i < elems.length; i+= 1) {
          elems[i].src = data['avatar'];
        }
      }


    }
  });

}
