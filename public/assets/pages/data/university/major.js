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
        {data: "faculty"},
        {data: "major"},
        {data: "action", orderable: false, searchable: true},
    ],
    buttons: [
        {
            extend: "print",
            text: "Print",
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
            text: "Export CSV"
        },
        {
            extend: "excelHtml5",
            exportOptions: {
                columns: ":visible",
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
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data jurusan Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/data/major/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data jurusan berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data jurusan Anda tidak jadi dihapus!");
        }
    });
}

$("#university").on("change", function () {
    const id = $(this).val();
    $('#faculty').empty();
    $.ajax({
        url: "/data/faculty-data/" + id,
        type: "GET",
        success: function (data) {
            $.each(data.data, function (key, value) {
                $('#faculty').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        },
    });
});
