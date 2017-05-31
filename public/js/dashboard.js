/* Nested accordion */
$('.nested-accordion').find('.branch').hide().slideUp();
$('.nested-accordion').find('.courseRow').click(function(){
	$(this).next('.branch').slideToggle(100);
	$(this).find('p').toggleClass('selected');
});


/* Sidebar, Navbar toggle */
$(".sidebar-toggle").bind("click", function (e) {
  $("#sidebar").toggleClass("active");
  $(".app-container").toggleClass("__sidebar");
});

$(".navbar-toggle").bind("click", function (e) {
  $("#navbar").toggleClass("active");
  $(".app-container").toggleClass("__navbar");
});


/* Floating button toggle */
$(document).click(function (event) {
  if (!$(event.target).closest('.btn-floating').length) {
    if ($('.btn-floating .toggle-content').is(":visible")) {
      $('.btn-floating').toggleClass("active");
    }
  }
});

$('[data-toggle="toggle"]').bind("click", function () {
  var elm = $(this);
  var target = elm.attr("data-target");
  var targetElm = $(target);

  targetElm.toggleClass("active");
});

//accordion for course panels
$('.course-accordion').find('.accordion-section').hide().slideUp();
$('.course-accordion').find('.titleRow').click(function(){
  $(this).next('.accordion-section').slideToggle(100);
  $(this).find('p').toggleClass('selected');
});