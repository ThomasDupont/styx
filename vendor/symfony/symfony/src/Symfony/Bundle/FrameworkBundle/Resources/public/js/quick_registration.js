
$(document).ready(function(){

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

    $(document).on("click", ".valid.suite", function () {
        $(".form1").css({"display":"none"});
        $(".c_inscription").css({"top":"0"});
        $(".l1").css({"display":"none"});
        $(".form2").css({"display":"block"});

        document.cookie = "name_city=" + encodeURIComponent($('#id_city').val()) + ";path=/";
        document.cookie = "id_school=" + id_school_selected + ";path=/";
        document.cookie = "name_school=" + encodeURIComponent($('#id_school').val()) + ";path=/";
        document.cookie = "id_city=" + id_city_selected + ";path=/";
        document.cookie = "department=" + $('#select-box1').val() + ";path=/";

    });


    $('.facebook').click(function(){
    $('#facebook')[0].click();
    });

    $(document).on("focusout", "#id_email", function () {
        var mail = $(this).val().toLowerCase();
        $(this).val(mail);
    });
});