$("select").select2({dropdownCssClass: 'dropdown-inverse'});

$(".file-item-even").click(function () {
    $(".file-selected").toggleClass("file-selected");
    $(this).toggleClass("file-selected");
    if ($(this).find(".file-owner").text() != "Me") {
        $("#documentOptions").hide(0);
    }
    else {
        $("#documentOptions").show(0);
    }
    $.getJSON("/file/details/" + $(this).attr("id"), function (data) {
        $("#activeVer").text(data[0].public_version);
        $("#totalVer").text(data[0].total_versions);
        $("#infoFileName").text(data[0].filename);
        $("#no-content").hide(0);
    });
});

$(".file-list").css("width", $(window).width() - 500 + "px");

$("#logOut").click(function () {
    event.preventDefault();
    window.open("/logout", "_self");
});


$(window).resize(function () {
    $(".file-list").css("width", $(window).width() - 500 + "px");
});

Dropzone.options.myAwesomeDropzone = {
    acceptedFiles: "application/pdf"
};
