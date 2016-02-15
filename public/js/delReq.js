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
    $.ajax({
        type: 'get',
        url: '/sidebar/details/' + id,
        dataType: "html",
        success: function (data) {
            $('#detailsCard').html(data);
        }
    });

    $.ajax({
        type: 'get',
        url: '/sidebar/delReq/' + id,
        dataType: "html",
        success: function (data) {
            $('#delReqCard').html(data);
        }
    });

    $.getJSON("/file/details/" + $(this).attr("id"), function (data) {
        var obj = JSON.parse(data[0].sharing);
        $("#Users").attr("value", obj.users);
        $(".tagsinput").tagsinput();
    });
    $("#no-content").hide(0);
}).dblclick(function () {
    window.open("/file/" + $(this).attr("id"));
});

$(document).on('click', '.del-ver',(function () {
    $("#fileDelForm").attr("action", "/file/del/" + $(this).attr("id"));
    $("#delFile").modal("show");
}));

$(document).on('click', '#tagButton',(function () {
    $("#addTagToFile").modal("show");
}));

$(document).on('click', '#shareButton',(function () {
    $("#fileShare").modal("show");
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