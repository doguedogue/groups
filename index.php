<?php

include_once './bd/conexion.php';

$objconexion = new Conexion();
$conexion = $objconexion->Conectar();

$query_where = "and true ";
$op1 = "";
$op2 = "";
$op3 = "";
if (isset($_GET["q"])){
    switch($_GET["q"]){
        case "1":
            $query_where = "and true ";
            $op1 = "selected";
            break;
        case "2":
            $query_where = "and u.follower = 1 ";
            $op2 = "selected";
            break;
        case "3":
            $query_where = "and u.following = 1 ";
            $op3 = "selected";
            break;
        default:
            $query_where = "and true ";    
            $op1 = "selected";
    }
}else{
    $op1 = "selected";
}


$query = "SELECT min(g.id) id_grupo, min(g.icon) icon, g.nombre, count(*) registros ".
        "FROM GRUPO_USUARIO gu, USUARIO u, GRUPO g ".
        "WHERE gu.id_grupo = g.id and ".
        "gu.id_usuario = u.id ".
        $query_where.
        "group by g.nombre ".
        "ORDER BY g.nombre";
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
                                <h2>Mis Grupos</h2>
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item  mr-2">
                                        <select class="form-control combo-dark" name="search" id="search">
                                            <option value="1" <?php echo $op1; ?>>Todos</option>
                                            <option value="2" <?php echo $op2; ?>>Followers</option>
                                            <option value="3" <?php echo $op3; ?>>Following</option>
                                        </select>                                        
                                    </li>
                                    &nbsp;
                                    <button type="button" class="btn btn-success mr-2" id="grupos">
                                    <span><i class='fas fa-people-group'></i></span>Grupos</button>
                                    &nbsp;
                                    <button type="button" class="btn btn-warning mr-2" id="usuarios">
                                    <span><i class='fas fa-user-group'></i></span>Usuarios</button>


                                    <!-- <li class="breadcrumb-item px-2"><a href="grupos.php">
                                        <i class="fas fa-folder-plus" style="color:green"></i>&nbsp;Grupos</a></li>
                                    <li class="breadcrumb-item px-2"><a href="usuarios.php">
                                        <i class="fas fa-people-group" style="color:yellow"></i>&nbsp;Usuarios</a></li> -->
                                </ol>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Icon</th>
                                            <th>Grupo</th>
                                            <th>Miembros</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Icon</th>
                                            <th>Grupo</th>
                                            <th>Miembros</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    <?php                                     
                                        while($data = $resultado->fetch(PDO::FETCH_ASSOC)){                                           
                                            print "<tr>";
                                            print "<td style='font-size:27px;'>". $data['icon'] . "</td>";
                                            print "<td>". $data['nombre'] . "</td>";
                                            print "<td><div class='badge badge-pill badge-outline-warning'>". $data['registros'] . "</div></td>";
                                            print "<td>".  
                                                  "<a class='about' href='grupos.php?g=".$data['id_grupo']."' title='ver'>👁️‍🗨️</a>";
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
        <script src="./vendor/jquery/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/misgrupos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple.js"></script>
    </body>
</html>
