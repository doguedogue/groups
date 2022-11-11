(function () {
    'use strict';


    $('#grupos').click(function () {
        window.location.href = "./grupos.php";
    });
    
    $('#usuarios').click(function () {
        window.location.href = "./usuarios.php";
    });

    $('#search').on('change', '', function (e) { 
        const search = $.trim($('#search option:selected').val());
        window.location.href = "./detallegrupo.php?q="+search;
    });

    
})();