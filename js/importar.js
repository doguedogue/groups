(function () {
    'use strict';

    $(document).ready(function () {
        document.getElementById('div_resultados').style.display = 'none';
    });

    
    $('#importar').click(function () {
        
        const import_select = $.trim($('#import_select option:selected').val());
        const cantidad = $.trim($('#cantidad option:selected').val());
        
        $("#message").html(
            "<b>Importar: </b> " + import_select + "<br>" +
            "<b>Registros: </b> " + cantidad
        );

        document.getElementById('div_resultados').style.display = 'block';

        
    });

})();