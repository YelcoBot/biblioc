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
            success: function (jsonData) {
                if (jsonData.status == "OK") {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: jsonData.message,
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                        window.location.replace("/");
                    });
                } else {
                    console.log("========'Exception Response'=========");
                    console.log(jsonData.exception);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: jsonData.message,
                    });
                }
            },
            error: function (xhr, status) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "A ocurrido un error, por favor inténtelo de nuevo!!",
                });
            },
            complete: function (xhr, status) {
                //alert('Petición realizada');
            },
        });
    });
});
