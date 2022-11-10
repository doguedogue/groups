(function () {
    'use strict';

    $('#search').on('change', '', function (e) { 
        const search = $.trim($('#search option:selected').val());
        window.location.href = "./usuarios.php?q="+search;
    });

    
    $('#importar').click(function () {
        window.location.href = "./importar.php";
    });

    $('#createModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        const id = button.data('id');
        const login = button.data('login');
        const name = button.data('name');
        const avatar_url = button.data('avatar_url');
        const email = button.data('email');
        const company = button.data('company');
        const blog = button.data('blog');
        const location = button.data('location');
        const bio = button.data('bio');
        const twitter_username = button.data('twitter_username');
        const follower = button.data('follower');
        const following = button.data('following');

        var modal = $(this);
        modal.find('.modal-title').text(id > 0 ? "Actualizar Usuario" : "Nuevo Usuario");
        modal.find('#id_usuario_update').val(id);
        modal.find('#login').val(login);
        modal.find('#name').val(name);
        modal.find('#avatar_url').val(avatar_url);
        modal.find('#email').val(email);
        modal.find('#company').val(company);
        modal.find('#blog').val(blog);
        modal.find('#location').val(location);
        modal.find('#bio').val(bio);
        modal.find('#twitter_username').val(twitter_username);

        if (avatar_url?.length > 0) {
            $("#img_avatar").attr("src",avatar_url);
        } else {
            $("#img_avatar").attr("src","./assets/img/logo.png");            
        }

        $('#follower').prop('checked', (follower == 1) ? true : false);
        $('#following').prop('checked', (following == 1) ? true : false);

        if (id > 0) {
            document.getElementById('boton_crear').className = 'btn btn-warning';
            modal.find('#boton_crear').val("Actualizar");
        } else {
            //restart
            $('#follower').prop('checked', false);
            $('#following').prop('checked', false);   
            
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

    $('#formUsuariosCrear').submit(function (e) {
        e.preventDefault();

        const id = $.trim($('#id_usuario_update').val());
        const login = $.trim($('#login').val());
        const name = $.trim($('#name').val());
        const avatar_url = $.trim($('#avatar_url').val());
        const email = $.trim($('#email').val());
        const company = $.trim($('#company').val());
        const blog = $.trim($('#blog').val());
        const location = $.trim($('#location').val());
        const bio = $.trim($('#bio').val());
        const twitter_username = $.trim($('#twitter_username').val());
        const follower = $('#follower').is(":checked")?1:0;
        const following = $('#following').is(":checked")?1:0;

        // console.log("id: "+id);
        // console.log("login: "+login);
        // console.log("name: "+name);
        // console.log("avatar_url: "+avatar_url);
        // console.log("email: "+email);
        // console.log("company: "+company);
        // console.log("blog: "+blog);
        // console.log("location: "+location);
        // console.log("bio: "+bio);
        // console.log("twitter_username: "+twitter_username);
        // console.log("follower: "+follower);
        // console.log("following: "+following);


        let accion = (id.length == 0) ? "create" : "update";

        if (id.length == 0 && login.length == 0) {
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
                    login,
                    name,
                    avatar_url,
                    email,
                    company,
                    blog,
                    location,
                    bio,
                    twitter_username,
                    follower,
                    following
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
                            text: 'Error, username existente',
                        });                        
                    } else if (data == "null" || data.includes("Error") || data.includes("Warning")) {
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