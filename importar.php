<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Groups</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="./vendor/sweetalert2/dist/dark.css" />

        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a href="index.php">
                <img src="./assets/img/logo.png" class="logo-brand" alt="Logo" width="80px">                
            </a>
            <a class="navbar-brand ps-3" href="index.php">Groups</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav  ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsuarios" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Usuarios
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUsuarios" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                                    <a class="nav-link" href="importar.php">Importar</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseGrupos" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Grupos
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseGrupos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="grupos.php">Grupos</a>
                                    <a class="nav-link" href="index.php">Mis Grupos</a>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">By <a class="about" href="https://github.com/doguedogue">doguedogue</a></div>                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2>Importar Usuarios Follow(ers|ing) de <span style="color:#be1e2d;">GitHub&trade;</span></h2>                                
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <button type="button" class="btn btn-success mr-2" id="grupos">
                                        <span><i class='fas fa-people-group'></i></span>Grupos</button>
                                    </li>
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <button type="button" class="btn btn-info mr-2" id="usuarios">
                                        <span><i class='fas fa-user-group'></i></span>Usuarios</button>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                            <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <select class="form-control combo-dark" name="import_select" id="import_select">
                                            <option value="Followers" selected>Followers</option>
                                            <option value="Following">Following</option>
                                        </select>                                        
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <select class="form-control combo-dark" name="cantidad" id="cantidad">
                                            <option value="1" selected>1 Página</option>
                                            <option value="5">5 Páginas</option>
                                            <option value="10">10 Páginas</option>
                                            <option value="20">20 Páginas</option>
                                            <option value="30">30 Páginas</option>
                                            <option value="40">40 Páginas</option>
                                            <option value="50">50 Páginas</option>
                                            <option value="100">100 Páginas</option>
                                            <option value="150">150 Páginas</option>
                                            <option value="200">200 Páginas</option>
                                            <option value="250">250 Páginas</option>
                                            <option value="300">300 Páginas</option>
                                            <option value="0">Todos</option>
                                        </select>
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <input type="number" class="col-sm-1 form-control combo-dark" 
                                            id="page" name="page" min="1" title="Seleccione el número de página">
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <button type="button" class="btn btn-warning mr-3" id="importar">
                                            <span><i class='fa-solid fa-right-to-bracket'></i></span>&nbsp;Importar</button>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="card mb-4" id="div_resultados" style="display: none;">
                            <div class="card-body">
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item  mr-2">
                                        <p><b>RESULTADOS DE IMPORTACIÓN</b></p>
                                        <p id="message"></p>
                                    </li>                                    
                                </ol>                              
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <ol class="breadcrumb mb-1 d-flex flex-column">
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <p><b>NOTA:</b> Para la conexión con <span style="color:#be1e2d;">GitHub&trade;</span> 
                                            es necesario que cuente con su token personal de acceso
                                            <a href="https://github.com/settings/tokens">aquí</a>
                                        </p>
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <div>
                                            <a href="https://github.com/settings/tokens">
                                                <img src="./assets/img/configura_token.png" alt="configuración de token" width="250px">                            
                                            </a>
                                        </div>
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <div>
                                            <button type="button" class="btn btn-danger mr-3" id="test">
                                                    <span><i class="fa-solid fa-flask-vial"></i></span>&nbsp;TEST</button>
                                        </div>
                                    </li>
                                    <li class="breadcrumb-item mr-2 mb-2">
                                        <div>
                                            <p id="msg_test"></p>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-2 foooter-dark mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Groups 2022
                                <div class="about">By <a href="https://github.com/doguedogue">doguedogue</a></div>
                            </div>
                            <div>
                                <a href="privacypolicy.html">Privacy Policy</a>                          
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script type="module">
            import { request } from "https://cdn.skypack.dev/@octokit/request";

            // $(document).ready(function () {
            //     document.getElementById('div_resultados').style.display = 'none';
            // });

            var nuevo = 0;
            var existe = 0;
            var error = 0;
            var otros = 0;

            $('#importar').click(function () {

                const import_select = $.trim($('#import_select option:selected').val());
                let cantidad = $.trim($('#cantidad option:selected').val());
                const page = $.trim($('#page').val());

                console.log("Page: "+page+ " Cantidad: "+cantidad);
                
                let pregunta = "";
                if (page!= null && page.length>0){
                    pregunta = "la página " + page + " de "+ import_select;
                }else{
                    pregunta = cantidad +" página(s) de "+ import_select;
                }             

                Swal.fire({
                    title: "Seguro que desea importar?",
                    text:  pregunta,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Importar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let texto = "";
                        if (page!= null && page.length>0){                            
                            texto = "<b>Páginas para procesar: 1</b>";
                            texto += "<br><b>Se procesa solo la página " + page + "</b>";
                            cantidad = 1;
                        }else{
                            texto = "<b>Páginas para procesar: </b> " + cantidad;
                        }   
                        $("#message").html(
                            "<b>Importar: </b> " + import_select + "<br>" + texto
                        );

                        nuevo = 0;
                        existe = 0;
                        error = 0;
                        otros = 0;

                        //Show Messages
                        document.getElementById('div_resultados').style.display = 'block';

                        if (import_select === "Followers"){
                            importUsuarios(1,0,"followers", page, cantidad);
                        }else if (import_select === "Following"){
                            importUsuarios(0,1,"following", page, cantidad);
                        }                        
                    }
                });

            });

            async function importUsuarios(_follower, _following, api, page, cantidad){
                const  outputDiv = document.getElementById("message");
                outputDiv.innerHTML += "<br>Leyendo...";
        
                let usuarios_array = new Array();
                let current_page = (page!= null && page.length > 0)? page : 1;
                const MAX_NUMBER_OF_IMPORTS_PAGES = cantidad;

                do {
                    const result = await request("GET /user/"+api, {
                        headers: {
                            authorization: "token <?php echo getenv('groups_token'); ?>",
                        },
                        page: current_page,           
                    });
            
                    var data = result.data;                    
                    // let i=1;
                    for (let key in data) {
                        const username = JSON.stringify(data[key].login).replaceAll('"','');
                        
                        let salida = "";
                        // if (i<=18){
                        getUser(username, _follower, _following);                           
                        // }
                        // i++;
                        usuarios_array.push(username);
                    }
                    
                    if (current_page % 10 == 0 ){
                        console.log("Current page: " + current_page + " Datos: "+ data.length);
                    }
                    current_page ++;

                } while(data.length > 0 && current_page <= MAX_NUMBER_OF_IMPORTS_PAGES);

                // let usuarios_html = "";
                // for (let i in usuarios_array) {                
                //     usuarios_html += usuarios_array[i] + "<br>"
                // }

                outputDiv.innerHTML += '<br>Número de '+ (api[0].toUpperCase() + api.substring(1)) +': '+usuarios_array.length + "<br>" +
                                        ((page!=null && page.length>0)?"Página: "+page: "") + 
                                        " Cantidad: "+cantidad;
                
                //await
                // "<hr>"+ 
                // "<br>Errores: "+ error +
                // "<br>Nuevos: "+ nuevo +
                // "<br>Existen: "+ existe +
                // "<br>Otros: "+ otros;
            }

            async function getUser(username, _follower, _following){
                const  outputDiv = document.getElementById("message");
                // console.log("getUser("+username+")");

                const result = await request("GET /users/{username}", {
                    headers: {
                        authorization: "token <?php echo getenv('groups_token'); ?>",
                    },
                    username,           
                });

                var data = result.data;
                // console.log("Data: " + JSON.stringify(data));
                
                const id = "";
                const login = JSON.stringify(data.login).replaceAll('"','');
                const name = JSON.stringify(data.name).replaceAll('"','');
                const email = JSON.stringify(data.email).replaceAll('"','');
                const avatar_url = JSON.stringify(data.avatar_url).replaceAll('"','');
                const company = JSON.stringify(data.company).replaceAll('"','');
                const blog = JSON.stringify(data.blog).replaceAll('"','');
                const location = JSON.stringify(data.location).replaceAll('"','');
                const bio = JSON.stringify(data.bio).replaceAll('"','');
                const twitter_username = JSON.stringify(data.twitter_username).replaceAll('"','');
                const follower = _follower;
                const following = _following;

                $.ajax({
                    url: "./bd/usuarios_import.php",
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
                        console.log("out php: " + data);                        
                        if(data == "null" || data.includes("Error")) {
                            outputDiv.innerHTML += "<br>"+ login + " (Error)";
                            error++;
                        } else if(data == "null" || data.includes("Nuevo")) {
                            outputDiv.innerHTML += "<br>"+ login + " (Nuevo)";
                            nuevo++;
                        }else if(data == "null" || data.includes("Existe")) {
                            outputDiv.innerHTML += "<br>"+ login + " (Existente)";
                            existe++;
                        }else{
                            outputDiv.innerHTML += "<br>"+ login + " (Otro)";
                            otros++;
                        } 
                    }
                });                    

            }
            
            $('#test').click(function () {
                hola();
            });

            async function hola(){
                const  outputDiv = document.getElementById("msg_test");
                outputDiv.innerHTML += "<br>Leyendo...";

                const result = await request("GET /user", {
                    headers: {
                        authorization: "token <?php echo getenv('groups_token'); ?>",
                    },           
                });

                // console.log("Result, %s", JSON.stringify(result));
                outputDiv.innerHTML += '<br>Hola, '+ result.data.name + " ("+result.data.login+")<br>Prueba OK";
            }
        </script>       

        <!-- Bootstrap core JavaScript-->
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <!-- Core plugin JavaScript-->
        <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/importar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple.js"></script>        
        <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    </body>
</html>
