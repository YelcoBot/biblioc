$(document).ready(function () {
    //Register

    $("#FormRegister").on("submit", function () {
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "/signin",
            dataType: "json",
            data: data,
            cache: false,
            processData: false,
        }); /*
            .done(function () {
                alert("success");
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                alert("complete");
            });*/
    });
});
