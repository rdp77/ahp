"use strict";

var table = $("#table").DataTable({
    pageLength: 10,
    processing: true,
    serverSide: true,
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Semua"],
    ],
    ajax: {
        url: index,
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
    oLanguage: {
        sEmptyTable: "Belum ada data",
    },
    columns: [
        {
            width: "10%",
            data: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        {data: "name"},
        {data: "code"},
        {data: "email"},
        {data: "address"},
        {data: "phone"},
        {data: "order"},
        {data: "action", orderable: false, searchable: true},
    ],
    buttons: [
        {
            extend: "print",
            text: "Print Semua",
            exportOptions: {
                modifier: {
                    selected: null,
                },
                columns: ":visible",
            },
            messageTop: "Dokumen dikeluarkan tanggal " + moment().format("L"),
            // footer: true,
            header: true,
        },
        {
            extend: "csv",
        },
        {
            extend: "print",
            text: "Print Yang Dipilih",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "excelHtml5",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "pdfHtml5",
            exportOptions: {
                columns: [0, 1, 2, 5],
            },
        },
        {
            extend: "colvis",
            postfixButtons: ["colvisRestore"],
            text: "Sembunyikan Kolom",
        },
    ],
});

$(".filter_name").on("keyup", function () {
    table.search($(this).val()).draw();
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data universitas Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/master/university/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data universitas berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data universitas Anda tidak jadi dihapus!");
        }
    });
}

$("#modal").fireModal({
    title: "Tambah Universitas",
    size: "modal-lg",
    body: $("#modal-body"),
    footerClass: "bg-whitesmoke",
    autoFocus: true,
    onFormSubmit: function (modal, e, form) {
        let form_data = $(e.target).serialize();
        let name = $("input[name=name]");
        let email = $("input[name=email]");
        let code = $("input[name=code]");
        let phone = $("input[name=phone]");
        let address = $("textarea[name=address]");
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            $.ajax({
                url: store,
                type: "POST",
                data: form_data,
                success: function () {
                    swal("Universitas Berhasil Disimpan", {
                        icon: "success",
                    }).then(() => {
                        table.draw();
                        $("#fire-modal-2").modal("hide");
                        name.val("");
                        email.val("");
                        code.val("");
                        phone.val("");
                        address.val("");
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
            text: "Tambah Data",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {
            },
        },
    ],
});

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data universitas Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/university/delete/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data universitas berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data universitas Anda tidak jadi dihapus!");
        }
    });
}

function delAll() {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data universitas Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/university/delete-all",
                type: "DELETE",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Semua data universitas berhasil dihapus", {
                            icon: "success",
                        });
                        table.draw();
                    } else if (data.status == "error") {
                        iziToast.error({
                            title: "Error",
                            message: data.data,
                        });
                    }
                },
            });
        } else {
            swal("Semua data universitas Anda tidak jadi dihapus!");
        }
    });
}

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data universitas Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/university/restore/" + id,
                type: "GET",
                success: function () {
                    swal("Data universitas berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data universitas Anda tidak jadi dikembalikan!");
        }
    });
}
