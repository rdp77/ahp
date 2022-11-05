"use strict";

$("#modal").fireModal({
    title: "Beri Kami Masukan!",
    size: "modal-lg",
    body: $("#modal-body"),
    center: true,
    footerClass: "bg-whitesmoke",
    autoFocus: true,
    onFormSubmit: function (modal, e, form) {
        let form_data = $(e.target).serialize();
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            $.ajax({
                url: feedback,
                type: "POST",
                data: form_data,
                success: function (response) {
                    if (response.status === "success") {
                        swal(response.data, {
                            icon: "success",
                        }).then(() => {
                            window.location.reload();
                        });
                    } else if (response.status === "error") {
                        console.log(response.data);
                        // foreach to show error
                        for (var index in response.data) {
                            iziToast.error({
                                title: "Error",
                                message: response.data[index],
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
            clearInterval(fake_ajax);
        }, 1500);

        e.preventDefault();
    },
    buttons: [
        {
            text: "Rating Kami",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {
            },
        },
    ],
});

$('#check-major').change(function () {
    this.checked ? $('#alternative').prop('disabled', true) :
        $('#alternative').prop('disabled', false);
});

function checkAlternative() {
    $.ajax({
        url: '/get-alternative',
        type: "GET",
        success: function (data) {
            console.log(data);
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
