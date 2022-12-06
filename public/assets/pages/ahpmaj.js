var criteriasmaj = [];
var types = [];
var candidatesmaj = [];
var numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "."];

function addNewCriteriaInput() {
    $("#criteria-form-container").append(`<div class="md-form">
                        <div class="row">
                            <div class="col-10">
                                <input type="text" name="criteriasmaj[]" placeholder="Masukan criteria" class="form-control criteria" required >
                                <span class="d-block">
                                    <select name="types[]" class="browser-default custom-select criteria-type small" required>
                                        <option value="0" selected>Qualitative</option>
                                        <option value="1">Quantitative</option>
                                    </select>
                                </span>
                            </div>
                            <span class="col-1">
                                <button  type="button"  class="btn btn-danger btn-sm" onclick="return deleteCriteriaInput(this);">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>
                        </div>
                    </div>`);
    $(".criteria").focus();
}

function generateInterestRelativeMatrixMaj() {
    var size = ($("input.criteriamaj").length);

    criteriasmaj = [];
    var tr = `<th scope="col" class="text-center">#</th>`;
    var tbody = '';
    var flag = false;
    types = [];
    $.each($("input.criteriamaj"), function (i, element) {
        if (criteriasmaj.includes($(element).val())) {
            flag = true;
            return swal({
                type: 'error',
                title: 'Oops...',
                text: 'criteria ' + $(element).val() + ' sudah ada'
            });
        }
        types.push($('select.criteria-type').eq(i).val());
        criteriasmaj.push($(element).val());
        tr += `<th scope="col" class="text-center">` + $(element).val() + `</th>`;

        var td = '';
        for (let j = 0; j < size; j++) {
            td += '<td><input type="text" name="barismaj[' + i + '][' + j + ']" class="form-control table-input" id="table-input-maj-' + i + '-' + j + '" data-i="' + i + '" data-j="' + j + '" value="' + (i == j ? '1' : '') + '" ' + (i == j ? 'readonly ' : 'onKeyUp="return cekInputMatrixMaj(this);"') + 'required /></td>';
        }
        tbody += `<tr>
                            <th scope="row" class="black white-text text-center">` + $(element).val() + `</th>
                            ` + td + `
                        </tr>`;
    });
    console.log(criteriasmaj, tr);
    if (!flag) {
        $("#table-matrix-interest-atas-maj").html(tr);
        $("#table-matrix-interest-bawah-maj").html(tbody);
    }


}

function cekInputMatrixMaj(trig) {
    var str = $(trig).val();
    var nstr = '';

    for (let i = 0; i < str.length; i++) {
        if (numbers.includes(str[i])) {
            nstr += str[i];
            console.log("CHAR", str[i]);
            console.log(str);
        }
    }
    //console.log(nstr);
    //var timer = setInterval(function(){
    if (str[str.length - 1] == ".") {
        return true;
    }
    nstr = nstr === '' ? '' : parseFloat(nstr);
    console.log(nstr);
    $(trig).val(nstr);
    var i = $(trig).data('i');
    var j = $(trig).data('j');
    if (nstr !== '') {
        var nextEl = null
        $('#table-input-maj-' + j + '-' + i).val('AUTO');
        var increment = null;
        if ($('#table-input-maj-' + i + '-' + (j + 1)).length > 0) {
            j++;
            nextEl = $('#table-input-maj-' + i + '-' + (j));
            increment &= j;
        } else if ($('#table-input-maj-' + (i + 1) + '-0').length > 0) {
            i++;
            j = 0;
            increment &= i;
            nextEl = $('#table-input-maj-' + (i) + '-0');
        }
        if (nextEl) {
            if (i != j) {
                increment++;
            }
            //$('#table-input-'+i+'-'+(j)).focus();
        }

    } else {
        $('#table-input-maj-' + j + '-' + i).val('');
    }
    //clearInterval(timer);
    //},1000);
}

