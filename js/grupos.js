(function () {
    'use strict';

    $('#createModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        const id = button.data('id');
        const nombre = button.data('nombre');
        const icon = button.data('icon');

        console.log("Icono editar: "+icon);

        var modal = $(this);
        modal.find('.modal-title').text(id > 0 ? "Actualizar Grupo" : "Nuevo Grupo");
        modal.find('#id_grupo_update').val(id);
        modal.find('#nombre').val(nombre);
        modal.find("#icon option[value='" + icon + "']").prop('selected', true);


        if (id > 0) {
            document.getElementById('boton_crear').className = 'btn btn-warning';
            modal.find('#boton_crear').val("Actualizar");
        } else {
            document.getElementById('boton_crear').className = 'btn btn-success';
            modal.find('#boton_crear').val("Crear");
        }
    });
    
})();