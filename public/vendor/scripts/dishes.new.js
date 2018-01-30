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
        var label = $(e.target).siblings('label');
        label.removeClass('btn-primary').addClass('btn-success').text('Imagem selecionada');
    }
});

$('#image').click((e) =>{
    e.target.value = null;
    
    var label = $(e.target).siblings('label');
    label.removeClass('btn-success').addClass('btn-primary').text('Escolha uma imagem');
})