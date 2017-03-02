/* Select /

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

$("select").on("change" , function() {
  var selection = $(this).find("option:selected").text(),
      labelFor = $(this).attr("id"),
      label = $("[for='" + labelFor + "']");
  label.find(".label-desc").html(selection);
});

/* Ne plus suivre */

$(".deja_follow").on('mouseover', function () {
	$(this).children('span').text("Ne plus suivre")
});
$(".deja_follow").on('mouseout', function () {
	$(this).children('span').text("Suivi")
});

/* Calendar */

$( document ).ready(function(){
    $(function() {
    $( "#datepicker" ).datepicker();
  });
});

function wait(ms){
   var start = new Date().getTime();
   var end = start;
   while(end < start + ms) {
     end = new Date().getTime();
  }
}

var loader_svg = '<div class="spinner"> <div class="rect1"></div> <div class="rect2"></div> <div class="rect3"></div> <div class="rect4"></div> <div class="rect5"></div></div>';