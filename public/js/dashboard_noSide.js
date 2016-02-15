$("select").select2({dropdownCssClass: 'dropdown-inverse'});

$(".file-list").css("width", $(window).width() - 200 + "px");

$("#logOut").click(function () {
    event.preventDefault();
    window.open("/logout", "_self");
});

$(window).resize(function () {
    $(".file-list").css("width", $(window).width() - 200 + "px");
});
