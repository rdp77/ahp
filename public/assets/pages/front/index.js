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
                    swal(response.data, {
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
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
            handler: function (modal) {},
        },
    ],
});
