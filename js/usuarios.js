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

    $('#formUsuariosEliminar').submit(function (e) {
        e.preventDefault();

        const id = $.trim($('#id_borrar').val());

        // console.log("formUsuariosEliminar id: "+id);

        if (id_borrar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Mensaje',
                text: 'No se tiene el registro a eliminar',
            });
            return false;
        } else {
            $.ajax({
                url: "./bd/usuarios_baja.php",
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
                            window.location.href = "./usuarios.php";
                        });
                    }
                }
            });
        }
    });

    $('#formGruposCrear').submit(function (e) {
        e.preventDefault();

        const id = $.trim($('#id_grupo_update').val());
        const nombre = $.trim($('#nombre').val());
        const icon = $.trim($('#icon option:selected').val());

        // console.log("ID: " + id + " length: " + id.length);
        // console.log("nombre: " + nombre);
        // console.log("Icon: " + icon);

        let accion = (id.length == 0) ? "create" : "update";

        if (id.length == 0 && nombre.length == 0 && icon.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Mensaje',
                text: 'No se tiene todos los registros para crear un grupo',
            });
            return false;
        } else {
            $.ajax({
                url: "./bd/usuarios_alta.php",
                type: "POST",
                datatype: "json",
                data: {
                    id,
                    nombre,
                    icon
                },
                success: function (data) {
                    //console.log("out: " + data);
                    if (data.includes("Error de conexión a la BD")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error de conexión a la BD',
                        });
                    } else if (data == "null" || data.includes("Duplicate")) {
                        let texto_accion = (accion === "create") ? "crear" : "actualizar";
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error, grupo existente',
                        });
                    } else if (data == "null" || data.includes("Error")) {
                        let texto_accion = (accion === "create") ? "crear" : "actualizar";
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al ' + texto_accion + ' el registro',
                        });
                    } else {
                        let texto_accion = (accion === "create") ? "creó" : "actualizó";
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Se ' + texto_accion + ' el registro satisfactoriamente',
                        }).then((result) => {
                            window.location.href = "./usuarios.php";
                        });
                    }
                }
            });
        }
    });
    
})();