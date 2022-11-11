(function () {
    'use strict';

    $(document).ready(function () {

        var dataTablesUsuarios = $("#dataTablesUsuarios").DataTable();
        
        $('#dataTablesUsuarios tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

        $('#button').click(function () {
            selectedItems(dataTablesUsuarios);
        });
    });

    function selectedItems(dataTablesUsuarios) {
        const arreglo = dataTablesUsuarios.rows('.selected').data();
        const size = arreglo.length;
        // alert(size + ' fila(s) seleccionadas');
        let arreglo_usuarios = new Array();

        for (let i = 0; i < size; i++) {
            arreglo_usuarios.push(arreglo[i][0]);
        }
        
        //Grupo
        const id_grupo = $.trim($('#grupos_select option:selected').val());

        
        if (size == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Mensaje',
                text: 'No se ha seleccionado ningún usuario',
            });
            return false;
        } else {
            $.ajax({
                url: "./bd/asignagrupo_alta.php",
                type: "POST",
                datatype: "json",
                data: {
                    id_grupo,
                    arreglo_usuarios
                },
                success: function (data) {
                    // console.log("out: " + data);
                    if (data.includes("Error de conexión a la BD")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error de conexión a la BD',
                        });
                    } else if (data == "null" || data.includes("Duplicate ")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Usuario ya asignado en grupo',
                        });
                    } else if (data == "null" || data.includes("Error")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al agrupar usuario',
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Se agruparon los usuarios satisfactoriamente',
                        }).then((result) => {

                            window.location.href = "./asignagrupo.php";
                        });
                    }
                }
            });
        }
        
    }

    $('#grupos').click(function () {
        window.location.href = "./grupos.php";
    });
    
    $('#usuarios').click(function () {
        window.location.href = "./usuarios.php";
    });

    $('#search').on('change', '', function (e) { 
        const search = $.trim($('#search option:selected').val());
        window.location.href = "./asignagrupo.php?q="+search;
    });
    

    
})();