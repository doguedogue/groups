(function () {
    'use strict';


    $('#grupos').click(function () {
        window.location.href = "./grupos.php";
    });
    
    $('#usuarios').click(function () {
        window.location.href = "./usuarios.php";
    });

       
    $('#asignargrupo').click(function () {
        window.location.href = "./asignagrupo.php";
    });

    $('#search').on('change', '', function (e) { 
        const search = $.trim($('#search option:selected').val());
        window.location.href = "./detallegrupo.php?q="+search;
    });

    $('#grupos_select').on('change', '', function (e) { 
        const id_grupo = $.trim($('#grupos_select option:selected').val());
        window.location.href = "./detallegrupo.php?g="+id_grupo;
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

        console.log("formUsuariosEliminar id: "+id);

        if (id_borrar.length == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Mensaje',
                text: 'No se tiene el registro a eliminar',
            });
            return false;
        } else {
            $.ajax({
                url: "./bd/detallegrupo_baja.php",
                type: "POST",
                datatype: "json",
                data: {
                    id
                },
                success: function (data) {
                    // console.log("out: " + data);
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
                            text: 'Error al desasignar al usuario',
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
                            window.location.reload(true);
                        });
                    }
                }
            });
        }
    });
})();