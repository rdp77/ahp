"use strict";

function save() {
    var form = $("#stored");
    var formdata = new FormData(form[0]);
    $.ajax({
        url: url,
        data: formdata ? formdata : form.serialize(),
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "success") {
                swal(data.data, {
                    icon: "success",
                }).then(function () {
                    window.location = index;
                });
            } else if (data.status == "error") {
                for (var number in data.data) {
                    iziToast.error({
                        title: "Error",
                        message: data.data[number],
                    });
                }
            }
        },
        statusCode: {
            422: function (response) {
                for (var index in response.responseJSON.data) {
                    iziToast.error({
                        title: "Error",
                        message: response.responseJSON.data[index],
                    });
                }
            },
            419: function () {
                swal("Login session has expired, please login again!", {
                    icon: "error",
                }).then(function () {
                    window.location.reload();
                });
            },
        },
    });
}

function update() {
    var form = $("#stored");
    var formdata = new FormData(form[0]);
    formdata.append("_method", "PATCH");
    $.ajax({
        url: url,
        data: formdata ? formdata : form.serialize(),
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "success") {
                swal(data.data, {
                    icon: "success",
                }).then(function () {
                    window.location = index;
                });
            } else if (data.status == "error") {
                for (var number in data.data) {
                    iziToast.error({
                        title: "Error",
                        message: data.data[number],
                    });
                }
            }
        },
        statusCode: {
            422: function (response) {
                for (var index in response.responseJSON.data) {
                    iziToast.error({
                        title: "Error",
                        message: response.responseJSON.data[index],
                    });
                }
            },
            419: function () {
                swal("Login session has expired, please login again!", {
                    icon: "error",
                }).then(function () {
                    window.location.reload();
                });
            },
        },
    });
}
