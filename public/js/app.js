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
    //Login
    $("#FormLogin").on("submit", function () {
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "/authenticate",
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
                        window.location.replace("/dashboard");
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

    //Rol
    var tableRol = $("#TableRol").DataTable({
        ajax: "/roles",
        language: {
            processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            infoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            search: "Buscar:",
            infoThousands: ",",
            loadingRecords: "Cargando...",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
            aria: {
                sortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
            decimal: ",",
            thousands: ".",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        },
    });
    $("#FormRol").on("submit", function () {
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "/rol",
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
                        tableRol.ajax.reload();
                        $("#ModalRol").modal("hide");
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
    $("#BtnNewRol").on("click", function () {
        $("#FormRol")[0].reset();
        $("#FormRol [name='metodo']").val("Crear");
        $("#FormRol [name='id']").val("");
        $("#ModalRol").modal({
            keyboard: false,
            backdrop: "static",
        });
    });
    $("#TableRol").on("click", ".btn-edit", function () {
        $("#FormRol")[0].reset();
        $("#FormRol [name='metodo']").val("Editar");
        $("#FormRol [name='id']").val("");

        var id = $(this).attr("idrol");
        $.ajax({
            method: "GET",
            url: "/rol/" + id,
            dataType: "json",
            cache: false,
            processData: false,
            success: function (jsonData) {
                if (jsonData.status == "OK") {
                    for (const [key, value] of Object.entries(jsonData.data)) {
                        if (key == "estado") {
                            if (value == "1") {
                                $(`#FormRol [name="${key}"]`).prop(
                                    "checked",
                                    true
                                );
                            }
                        } else {
                            $(`#FormRol [name="${key}"]`).val(value);
                        }
                    }

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: jsonData.message,
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                        $("#ModalRol").modal({
                            keyboard: false,
                            backdrop: "static",
                        });
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
    $("#TableRol").on("click", ".btn-delete", function () {
        var id = $(this).attr("idrol");

        Swal.fire({
            icon: "warning",
            title: "¿Estas segur@?",
            text: "¡No podrás revertir esto!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminarlo!",
        }).then((result) => {
            var data = $("#FormDelete").serialize();
            $.ajax({
                method: "DELETE",
                url: "/rol/" + id,
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
                            tableRol.ajax.reload();
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

    //User
    var tableUser = $("#TableUser").DataTable({
        ajax: "/usuarios",
        language: {
            processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            infoEmpty:
                "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            search: "Buscar:",
            infoThousands: ",",
            loadingRecords: "Cargando...",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior",
            },
            aria: {
                sortAscending:
                    ": Activar para ordenar la columna de manera ascendente",
                sortDescending:
                    ": Activar para ordenar la columna de manera descendente",
            },
            decimal: ",",
            thousands: ".",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
        },
    });
    $("#FormUser").on("submit", function () {
        var data = $(this).serialize();
        $.ajax({
            method: "POST",
            url: "/usuario",
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
                        tableUser.ajax.reload();
                        $("#ModalUser").modal("hide");
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
    $("#BtnNewUser").on("click", function () {
        $("#FormUser")[0].reset();
        $("#FormUser [name='metodo']").val("Crear");
        $("#FormUser [name='id']").val("");
        $("#ModalUser").modal({
            keyboard: false,
            backdrop: "static",
        });
    });
    $("#TableUser").on("click", ".btn-edit", function () {
        $("#FormUser")[0].reset();
        $("#FormUser [name='metodo']").val("Editar");
        $("#FormUser [name='id']").val("");

        var id = $(this).attr("iduser");
        $.ajax({
            method: "GET",
            url: "/usuario/" + id,
            dataType: "json",
            cache: false,
            processData: false,
            success: function (jsonData) {
                if (jsonData.status == "OK") {
                    for (const [key, value] of Object.entries(jsonData.data)) {
                        if (key == "estado") {
                            if (value == "1") {
                                $(`#FormUser [name="${key}"]`).prop(
                                    "checked",
                                    true
                                );
                            }
                        } else {
                            $(`#FormUser [name="${key}"]`).val(value);
                        }
                    }

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: jsonData.message,
                        showConfirmButton: false,
                        timer: 1500,
                    }).then((result) => {
                        $("#ModalUser").modal({
                            keyboard: false,
                            backdrop: "static",
                        });
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
    $("#TableUser").on("click", ".btn-delete", function () {
        var id = $(this).attr("iduser");

        Swal.fire({
            icon: "warning",
            title: "¿Estas segur@?",
            text: "¡No podrás revertir esto!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminarlo!",
        }).then((result) => {
            var data = $("#FormDelete").serialize();
            $.ajax({
                method: "DELETE",
                url: "/usuario/" + id,
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
                            tableUser.ajax.reload();
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
});
