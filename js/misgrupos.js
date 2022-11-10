(function () {
    'use strict';

    $('#search').on('change', '', function (e) { 
        const search = $.trim($('#search option:selected').val());
        window.location.href = "./index.php?q="+search;
    }); 
})();