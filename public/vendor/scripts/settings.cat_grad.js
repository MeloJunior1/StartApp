var table = [];

$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {
    type: "put"
}

$.fn.editable.defaults.params = function (params) {
    params._token = $("meta[name=csrf-token]").attr("content");
    return params;
};

$(document).ready(() => {

    table['category'] = $("#categoriasTable").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
    });

    table['grade'] = $("#gradesTable").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json"
        }
    });

    $('.definitionName').editable({
        error: (response) => {
            return response.responseJSON.message
        }
    });
})

$('#categoriasTable tbody tr button.btn').click(function (e) {
    e.preventDefault();
    
    table['category']
        .row($(this).parents('tr'))
        .remove()
        .draw();

    var form = $(this).siblings('form');
    $("body").append(form);

    $(form).submit().remove()
})

$('#gradesTable tbody tr button.btn').click(function (e) {
    e.preventDefault();
    
    table['grade']
        .row($(this).parents('tr'))
        .remove()
        .draw();

    var form = $(this).siblings('form');
    $("body").append(form);

    $(form).submit().remove()
})