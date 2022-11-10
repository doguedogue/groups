<?php

include_once './bd/conexion.php';

$objconexion = new Conexion();
$conexion = $objconexion->Conectar();

$query_where = "WHERE true ";
if (isset($_GET["u"]) && preg_match("/^[0-9]+$/", $_GET["u"])){
    $int = intval($_GET['u']);
    $query_where = "WHERE id = ".$int." ";
}

$query_where_q = "and true ";
$op1 = "";
$op2 = "";
$op3 = "";
if (isset($_GET["q"])){
    switch($_GET["q"]){
        case "1":
            $query_where_q = "and true ";
            $op1 = "selected";
            break;
        case "2":
            $query_where_q = "and follower = 1 ";
            $op2 = "selected";
            break;
        case "3":
            $query_where_q = "and following = 1 ";
            $op3 = "selected";
            break;
        default:
            $query_where_q = "and true ";    
            $op1 = "selected";
    }
}else{
    $op1 = "selected";
}

$query = "SELECT id, login, name, avatar_url, ".
        "email, company, blog, location, bio, twitter_username, ".
        "follower, following ".
        "FROM USUARIO ".
        $query_where.
        $query_where_q.
        "ORDER BY name";
$resultado = $conexion->prepare($query);
$resultado->execute();

?>


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
                                <h2>Usuarios</h2>
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <select class="form-control combo-dark" name="search" id="search">
                                            <option value="1" <?php echo $op1; ?>>Todos</option>
                                            <option value="2" <?php echo $op2; ?>>Followers</option>
                                            <option value="3" <?php echo $op3; ?>>Following</option>
                                        </select>                                        
                                    </li>
                                    
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <button type="button" class="btn btn-primary mr-3" data-toggle='modal' 
                                            data-target='#createModal' data-id='' data-nombre='' data-icon=''>
                                            <span><i class='fas fa-plus'></i></span> Añadir Usuario</button>
                                    </li>                                    
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <button type="button" class="btn btn-warning mr-3" id="importar">
                                            <span><i class='fa-solid fa-right-to-bracket'></i></span>&nbsp;Importar</button>
                                    </li>                                    
                                </ol>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Username</th>
                                            <th>Nombre</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Username</th>
                                            <th>Nombre</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    <?php                                                                             
                                        while($data = $resultado->fetch(PDO::FETCH_ASSOC)){                                           
                                            print "<tr>";
                                            print "<td><img src='". $data['avatar_url'] ."' alt='avatar' width='40px' class='avatar'></td>";
                                            print "<td>". $data['login'] . "</td>";
                                            print "<td>". $data['name'] . "</td>";                 
                                            print "<td>".  
                                                    "<a href='#' data-toggle='modal' data-target='#deleteModal' data-id='".
                                                    $data['id']."' title='Borrar Usuario'><span><i class='fas fa-trash'></i></span></a>". 
                                                    "&nbsp;&nbsp;" . 
                                                    "<a href='#' data-toggle='modal' data-target='#createModal'".
                                                    "data-id='".$data['id']."' ".
                                                    "data-login='".$data['login']."' ".
                                                    "data-name='".$data['name']."' ".
                                                    "data-avatar_url='".$data['avatar_url']."' ".
                                                    "data-email='".$data['email']."' ".
                                                    "data-company='".$data['company']."' ".
                                                    "data-blog='".$data['blog']."' ".
                                                    "data-location='".$data['location']."' ".
                                                    "data-bio='".$data['bio']."' ".
                                                    "data-twitter_username='".$data['twitter_username']."' ".
                                                    "data-follower='".$data['follower']."' ".
                                                    "data-following='".$data['following']."' ".
                                                    "title='Editar Usuario'>".
                                                    "<span><i class='fas fa-edit'></i></span></a>" .
                                                  "</td>";
                                            print "</tr>";
                                        }                                            
                                    ?>
                                    </tbody>    
                                </table>
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

        <!-- Modal Delete -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelDelete"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <form id="formUsuariosEliminar">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelDelete"><span><i class='fas fa-trash'></i></span>&nbsp;Eliminar Usuario</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Seguro que desea eliminar el Usuario?</div>
                        <input type="text" class="form-control" id="id_borrar" hidden>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input  type="submit" class="btn btn-danger" value="Borrar">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Create/Update -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="modalLabelCreate" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-dark">
                    <form id="formUsuariosCrear">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelCreate">Nuevo Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" id="id_usuario_update" hidden>
                            <div class="form-group row mb-2">                                                            
                                <div class="col-sm-12 text-center">
                                    <img src="./assets/img/logo.png" alt="avatar" width="100px" class="avatar" id="img_avatar">
                                </div>
                            </div>
                            <div class="form-group row">                            
                                <label for="login" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="login" placeholder="Username" required>
                                </div>
                            </div>    
                            <div class="form-group row">                            
                                <label for="name" class="col-sm-3 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="name" placeholder="Nombre">
                                </div>
                            </div> 
                            <div class="form-group row">                            
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" placeholder="Email">
                                </div>
                            </div> 
                            <div class="form-group row">                            
                                <label for="avatar_url" class="col-sm-3 col-form-label">URL Imagen</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="avatar_url" placeholder="URL Imagen">
                                </div>
                            </div> 
                            <div class="form-group row">                            
                                <label for="company" class="col-sm-3 col-form-label">Compañia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="company" placeholder="Compañia">
                                </div>
                            </div> 
                            <div class="form-group row">                            
                                <label for="blog" class="col-sm-3 col-form-label">Página Web</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="blog" placeholder="Página Web">
                                </div>
                            </div>    
                            <div class="form-group row">                            
                                <label for="bio" class="col-sm-3 col-form-label">Descripción</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="bio" placeholder="Descripción">
                                </div>
                            </div>
                            <div class="form-group row">                            
                                <label for="location" class="col-sm-3 col-form-label">Ubicación</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="location" placeholder="Ubicación">
                                </div>
                            </div>
                            <div class="form-group row">                            
                                <label for="twitter_username" class="col-sm-3 col-form-label">Twitter</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="twitter_username" placeholder="Twitter">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <input class="form-check-input" type="checkbox" value="" id="follower">
                                </div>
                                <label class="col-sm-2 form-check-label" for="follower">Follower</label>
                                <div class="col-sm-1">
                                    <input class="form-check-input" type="checkbox" value="" id="following">
                                </div>
                                <label class="col-sm-2 form-check-label" for="following">Following</label>
                            </div>                           
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input  type="submit" class="btn btn-success" value="Crear" id="boton_crear">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
        <!-- Core plugin JavaScript-->
        <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/usuarios.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple.js"></script>        
        <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    </body>
</html>
