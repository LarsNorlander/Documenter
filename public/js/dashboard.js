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
    $("#fileTagForm").attr("action", "/file/addTag/" + $(this).attr("id"));
    $("#awardDelForm").attr("action", "/award/delReq/" + $(this).attr("id"));
    $.ajax({
        type: 'get',
        url: '/sidebar/version/' + id,
        dataType: "html",
        success: function (data) {
            $('#versionCard').html(data);
        }
    });
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
        url: '/sidebar/sharing/' + id,
        dataType: "html",
        success: function (data) {
            $('#sharingCard').html(data);
        }
    });
    $.ajax({
        type: 'get',
        url: '/sidebar/tags/' + id,
        dataType: "html",
        success: function (data) {
            $('#tagsCard').html(data);
        }
    });
    $.ajax({
        url: '/modal/addTag/' + id,
        dataType: "html",
        success: function (data) {
            $('#modalFileTag').append(data);
            $("select").select2({dropdownCssClass: 'dropdown-inverse'});
        }
    });

    $.ajax({
        url: '/modal/sharing/' + id,
        dataType: "html",
        success: function (data) {
            $('#modalSharing').append(data);
            $("select").select2({dropdownCssClass: 'dropdown-inverse'});
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

};

var last_valid_selection = null;
$('#searchTags').change(function(event) {
    if ($(this).val().length > 1) {
        alert('You can only choose 1!');
        $(this).val(last_valid_selection);
        $("select").select2({dropdownCssClass: 'dropdown-inverse'});
    } else {
        last_valid_selection = $(this).val();
    }
});

// Section for sidebare