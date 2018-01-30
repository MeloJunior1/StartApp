$(function() {
    //$('.selectCategoria').prop('multiple', true);

    $('.selectCategoria[multiple]').select2({
        placeholder: 'Selecione algumas categorias',
        theme: "bootstrap"
    });

    $('.selectUf').select2({
        placeholder: 'UF',
        theme: "bootstrap",
        ajax: {
            url: '/local/brazil',
            dataType: 'json',
            type: 'GET',
            data: function (params) {
                var query = {
                    q: params.term,
                    type: 'public'
                }
            
                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            processResults: (result) => {
                return {
                    results: $.map(result, function(obj) {
                        return { id: obj.sigla, text: obj.sigla };
                    })
                };
            }
        }
    });

    $('.selectCidade').select2({
        placeholder: 'Selecione uma cidade',
        theme: "bootstrap"
    });
    
    $('.selectUf').change((e) => {
        $secondTrgt = $('.selectCidade');
        $secondTrgt.empty();

        $secondTrgt.select2({
            placeholder: 'Selecione uma cidade',
            theme: "bootstrap",
            ajax: {
                url: '/local/brazil/'+e.currentTarget.value,
                dataType: 'json',
                type: 'GET',
                data: function (params) {
                    var query = {
                        q: params.term,
                        type: 'public'
                    }
                
                    // Query parameters will be ?search=[term]&type=public
                    return query;
                },
                processResults: (result) => {
                    return {
                        results: $.map(result, function(obj) {
                            return { id: obj, text: obj };
                        })
                    };
                }
            }
        });

        $secondTrgt.prop('disabled', false);
    })
});
