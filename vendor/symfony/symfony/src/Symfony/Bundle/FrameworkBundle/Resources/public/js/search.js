
function update_following( follow_div, status){


    var id_user = follow_div.attr('id_user');
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
            console.log(data['status']);
            if (data['status'] == 'removed'){
                follow_div.removeClass('deja_follow');
                follow_div.children('p').text('Suivre');
                follow_div.children('img').attr('src', '/bundles/framework/images/icons/follow.png');
            }
            else{
               follow_div.addClass('deja_follow')
               follow_div.children('p').text('Suivi');
               follow_div.children('img').attr('src', '/bundles/framework/images/icons/check.png');
            }
        },
        // Si la requête est incorrect, on affiche le message du problème
        error : function(request, status, error){
            console.log(jQuery.parseJSON(request.responseText));
        },
    });
}

$(document).ready(function(){
    $(document).on("click", ".deja_follow", function () {
        update_following($(this), 'unfollow');
    });

    $(document).on("click", ".pt2>[class=follow]", function () {
        update_following($(this), 'follow');
    });

    $(document).on("mouseover", ".deja_follow", function () {
        $(this).children('p').text("Ne plus suivre");
        $(this).children('img').attr('src', '/bundles/framework/images/icons/follow.png');
    });

    $(document).on("mouseout", ".deja_follow", function () {
        $(this).children('p').text("Suivi");
        $(this).children('img').attr('src', '/bundles/framework/images/icons/check.png');
    });
});