function cekPairWiseMatrixMaj(trig, c) {
    var str = $(trig).val();
    var nstr = '';

    for (let i = 0; i < str.length; i++) {
        if (numbers.includes(str[i])) {
            nstr += str[i];
        }
    }
    console.log(nstr);
    nstr = nstr === '' ? '' : parseFloat(nstr);
    $(trig).val(nstr);
    var i = $(trig).data('i');
    var j = $(trig).data('j');
    if (nstr !== '') {
        $('#table-' + c + '-input-maj-' + j + '-' + i).val('AUTO');
    } else {
        $('#table-' + c + '-input-maj-' + j + '-' + i).val('');
    }
}

function generatePairWiseMatrixMaj() {
    $('#pairwise-body-maj').html('');
    candidatesmaj = [];
    var flag = false;
    $.each($("input.alternative-inputmaj"), function (i, element) {
        var candidate = $(element).val();
        if (candidatesmaj.includes(candidate)) {
            flag = true;
            return swal({
                type: 'error',
                title: 'Oops...',
                text: '2 Alternative can\'t have same name : ' + $(element).val()
            });
        }
        candidatesmaj.push(candidate);
    });
    if (!flag) {
        var i = 0;
        criteriasmaj.forEach(element => {
            // if (types[i] == 0) {
            printPairWiseMatrixMaj(element, i);
            // } else {
            //     printQuantitativeMatrix(element, i);
            // }
            i++;
        });
    }
}

function printQuantitativeMatrix(critera_name, c) {
    var size = candidatesmaj.length;

    var tbody = '';
    var i = 0;
    candidatesmaj.forEach(element => {
        tbody += `
                    <tr>
                        <td>` + element + `</td>
                        <td><input type="text" name="pairwisemaj[` + c + `][]" class="table-input form-control" value="" id="table-quantitative-` + c + `-` + i + `" required></td>
                    </tr>
                `;
        i++;
    });
    var html = (c + 1) + `. PairWise Matrix for Criteria : <strong>` + critera_name + `</strong>
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="black white-text">
                                <tr>
                                    <th>Alternative</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                ` + tbody + `
                            </tbody>
                        </table></div>`;
    $('#pairwise-body').append(html);
}

function printPairWiseMatrixMaj(critera_name, c) {
    var size = candidatesmaj.length;

    var tr = `<th scope="col" class="text-center">#</th>`;

    candidatesmaj.forEach(element => {
        tr += `<th scope="col" class="text-center">` + element + `</th>`;
    });
    var tbody = '';
    for (let i = 0; i < size; i++) {
        var td = '';

        for (let j = 0; j < size; j++) {
            td += '<td><input type="text" name="pairwisemaj[' + c + '][' + i + '][' + j + ']" class="form-control table-input" id="table-' + c + '-input-maj-' + i + '-' + j + '" data-i="' + i + '" data-j="' + j + '" value="' + (i == j ? '1' : '') + '" ' + (i == j ? 'readonly ' : 'onKeyUp="return cekPairWiseMatrixMaj(this,' + c + ');"') + 'required/></td>';
        }

        tbody += `<tr>
                            <th scope="row" class="black white-text text-center">` + candidatesmaj[i] + `</th>
                            ` + td + `
                        </tr>`
    }
    var html = (c + 1) + `. PairWise Matrix for Criteria : <strong>` + critera_name + `</strong>
                        <table class="table table-striped">
                            <thead class="black white-text">
                                <tr>
                                    ` + tr + `
                                </tr>
                            </thead>
                            <tbody>
                                ` + tbody + `
                            </tbody>
                        </table>`;
    $('#pairwise-body-maj').append(html);

}

function addNewAlternativeInput() {
    $('#alternative-form-container').append(`
            <div class="md-form">
                <div class="row">

                        <div class="col-10">
                                <input type="text" name="alternatives[]" placeholder="Masukan Alternative" class=" alternative-input form-control" required>


                            </div>

                            <span class="col-2">
                                <button  type="button"  class="btn btn-danger btn-sm" onclick="deleteCriteriaInput(this)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </span>


                </div>


                </div>
                                    `);

    $(".alternative-input").focus();
}

function deleteCriteriaInput(trig) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove it!'
    }).then((result) => {
        if (result.value) {
            $(trig).parent().parent().parent().remove();
            Swal.fire(
                'Deleted!',
                'The criteria has been removed.',
                'success'
            )
        }
    })

}


$(document).ready(function () {
    $(document).on("click", "input[type='text']", function () {
        $(this).select();
    });
});
