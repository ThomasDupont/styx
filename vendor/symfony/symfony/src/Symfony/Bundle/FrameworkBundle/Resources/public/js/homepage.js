/* Select */

function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=0'
}


$(document).ready(function () {

    $("select").on("click" , function() {
        $(this).parent(".select-box").toggleClass("open");
    });

    $(document).mouseup(function (e)
    {
        var container = $(".select-box");
        if (container.has(e.target).length === 0)
        {
            container.removeClass("open");
        }
    });

    var selection = $("select").find("option:selected").text(),
        labelFor = $("select").attr("id"),
        label = $("[for='" + labelFor + "']");
    label.find(".label-desc").html(selection);


    $("select").on("change" , function() {
        var selection = $(this).find("option:selected").text(),
            labelFor = $(this).attr("id"),
            label = $("[for='" + labelFor + "']");
        label.find(".label-desc").html(selection);
    });

    /* Popup */

    $(".l_connexion").on("click", function () {
        $(".o_inscription").css({"color":"#555"});
        $(".o_connexion").css({"color":"#e7712b"});
        $(".zoom_connexion_inscription").css({'display':'block'});
        $(".zoom_block").css({"height":"346px","top":"calc(50% - 173px)"});
        $(".connexion").css({"display":"block"});
        $(".inscription").css({"display":"none"});
    });
    $(".o_connexion").on("click", function () {
        $(this).css({"color":"#e7712b"});
        $(".o_inscription").css({"color":"#555"});
        $(".zoom_connexion_inscription").css({'display':'block'});
        $(".zoom_block").css({"height":"346px","top":"calc(50% - 173px)"});
        $(".connexion").css({"display":"block"});
        $(".inscription").css({"display":"none"});
    });
    $(".l_inscription").on("click", function () {
        $(".o_inscription").css({"color":"#e7712b"});
        $(".o_connexion").css({"color":"#555"});
        $(".connexion").css({"display":"none"});
        $(".zoom_connexion_inscription").css({'display':'block'});
        $(".inscription").css({"display":"block"});
        $(".zoom_block").css({"height":"416px","top":"calc(50% - 208px)"});
    });
    $(".o_inscription").on("click", function () {
        $(this).css({"color":"#e7712b"});
        $(".o_connexion").css({"color":"#555"});
        $(".connexion").css({"display":"none"});
        $(".zoom_connexion_inscription").css({'display':'block'});
        $(".inscription").css({"display":"block"});
        $(".zoom_block").css({"height":"416px","top":"calc(50% - 208px)"});
    });

    $(".effet_zoom").on("click", function () {
       $(".zoom_connexion_inscription").css({"display":"none"});
    });

    var pContainerHeight = $('.bird-box').height();

    $(window).scroll(function(){

    var wScroll = $(this).scrollTop();

    if (wScroll <= pContainerHeight) {

    $('.logo').css({
        'transform' : 'translate(0px, '+ wScroll /2 +'%)'
    });

    $('.back-bird').css({
        'transform' : 'translate(0px, '+ wScroll /4 +'%)'
    });

    $('.fore-bird').css({
        'transform' : 'translate(0px, -'+ wScroll /40 +'%)'
    });

    }

    });

    <!-- Parallax -->
    var ypos,image;
	function parallex() {
		image = document.getElementById('image');
		ypos = window.pageYOffset;
		image.style.top = ypos * .3+ 'px';
	}
	window.addEventListener('scroll', parallex),false;

    $(function(){
        $(window).scroll(function(){
        var winTop = $(window).scrollTop();
            if(winTop >= 450){
                $('#header').css('opacity','0.95');
                $('.buttons_top ').css('top','12px');
                $('.l_connexion').css('border','1px solid #e7712b');
                $('.l_connexion').css('color','#e7712b');
                $('#logo').css('top','4px');
                $('#slogan').css('top','14px');
                $('#slogan').css('color','#9a9a9a');
            }
            if(winTop <= 450){
                $('#header').css('opacity','0');
                $('.buttons_top ').css('top','20px');
                $('.l_connexion').css('border','1px solid #FFF');
                $('.l_connexion').css('color','#FFF');
                $('#logo').css('top','12px');
                $('#slogan').css('top','23px');
                $('#slogan').css('color','#FFF');
            }
            if(winTop >= 300){
                $('#presentation').css('opacity','0');
            }
            if(winTop <= 300){
                $('#presentation').css('opacity','1');
            }
        });
    });

    $('.facebook-login').click(function(){
        $('#facebook-login')[0].click();
    });

    $('.facebook-sign-up').click(function(){
        $('#facebook-sign-up')[0].click();
    });



    $(document).on("click", ".inscription .pt1 .valid", function () {

        if ($('#select-box1').val() == "0"){
            $('.select-box1').css('background-color', '#D8A5A5');
        }
        else if($('#select-box2').val() == "0") {
            $('.select-box1').css('background-color', '#e8e8e8');
            $('.select-box2').css('background-color', '#D8A5A5');

        }
        else if(!$('#id_school').val()){
            $('.select-box1').css('background-color', '#e8e8e8');
            $('.select-box2').css('background-color', '#e8e8e8');
            $('#id_school').css('background-color', '#D8A5A5');
        }
        else{
            $('.select-box1').css('background-color', '#e8e8e8');
            $('.select-box2').css('background-color', '#e8e8e8');
            $('#id_school').css('background-color', '#e8e8e8');

            $('.inscription .pt1').css('display', 'none');
            $('.inscription .pt2').css('display', 'block');

            if($('#select-box2').val()){

            }

            if ($('#select-box2').val() != null){
                document.cookie = "id_city=" + $('#select-box2').val() + ";path=/";
            }
            else{
                eraseCookie('id_city');
            }

            if ( ($('#select-box2 option:selected').text() != null) && ($('#select-box2 option:selected').text() != '')){
                document.cookie = "name_city=" + encodeURIComponent($('#select-box2 option:selected').text()) + ";path=/";
            }
            else{
                eraseCookie('name_city');
            }

            if (id_school_selected != null){
                document.cookie = "id_school=" + id_school_selected + ";path=/";
            }
            else{
                eraseCookie('id_school');
            }

            if ($('#id_school').val() != null){
                document.cookie = "name_school=" + encodeURIComponent($('#id_school').val()) + ";path=/";
            }
            else{
                eraseCookie('name_school');
            }

            if ($('#select-box1').val() != null){
                document.cookie = "department=" + $('#select-box1').val() + ";path=/";
            }
            else{
                eraseCookie('department');
            }

        }

    });

        $(document).on("click", ".connexion .valid", function () {
        document.cookie = "email=" + encodeURIComponent($('#id_email').val()) + ";path=/";

    });


    $(document).on("click", ".inscription .pt2 .retour", function () {
        $('.inscription .pt2').css('display', 'none');
        $('.inscription .pt1').css('display', 'block');
    });

    $(document).on("focusout", "input#id_email", function () {
        var mail = $(this).val().toLowerCase();
        $(this).val(mail);
    });






});