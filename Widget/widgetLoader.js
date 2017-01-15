

$(document).ready(function() {

    var container = 'widgetContainer';
    var postsList = "postsList";

    var element = document.getElementById(container);

    $.ajax({
        type: 'GET',
        url: $(element).attr('data-url_base') + $(element).attr('data-path'),
        data: {
            controller: $(element).attr('data-controller'),
            action: $(element).attr('data-action'),
            id: $(element).attr('data-id')
        },
        dataType: 'json',
        success: function (data, statusText, jqhxr) {


            $(element).append("<ul id='" + postsList + "' class='list-group'>");

            $.each(data, function(index, user) {

                if ((index % 2) === 0) {

                    $("#" + postsList).append(
                        "<li class='list-group-item left'>" +
                            "<span class='pull-left'>" +
                                "<img src='" + $(element).attr('data-url_base') + user.profile_picture +"' class='img-user'>" +
                            "</span>" +
                            "<div>" +
                                "<div class='post-content'>" +
                                    "<strong>@" + user.author + "</strong>" +
                                    "<small class=''> " + user.hour + " </small>" +
                                    "<small class='pull-right'> " + user.date + " </small>" +
                                "</div>" +
                                "<p>" + user.publication + "</p>"+
                            "</div>" +
                        "</li>");
                } else {

                    $("#" + postsList).append(
                        "<li class='list-group-item right'>" +
                            "<span class='pull-left'>" +
                                "<img src='" + $(element).attr('data-url_base') + user.profile_picture +"' class='img-user'>" +
                            "</span>" +
                            "<div>" +
                                "<div class='post-content'>" +
                                    "<strong>@" + user.author + "</strong>" +
                                    "<small class=''> " + user.hour + " </small>" +
                                    "<small class='pull-right'> " + user.date + " </small>" +
                                "</div>" +
                                "<p class=''>" + user.publication + "</p>"+
                            "</div>" +
                        "</li>");
                }

            });

            $(element).append("</ul>");
        }
    });

});
