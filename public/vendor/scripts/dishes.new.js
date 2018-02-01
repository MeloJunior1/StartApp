$('select').select2({
    placeholder: 'Selecione ...',
    theme: "bootstrap",
});

$('select[multiple]').select2({
    placeholder: 'Selecione ...',
    theme: "bootstrap",
});

$('#image').change((e) => {
    if(e.target.value)
    {
        var label = $(e.target).siblings('label.btn');
        label.removeClass('btn-primary').addClass('btn-success').text('Imagem selecionada');
    }
});

$('#image').click((e) =>{
    e.target.value = null;
    
    var label = $(e.target).siblings('label.btn');
    label.removeClass('btn-success').addClass('btn-primary').text('Escolha uma imagem');
});

$(document).ready(() => {
    var options = $("select[name='grade_id[]']").find(':selected');

    if(options.length != 0)
    {
        $.each(options, (idx, value) => {
            $("select[name='grade_id[]']").trigger({
                type: 'select2:select',
                params: {
                    data:{
                        id: $(value).val(),
                        text: $(value).text()
                    }
                }
            });
        })
    }
});

$("select[name='grade_id[]']").on('select2:select', function (e) {
    if(e.params){
        var data = e.params.data ;
        handleTable(data, true);
    }
});

$("select[name='grade_id[]']").on('select2:unselect', function (e) {
    if(e.params){
        var data = e.params.data ;
        handleTable(data, false);
    }
});

function handleTable(select, add)
{
    var table = $("#grade-table");
    var body = $(table).children('tbody');
    var rows = $(body).children('tr');

    if(select.text == null || select.id == null)
    {
        return false;
    }

    if(rows.length == 0) 
    {
        $(body).append(generateRow(select)); return false;
    } 

    $.each(rows, (idx, value) => {
        var v1 = parseInt($(value).data('gradeid'));
        var v2 = parseInt(select.id)
        
        if( v1 != v2 && add)
        {
            $(body).append(generateRow(select)); return false;
        } 
        else if(v1 == v2 && !add)
        {
            $(value).remove(); return false;
        } 
    });
}

function generateRow(option)
{
    return `
    <tr data-gradeId="${option.id}">
        <td>${option.text}</td>
        <td width="100">
            <input name="grade_value[${option.id}]" type="number" value="0.00" class="form-control input-sm"/>
        </td>
    </tr>
    `
}