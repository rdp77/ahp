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
        {data: "DT_RowIndex", orderable: false, searchable: false, width: "10%"},
        {data: "name"},
        {data: "type"},
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
