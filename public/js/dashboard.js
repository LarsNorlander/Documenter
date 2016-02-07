$("select").select2({dropdownCssClass: 'dropdown-inverse'});

$(".file-item-even").click(function () {
    var id = $(this).attr("id");
    $(".file-selected").toggleClass("file-selected");
    $(this).toggleClass("file-selected");
    if ($(this).find(".file-owner").text() != "Me") {
        $("#documentOptions").hide(0);
    }
    else {
        $("#documentOptions").show(0);
    }
    $("#fileSharingForm").attr("action", "/file/sharing/" + $(this).attr("id"));
    $("#fileDelForm").attr("action", "/file/del/" + $(this).attr("id"));
    $("#fileUpdateForm").attr("action", "/file/update/" + $(this).attr("id"));
    $.ajax({
        type: 'get',
        url: 'sidebar/version/' + id,
        dataType: "html",
        success: function (data) {
            $('#versionCard').html(data);
        }
    });
    $.ajax({
        type: 'get',
        url: 'sidebar/sharing/' + id,
        dataType: "html",
        success: function (data) {
            $('#sharingCard').html(data);
        }
    });
    $.getJSON("/file/details/" + $(this).attr("id"), function (data) {
        $("#activeVer").text(data[0].public_version);
        $("#totalVer").text(data[0].total_versions);
        $("#infoFileName").text(data[0].filename);
        $("#no-content").hide(0);
    });
}).dblclick(function () {
    window.open("/file/" + $(this).attr("id"));
});

$(document).on('click', '.del-ver',(function () {
    $("#fileDelForm").attr("action", "/file/del/" + $(this).attr("id"));
    $("#delFile").modal("show");
}));

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

// Section for sidebare