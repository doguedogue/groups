(function () {
    'use strict';

    $('#createModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        const id = button.data('id');
        const nombre = button.data('nombre');
        const icon = button.data('icon');

        console.log("Icono editar: " + icon);

        var modal = $(this);
        modal.find('.modal-title').text(id > 0 ? "Actualizar Grupo" : "Nuevo Grupo");
        modal.find('#id_grupo_update').val(id);
        modal.find('#nombre').val(nombre);
        modal.find("#icon option[value='" + icon + "']").prop('selected', true);

        if (id > 0) {
            document.getElementById('boton_crear').className = 'btn btn-warning';
            modal.find('#boton_crear').val("Actualizar");
        } else {
            //restart
            const selectIcon = document.getElementById("icon");
            selectIcon.selectedIndex = 0;
            document.getElementById('boton_crear').className = 'btn btn-success';
            modal.find('#boton_crear').val("Crear");
        }
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id_borrar = button.data('id');
        var modal = $(this);
        modal.find('#id_borrar').val(id_borrar);
    });

    $('#formGruposEliminar').submit(function (e) {
        e.preventDefault();

        const id = $.trim($('#id_borrar').val());

        console.log("formGruposEliminar id: "+id);

        if (id_borrar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Mensaje',
                text: 'No se tiene el registro a eliminar',
            });
            return false;
        } else {
            $.ajax({
                url: "./bd/grupos_baja.php",
                type: "POST",
                datatype: "json",
                data: {
                    id
                },
                success: function (data) {
                    //console.log("out: " + data);
                    if (data.includes("Error de conexión a la BD")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error de conexión a la BD',
                        });
                    }                    
                    else if (data.includes("Error") && data.includes("constraint")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error, él grupo tiene usuarios asignados',
                        });
                    }
                    else if(data == "null" || data.includes("Error")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al eliminar el registro',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Se eliminó el registro satisfactoriamente',
                        }).then((result) => {
                            window.location.href = "./grupos.php";
                        });
                    }
                }
            });
        }
    });
    
})();