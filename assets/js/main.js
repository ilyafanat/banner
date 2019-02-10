$(document).ready(function() {
    var tempImg = new Image() ;
    tempImg.src = $("img").attr("src");
    tempImg.onload = function() {
        $.ajax({
            type: "post",
            url: "/ajax.php",
            data: {
                "path": window.location.href
            }
        })
        .done(function () {
            console.log("success");
        }).fail(function() {
            console.log("error");
        });
    };
});