<?php

include_once './bd/conexion.php';

$objconexion = new Conexion();
$conexion = $objconexion->Conectar();

$query_where = "";
if (isset($_GET["g"]) && preg_match("/^[0-9]+$/", $_GET["g"])){
    $int = intval($_GET['g']);
    $query_where = "WHERE id = ".$int." ";
}

$query = "SELECT id, nombre, icon ".
        "FROM grupo ".
        $query_where.
        "ORDER BY 2";
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
                                <h2>Grupos</h2>
                                <ol class="breadcrumb mb-1">
                                    <li class="breadcrumb-item  mr-2 mb-2">
                                        <button type="button" class="btn btn-primary mr-3" data-toggle='modal' 
                                            data-target='#createModal' data-id='' data-nombre='' data-icon=''>
                                            <span><i class='fas fa-plus'></i></span> Añadir Grupo</button>
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
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Grupo</th>
                                            <th>Icon</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Grupo</th>
                                            <th>Icon</th>
                                            <th>⚙️</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                    <?php                                     
                                        while($data = $resultado->fetch(PDO::FETCH_ASSOC)){                                           
                                            print "<tr>";
                                            print "<td>". $data['nombre'] . "</td>";
                                            print "<td style='font-size:27px;'>". $data['icon'] . "</td>";
                                            print "<td>".  
                                                    "<a href='#' data-toggle='modal' data-target='#deleteModal' data-id='".
                                                    $data['id']."' title='Borrar Grupo'><span><i class='fas fa-trash'></i></span></a>". 
                                                    "&nbsp;&nbsp;" . 
                                                    "<a href='#' data-toggle='modal' data-target='#createModal'".
                                                    "data-id='".$data['id']."' ".
                                                    "data-nombre='".$data['nombre']."' ".
                                                    "data-icon='".$data['icon']."' ".
                                                    "title='Editar Grupo'>".
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
                    <form id="formGruposEliminar">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelDelete"><span><i class='fas fa-trash'></i></span>&nbsp;Eliminar Grupo</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Seguro que desea eliminar el Grupo?</div>
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
                    <form id="formGruposCrear">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelCreate">Nuevo Grupo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" id="id_grupo_update" hidden>
                            <div class="form-group row">                            
                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
                                </div>
                            </div>    
                            <div class="form-group row mt-3">                            
                                <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-3">
                                    <select class="form-control" id="icon" required>
                                        <option value='&#8986;'  style='text-align:center;font-size: 27px'>&#8986;</option>
                                        <option value='&#8987;'  style='text-align:center;font-size: 27px'>&#8987;</option>
                                        <option value='&#9193;'  style='text-align:center;font-size: 27px'>&#9193;</option>
                                        <option value='&#9194;'  style='text-align:center;font-size: 27px'>&#9194;</option>
                                        <option value='&#9195;'  style='text-align:center;font-size: 27px'>&#9195;</option>
                                        <option value='&#9196;'  style='text-align:center;font-size: 27px'>&#9196;</option>
                                        <option value='&#9197;'  style='text-align:center;font-size: 27px'>&#9197;</option>
                                        <option value='&#9198;'  style='text-align:center;font-size: 27px'>&#9198;</option>
                                        <option value='&#9199;'  style='text-align:center;font-size: 27px'>&#9199;</option>
                                        <option value='&#9200;'  style='text-align:center;font-size: 27px'>&#9200;</option>
                                        <option value='&#9201;'  style='text-align:center;font-size: 27px'>&#9201;</option>
                                        <option value='&#9202;'  style='text-align:center;font-size: 27px'>&#9202;</option>
                                        <option value='&#9203;'  style='text-align:center;font-size: 27px'>&#9203;</option>
                                        <option value='&#9208;'  style='text-align:center;font-size: 27px'>&#9208;</option>
                                        <option value='&#9209;'  style='text-align:center;font-size: 27px'>&#9209;</option>
                                        <option value='&#9210;'  style='text-align:center;font-size: 27px'>&#9210;</option>
                                        <option value='&#9410;'  style='text-align:center;font-size: 27px'>&#9410;</option>
                                        <option value='&#9748;'  style='text-align:center;font-size: 27px'>&#9748;</option>
                                        <option value='&#9749;'  style='text-align:center;font-size: 27px'>&#9749;</option>
                                        <option value='&#9757;'  style='text-align:center;font-size: 27px'>&#9757;</option>
                                        <option value='&#9800;'  style='text-align:center;font-size: 27px'>&#9800;</option>
                                        <option value='&#9801;'  style='text-align:center;font-size: 27px'>&#9801;</option>
                                        <option value='&#9802;'  style='text-align:center;font-size: 27px'>&#9802;</option>
                                        <option value='&#9803;'  style='text-align:center;font-size: 27px'>&#9803;</option>
                                        <option value='&#9804;'  style='text-align:center;font-size: 27px'>&#9804;</option>
                                        <option value='&#9805;'  style='text-align:center;font-size: 27px'>&#9805;</option>
                                        <option value='&#9806;'  style='text-align:center;font-size: 27px'>&#9806;</option>
                                        <option value='&#9807;'  style='text-align:center;font-size: 27px'>&#9807;</option>
                                        <option value='&#9808;'  style='text-align:center;font-size: 27px'>&#9808;</option>
                                        <option value='&#9809;'  style='text-align:center;font-size: 27px'>&#9809;</option>
                                        <option value='&#9810;'  style='text-align:center;font-size: 27px'>&#9810;</option>
                                        <option value='&#9811;'  style='text-align:center;font-size: 27px'>&#9811;</option>
                                        <option value='&#9823;'  style='text-align:center;font-size: 27px'>&#9823;</option>
                                        <option value='&#9855;'  style='text-align:center;font-size: 27px'>&#9855;</option>
                                        <option value='&#9875;'  style='text-align:center;font-size: 27px'>&#9875;</option>
                                        <option value='&#9889;'  style='text-align:center;font-size: 27px'>&#9889;</option>
                                        <option value='&#9898;'  style='text-align:center;font-size: 27px'>&#9898;</option>
                                        <option value='&#9899;'  style='text-align:center;font-size: 27px'>&#9899;</option>
                                        <option value='&#9917;'  style='text-align:center;font-size: 27px'>&#9917;</option>
                                        <option value='&#9918;'  style='text-align:center;font-size: 27px'>&#9918;</option>
                                        <option value='&#9924;'  style='text-align:center;font-size: 27px'>&#9924;</option>
                                        <option value='&#9925;'  style='text-align:center;font-size: 27px'>&#9925;</option>
                                        <option value='&#9934;'  style='text-align:center;font-size: 27px'>&#9934;</option>
                                        <option value='&#9935;'  style='text-align:center;font-size: 27px'>&#9935;</option>
                                        <option value='&#9937;'  style='text-align:center;font-size: 27px'>&#9937;</option>
                                        <option value='&#9939;'  style='text-align:center;font-size: 27px'>&#9939;</option>
                                        <option value='&#9940;'  style='text-align:center;font-size: 27px'>&#9940;</option>
                                        <option value='&#9961;'  style='text-align:center;font-size: 27px'>&#9961;</option>
                                        <option value='&#9962;'  style='text-align:center;font-size: 27px'>&#9962;</option>
                                        <option value='&#9968;'  style='text-align:center;font-size: 27px'>&#9968;</option>
                                        <option value='&#9969;'  style='text-align:center;font-size: 27px'>&#9969;</option>
                                        <option value='&#9970;'  style='text-align:center;font-size: 27px'>&#9970;</option>
                                        <option value='&#9971;'  style='text-align:center;font-size: 27px'>&#9971;</option>
                                        <option value='&#9972;'  style='text-align:center;font-size: 27px'>&#9972;</option>
                                        <option value='&#9973;'  style='text-align:center;font-size: 27px'>&#9973;</option>
                                        <option value='&#9975;'  style='text-align:center;font-size: 27px'>&#9975;</option>
                                        <option value='&#9976;'  style='text-align:center;font-size: 27px'>&#9976;</option>
                                        <option value='&#9977;'  style='text-align:center;font-size: 27px'>&#9977;</option>
                                        <option value='&#9978;'  style='text-align:center;font-size: 27px'>&#9978;</option>
                                        <option value='&#9981;'  style='text-align:center;font-size: 27px'>&#9981;</option>
                                        <option value='&#9986;'  style='text-align:center;font-size: 27px'>&#9986;</option>
                                        <option value='&#9989;'  style='text-align:center;font-size: 27px'>&#9989;</option>
                                        <option value='&#9992;'  style='text-align:center;font-size: 27px'>&#9992;</option>
                                        <option value='&#9993;'  style='text-align:center;font-size: 27px'>&#9993;</option>
                                        <option value='&#9994;'  style='text-align:center;font-size: 27px'>&#9994;</option>
                                        <option value='&#9995;'  style='text-align:center;font-size: 27px'>&#9995;</option>
                                        <option value='&#9996;'  style='text-align:center;font-size: 27px'>&#9996;</option>
                                        <option value='&#9997;'  style='text-align:center;font-size: 27px'>&#9997;</option>
                                        <option value='&#9999;'  style='text-align:center;font-size: 27px'>&#9999;</option>
                                        <option value='&#10002;'  style='text-align:center;font-size: 27px'>&#10002;</option>
                                        <option value='&#10004;'  style='text-align:center;font-size: 27px'>&#10004;</option>
                                        <option value='&#10006;'  style='text-align:center;font-size: 27px'>&#10006;</option>
                                        <option value='&#10013;'  style='text-align:center;font-size: 27px'>&#10013;</option>
                                        <option value='&#10017;'  style='text-align:center;font-size: 27px'>&#10017;</option>
                                        <option value='&#10024;'  style='text-align:center;font-size: 27px'>&#10024;</option>
                                        <option value='&#10035;'  style='text-align:center;font-size: 27px'>&#10035;</option>
                                        <option value='&#10036;'  style='text-align:center;font-size: 27px'>&#10036;</option>
                                        <option value='&#10052;'  style='text-align:center;font-size: 27px'>&#10052;</option>
                                        <option value='&#10055;'  style='text-align:center;font-size: 27px'>&#10055;</option>
                                        <option value='&#10060;'  style='text-align:center;font-size: 27px'>&#10060;</option>
                                        <option value='&#10062;'  style='text-align:center;font-size: 27px'>&#10062;</option>
                                        <option value='&#10067;'  style='text-align:center;font-size: 27px'>&#10067;</option>
                                        <option value='&#10068;'  style='text-align:center;font-size: 27px'>&#10068;</option>
                                        <option value='&#10069;'  style='text-align:center;font-size: 27px'>&#10069;</option>
                                        <option value='&#10071;'  style='text-align:center;font-size: 27px'>&#10071;</option>
                                        <option value='&#10083;'  style='text-align:center;font-size: 27px'>&#10083;</option>
                                        <option value='&#10084;'  style='text-align:center;font-size: 27px'>&#10084;</option>
                                        <option value='&#10133;'  style='text-align:center;font-size: 27px'>&#10133;</option>
                                        <option value='&#10134;'  style='text-align:center;font-size: 27px'>&#10134;</option>
                                        <option value='&#10135;'  style='text-align:center;font-size: 27px'>&#10135;</option>
                                        <option value='&#10145;'  style='text-align:center;font-size: 27px'>&#10145;</option>
                                        <option value='&#10160;'  style='text-align:center;font-size: 27px'>&#10160;</option>
                                        <option value='&#10175;'  style='text-align:center;font-size: 27px'>&#10175;</option>
                                        <option value='&#10548;'  style='text-align:center;font-size: 27px'>&#10548;</option>
                                        <option value='&#10549;'  style='text-align:center;font-size: 27px'>&#10549;</option>
                                        <option value='&#11013;'  style='text-align:center;font-size: 27px'>&#11013;</option>
                                        <option value='&#11014;'  style='text-align:center;font-size: 27px'>&#11014;</option>
                                        <option value='&#11015;'  style='text-align:center;font-size: 27px'>&#11015;</option>
                                        <option value='&#11035;'  style='text-align:center;font-size: 27px'>&#11035;</option>
                                        <option value='&#11036;'  style='text-align:center;font-size: 27px'>&#11036;</option>
                                        <option value='&#11088;'  style='text-align:center;font-size: 27px'>&#11088;</option>
                                        <option value='&#11093;'  style='text-align:center;font-size: 27px'>&#11093;</option>
                                        <option value='&#12336;'  style='text-align:center;font-size: 27px'>&#12336;</option>
                                        <option value='&#12349;'  style='text-align:center;font-size: 27px'>&#12349;</option>
                                        <option value='&#12951;'  style='text-align:center;font-size: 27px'>&#12951;</option>
                                        <option value='&#12953;'  style='text-align:center;font-size: 27px'>&#12953;</option>
                                        <option value='&#126980;'  style='text-align:center;font-size: 27px'>&#126980;</option>
                                        <option value='&#127183;'  style='text-align:center;font-size: 27px'>&#127183;</option>
                                        <option value='&#127344;'  style='text-align:center;font-size: 27px'>&#127344;</option>
                                        <option value='&#127345;'  style='text-align:center;font-size: 27px'>&#127345;</option>
                                        <option value='&#127358;'  style='text-align:center;font-size: 27px'>&#127358;</option>
                                        <option value='&#127359;'  style='text-align:center;font-size: 27px'>&#127359;</option>
                                        <option value='&#127374;'  style='text-align:center;font-size: 27px'>&#127374;</option>
                                        <option value='&#127377;'  style='text-align:center;font-size: 27px'>&#127377;</option>
                                        <option value='&#127378;'  style='text-align:center;font-size: 27px'>&#127378;</option>
                                        <option value='&#127379;'  style='text-align:center;font-size: 27px'>&#127379;</option>
                                        <option value='&#127380;'  style='text-align:center;font-size: 27px'>&#127380;</option>
                                        <option value='&#127381;'  style='text-align:center;font-size: 27px'>&#127381;</option>
                                        <option value='&#127382;'  style='text-align:center;font-size: 27px'>&#127382;</option>
                                        <option value='&#127383;'  style='text-align:center;font-size: 27px'>&#127383;</option>
                                        <option value='&#127384;'  style='text-align:center;font-size: 27px'>&#127384;</option>
                                        <option value='&#127385;'  style='text-align:center;font-size: 27px'>&#127385;</option>
                                        <option value='&#127386;'  style='text-align:center;font-size: 27px'>&#127386;</option>
                                        <option value='&#127489;'  style='text-align:center;font-size: 27px'>&#127489;</option>
                                        <option value='&#127490;'  style='text-align:center;font-size: 27px'>&#127490;</option>
                                        <option value='&#127514;'  style='text-align:center;font-size: 27px'>&#127514;</option>
                                        <option value='&#127535;'  style='text-align:center;font-size: 27px'>&#127535;</option>
                                        <option value='&#127538;'  style='text-align:center;font-size: 27px'>&#127538;</option>
                                        <option value='&#127539;'  style='text-align:center;font-size: 27px'>&#127539;</option>
                                        <option value='&#127540;'  style='text-align:center;font-size: 27px'>&#127540;</option>
                                        <option value='&#127541;'  style='text-align:center;font-size: 27px'>&#127541;</option>
                                        <option value='&#127542;'  style='text-align:center;font-size: 27px'>&#127542;</option>
                                        <option value='&#127543;'  style='text-align:center;font-size: 27px'>&#127543;</option>
                                        <option value='&#127544;'  style='text-align:center;font-size: 27px'>&#127544;</option>
                                        <option value='&#127545;'  style='text-align:center;font-size: 27px'>&#127545;</option>
                                        <option value='&#127546;'  style='text-align:center;font-size: 27px'>&#127546;</option>
                                        <option value='&#127568;'  style='text-align:center;font-size: 27px'>&#127568;</option>
                                        <option value='&#127569;'  style='text-align:center;font-size: 27px'>&#127569;</option>
                                        <option value='&#127744;'  style='text-align:center;font-size: 27px'>&#127744;</option>
                                        <option value='&#127745;'  style='text-align:center;font-size: 27px'>&#127745;</option>
                                        <option value='&#127746;'  style='text-align:center;font-size: 27px'>&#127746;</option>
                                        <option value='&#127747;'  style='text-align:center;font-size: 27px'>&#127747;</option>
                                        <option value='&#127748;'  style='text-align:center;font-size: 27px'>&#127748;</option>
                                        <option value='&#127749;'  style='text-align:center;font-size: 27px'>&#127749;</option>
                                        <option value='&#127750;'  style='text-align:center;font-size: 27px'>&#127750;</option>
                                        <option value='&#127751;'  style='text-align:center;font-size: 27px'>&#127751;</option>
                                        <option value='&#127752;'  style='text-align:center;font-size: 27px'>&#127752;</option>
                                        <option value='&#127753;'  style='text-align:center;font-size: 27px'>&#127753;</option>
                                        <option value='&#127754;'  style='text-align:center;font-size: 27px'>&#127754;</option>
                                        <option value='&#127755;'  style='text-align:center;font-size: 27px'>&#127755;</option>
                                        <option value='&#127756;'  style='text-align:center;font-size: 27px'>&#127756;</option>
                                        <option value='&#127757;'  style='text-align:center;font-size: 27px'>&#127757;</option>
                                        <option value='&#127758;'  style='text-align:center;font-size: 27px'>&#127758;</option>
                                        <option value='&#127759;'  style='text-align:center;font-size: 27px'>&#127759;</option>
                                        <option value='&#127760;'  style='text-align:center;font-size: 27px'>&#127760;</option>
                                        <option value='&#127761;'  style='text-align:center;font-size: 27px'>&#127761;</option>
                                        <option value='&#127762;'  style='text-align:center;font-size: 27px'>&#127762;</option>
                                        <option value='&#127763;'  style='text-align:center;font-size: 27px'>&#127763;</option>
                                        <option value='&#127764;'  style='text-align:center;font-size: 27px'>&#127764;</option>
                                        <option value='&#127765;'  style='text-align:center;font-size: 27px'>&#127765;</option>
                                        <option value='&#127766;'  style='text-align:center;font-size: 27px'>&#127766;</option>
                                        <option value='&#127767;'  style='text-align:center;font-size: 27px'>&#127767;</option>
                                        <option value='&#127768;'  style='text-align:center;font-size: 27px'>&#127768;</option>
                                        <option value='&#127769;'  style='text-align:center;font-size: 27px'>&#127769;</option>
                                        <option value='&#127770;'  style='text-align:center;font-size: 27px'>&#127770;</option>
                                        <option value='&#127771;'  style='text-align:center;font-size: 27px'>&#127771;</option>
                                        <option value='&#127772;'  style='text-align:center;font-size: 27px'>&#127772;</option>
                                        <option value='&#127773;'  style='text-align:center;font-size: 27px'>&#127773;</option>
                                        <option value='&#127774;'  style='text-align:center;font-size: 27px'>&#127774;</option>
                                        <option value='&#127775;'  style='text-align:center;font-size: 27px'>&#127775;</option>
                                        <option value='&#127776;'  style='text-align:center;font-size: 27px'>&#127776;</option>
                                        <option value='&#127777;'  style='text-align:center;font-size: 27px'>&#127777;</option>
                                        <option value='&#127780;'  style='text-align:center;font-size: 27px'>&#127780;</option>
                                        <option value='&#127781;'  style='text-align:center;font-size: 27px'>&#127781;</option>
                                        <option value='&#127782;'  style='text-align:center;font-size: 27px'>&#127782;</option>
                                        <option value='&#127783;'  style='text-align:center;font-size: 27px'>&#127783;</option>
                                        <option value='&#127784;'  style='text-align:center;font-size: 27px'>&#127784;</option>
                                        <option value='&#127785;'  style='text-align:center;font-size: 27px'>&#127785;</option>
                                        <option value='&#127786;'  style='text-align:center;font-size: 27px'>&#127786;</option>
                                        <option value='&#127787;'  style='text-align:center;font-size: 27px'>&#127787;</option>
                                        <option value='&#127788;'  style='text-align:center;font-size: 27px'>&#127788;</option>
                                        <option value='&#127789;'  style='text-align:center;font-size: 27px'>&#127789;</option>
                                        <option value='&#127790;'  style='text-align:center;font-size: 27px'>&#127790;</option>
                                        <option value='&#127791;'  style='text-align:center;font-size: 27px'>&#127791;</option>
                                        <option value='&#127792;'  style='text-align:center;font-size: 27px'>&#127792;</option>
                                        <option value='&#127793;'  style='text-align:center;font-size: 27px'>&#127793;</option>
                                        <option value='&#127794;'  style='text-align:center;font-size: 27px'>&#127794;</option>
                                        <option value='&#127795;'  style='text-align:center;font-size: 27px'>&#127795;</option>
                                        <option value='&#127796;'  style='text-align:center;font-size: 27px'>&#127796;</option>
                                        <option value='&#127797;'  style='text-align:center;font-size: 27px'>&#127797;</option>
                                        <option value='&#127798;'  style='text-align:center;font-size: 27px'>&#127798;</option>
                                        <option value='&#127799;'  style='text-align:center;font-size: 27px'>&#127799;</option>
                                        <option value='&#127800;'  style='text-align:center;font-size: 27px'>&#127800;</option>
                                        <option value='&#127801;'  style='text-align:center;font-size: 27px'>&#127801;</option>
                                        <option value='&#127802;'  style='text-align:center;font-size: 27px'>&#127802;</option>
                                        <option value='&#127803;'  style='text-align:center;font-size: 27px'>&#127803;</option>
                                        <option value='&#127804;'  style='text-align:center;font-size: 27px'>&#127804;</option>
                                        <option value='&#127805;'  style='text-align:center;font-size: 27px'>&#127805;</option>
                                        <option value='&#127806;'  style='text-align:center;font-size: 27px'>&#127806;</option>
                                        <option value='&#127807;'  style='text-align:center;font-size: 27px'>&#127807;</option>
                                        <option value='&#127808;'  style='text-align:center;font-size: 27px'>&#127808;</option>
                                        <option value='&#127809;'  style='text-align:center;font-size: 27px'>&#127809;</option>
                                        <option value='&#127810;'  style='text-align:center;font-size: 27px'>&#127810;</option>
                                        <option value='&#127811;'  style='text-align:center;font-size: 27px'>&#127811;</option>
                                        <option value='&#127812;'  style='text-align:center;font-size: 27px'>&#127812;</option>
                                        <option value='&#127813;'  style='text-align:center;font-size: 27px'>&#127813;</option>
                                        <option value='&#127814;'  style='text-align:center;font-size: 27px'>&#127814;</option>
                                        <option value='&#127815;'  style='text-align:center;font-size: 27px'>&#127815;</option>
                                        <option value='&#127816;'  style='text-align:center;font-size: 27px'>&#127816;</option>
                                        <option value='&#127817;'  style='text-align:center;font-size: 27px'>&#127817;</option>
                                        <option value='&#127818;'  style='text-align:center;font-size: 27px'>&#127818;</option>
                                        <option value='&#127819;'  style='text-align:center;font-size: 27px'>&#127819;</option>
                                        <option value='&#127820;'  style='text-align:center;font-size: 27px'>&#127820;</option>
                                        <option value='&#127821;'  style='text-align:center;font-size: 27px'>&#127821;</option>
                                        <option value='&#127822;'  style='text-align:center;font-size: 27px'>&#127822;</option>
                                        <option value='&#127823;'  style='text-align:center;font-size: 27px'>&#127823;</option>
                                        <option value='&#127824;'  style='text-align:center;font-size: 27px'>&#127824;</option>
                                        <option value='&#127825;'  style='text-align:center;font-size: 27px'>&#127825;</option>
                                        <option value='&#127826;'  style='text-align:center;font-size: 27px'>&#127826;</option>
                                        <option value='&#127827;'  style='text-align:center;font-size: 27px'>&#127827;</option>
                                        <option value='&#127828;'  style='text-align:center;font-size: 27px'>&#127828;</option>
                                        <option value='&#127829;'  style='text-align:center;font-size: 27px'>&#127829;</option>
                                        <option value='&#127830;'  style='text-align:center;font-size: 27px'>&#127830;</option>
                                        <option value='&#127831;'  style='text-align:center;font-size: 27px'>&#127831;</option>
                                        <option value='&#127832;'  style='text-align:center;font-size: 27px'>&#127832;</option>
                                        <option value='&#127833;'  style='text-align:center;font-size: 27px'>&#127833;</option>
                                        <option value='&#127834;'  style='text-align:center;font-size: 27px'>&#127834;</option>
                                        <option value='&#127835;'  style='text-align:center;font-size: 27px'>&#127835;</option>
                                        <option value='&#127836;'  style='text-align:center;font-size: 27px'>&#127836;</option>
                                        <option value='&#127837;'  style='text-align:center;font-size: 27px'>&#127837;</option>
                                        <option value='&#127838;'  style='text-align:center;font-size: 27px'>&#127838;</option>
                                        <option value='&#127839;'  style='text-align:center;font-size: 27px'>&#127839;</option>
                                        <option value='&#127840;'  style='text-align:center;font-size: 27px'>&#127840;</option>
                                        <option value='&#127841;'  style='text-align:center;font-size: 27px'>&#127841;</option>
                                        <option value='&#127842;'  style='text-align:center;font-size: 27px'>&#127842;</option>
                                        <option value='&#127843;'  style='text-align:center;font-size: 27px'>&#127843;</option>
                                        <option value='&#127844;'  style='text-align:center;font-size: 27px'>&#127844;</option>
                                        <option value='&#127845;'  style='text-align:center;font-size: 27px'>&#127845;</option>
                                        <option value='&#127846;'  style='text-align:center;font-size: 27px'>&#127846;</option>
                                        <option value='&#127847;'  style='text-align:center;font-size: 27px'>&#127847;</option>
                                        <option value='&#127848;'  style='text-align:center;font-size: 27px'>&#127848;</option>
                                        <option value='&#127849;'  style='text-align:center;font-size: 27px'>&#127849;</option>
                                        <option value='&#127850;'  style='text-align:center;font-size: 27px'>&#127850;</option>
                                        <option value='&#127851;'  style='text-align:center;font-size: 27px'>&#127851;</option>
                                        <option value='&#127852;'  style='text-align:center;font-size: 27px'>&#127852;</option>
                                        <option value='&#127853;'  style='text-align:center;font-size: 27px'>&#127853;</option>
                                        <option value='&#127854;'  style='text-align:center;font-size: 27px'>&#127854;</option>
                                        <option value='&#127855;'  style='text-align:center;font-size: 27px'>&#127855;</option>
                                        <option value='&#127856;'  style='text-align:center;font-size: 27px'>&#127856;</option>
                                        <option value='&#127857;'  style='text-align:center;font-size: 27px'>&#127857;</option>
                                        <option value='&#127858;'  style='text-align:center;font-size: 27px'>&#127858;</option>
                                        <option value='&#127859;'  style='text-align:center;font-size: 27px'>&#127859;</option>
                                        <option value='&#127860;'  style='text-align:center;font-size: 27px'>&#127860;</option>
                                        <option value='&#127861;'  style='text-align:center;font-size: 27px'>&#127861;</option>
                                        <option value='&#127862;'  style='text-align:center;font-size: 27px'>&#127862;</option>
                                        <option value='&#127863;'  style='text-align:center;font-size: 27px'>&#127863;</option>
                                        <option value='&#127864;'  style='text-align:center;font-size: 27px'>&#127864;</option>
                                        <option value='&#127865;'  style='text-align:center;font-size: 27px'>&#127865;</option>
                                        <option value='&#127866;'  style='text-align:center;font-size: 27px'>&#127866;</option>
                                        <option value='&#127867;'  style='text-align:center;font-size: 27px'>&#127867;</option>
                                        <option value='&#127868;'  style='text-align:center;font-size: 27px'>&#127868;</option>
                                        <option value='&#127869;'  style='text-align:center;font-size: 27px'>&#127869;</option>
                                        <option value='&#127870;'  style='text-align:center;font-size: 27px'>&#127870;</option>
                                        <option value='&#127871;'  style='text-align:center;font-size: 27px'>&#127871;</option>
                                        <option value='&#127872;'  style='text-align:center;font-size: 27px'>&#127872;</option>
                                        <option value='&#127873;'  style='text-align:center;font-size: 27px'>&#127873;</option>
                                        <option value='&#127874;'  style='text-align:center;font-size: 27px'>&#127874;</option>
                                        <option value='&#127875;'  style='text-align:center;font-size: 27px'>&#127875;</option>
                                        <option value='&#127876;'  style='text-align:center;font-size: 27px'>&#127876;</option>
                                        <option value='&#127877;'  style='text-align:center;font-size: 27px'>&#127877;</option>
                                        <option value='&#127878;'  style='text-align:center;font-size: 27px'>&#127878;</option>
                                        <option value='&#127879;'  style='text-align:center;font-size: 27px'>&#127879;</option>
                                        <option value='&#127880;'  style='text-align:center;font-size: 27px'>&#127880;</option>
                                        <option value='&#127881;'  style='text-align:center;font-size: 27px'>&#127881;</option>
                                        <option value='&#127882;'  style='text-align:center;font-size: 27px'>&#127882;</option>
                                        <option value='&#127883;'  style='text-align:center;font-size: 27px'>&#127883;</option>
                                        <option value='&#127884;'  style='text-align:center;font-size: 27px'>&#127884;</option>
                                        <option value='&#127885;'  style='text-align:center;font-size: 27px'>&#127885;</option>
                                        <option value='&#127886;'  style='text-align:center;font-size: 27px'>&#127886;</option>
                                        <option value='&#127887;'  style='text-align:center;font-size: 27px'>&#127887;</option>
                                        <option value='&#127888;'  style='text-align:center;font-size: 27px'>&#127888;</option>
                                        <option value='&#127889;'  style='text-align:center;font-size: 27px'>&#127889;</option>
                                        <option value='&#127890;'  style='text-align:center;font-size: 27px'>&#127890;</option>
                                        <option value='&#127891;'  style='text-align:center;font-size: 27px'>&#127891;</option>
                                        <option value='&#127894;'  style='text-align:center;font-size: 27px'>&#127894;</option>
                                        <option value='&#127895;'  style='text-align:center;font-size: 27px'>&#127895;</option>
                                        <option value='&#127897;'  style='text-align:center;font-size: 27px'>&#127897;</option>
                                        <option value='&#127898;'  style='text-align:center;font-size: 27px'>&#127898;</option>
                                        <option value='&#127899;'  style='text-align:center;font-size: 27px'>&#127899;</option>
                                        <option value='&#127902;'  style='text-align:center;font-size: 27px'>&#127902;</option>
                                        <option value='&#127903;'  style='text-align:center;font-size: 27px'>&#127903;</option>
                                        <option value='&#127904;'  style='text-align:center;font-size: 27px'>&#127904;</option>
                                        <option value='&#127905;'  style='text-align:center;font-size: 27px'>&#127905;</option>
                                        <option value='&#127906;'  style='text-align:center;font-size: 27px'>&#127906;</option>
                                        <option value='&#127907;'  style='text-align:center;font-size: 27px'>&#127907;</option>
                                        <option value='&#127908;'  style='text-align:center;font-size: 27px'>&#127908;</option>
                                        <option value='&#127909;'  style='text-align:center;font-size: 27px'>&#127909;</option>
                                        <option value='&#127910;'  style='text-align:center;font-size: 27px'>&#127910;</option>
                                        <option value='&#127911;'  style='text-align:center;font-size: 27px'>&#127911;</option>
                                        <option value='&#127912;'  style='text-align:center;font-size: 27px'>&#127912;</option>
                                        <option value='&#127913;'  style='text-align:center;font-size: 27px'>&#127913;</option>
                                        <option value='&#127914;'  style='text-align:center;font-size: 27px'>&#127914;</option>
                                        <option value='&#127915;'  style='text-align:center;font-size: 27px'>&#127915;</option>
                                        <option value='&#127916;'  style='text-align:center;font-size: 27px'>&#127916;</option>
                                        <option value='&#127917;'  style='text-align:center;font-size: 27px'>&#127917;</option>
                                        <option value='&#127918;'  style='text-align:center;font-size: 27px'>&#127918;</option>
                                        <option value='&#127919;'  style='text-align:center;font-size: 27px'>&#127919;</option>
                                        <option value='&#127920;'  style='text-align:center;font-size: 27px'>&#127920;</option>
                                        <option value='&#127921;'  style='text-align:center;font-size: 27px'>&#127921;</option>
                                        <option value='&#127922;'  style='text-align:center;font-size: 27px'>&#127922;</option>
                                        <option value='&#127923;'  style='text-align:center;font-size: 27px'>&#127923;</option>
                                        <option value='&#127924;'  style='text-align:center;font-size: 27px'>&#127924;</option>
                                        <option value='&#127925;'  style='text-align:center;font-size: 27px'>&#127925;</option>
                                        <option value='&#127926;'  style='text-align:center;font-size: 27px'>&#127926;</option>
                                        <option value='&#127927;'  style='text-align:center;font-size: 27px'>&#127927;</option>
                                        <option value='&#127928;'  style='text-align:center;font-size: 27px'>&#127928;</option>
                                        <option value='&#127929;'  style='text-align:center;font-size: 27px'>&#127929;</option>
                                        <option value='&#127930;'  style='text-align:center;font-size: 27px'>&#127930;</option>
                                        <option value='&#127931;'  style='text-align:center;font-size: 27px'>&#127931;</option>
                                        <option value='&#127932;'  style='text-align:center;font-size: 27px'>&#127932;</option>
                                        <option value='&#127933;'  style='text-align:center;font-size: 27px'>&#127933;</option>
                                        <option value='&#127934;'  style='text-align:center;font-size: 27px'>&#127934;</option>
                                        <option value='&#127935;'  style='text-align:center;font-size: 27px'>&#127935;</option>
                                        <option value='&#127936;'  style='text-align:center;font-size: 27px'>&#127936;</option>
                                        <option value='&#127937;'  style='text-align:center;font-size: 27px'>&#127937;</option>
                                        <option value='&#127938;'  style='text-align:center;font-size: 27px'>&#127938;</option>
                                        <option value='&#127939;'  style='text-align:center;font-size: 27px'>&#127939;</option>
                                        <option value='&#127940;'  style='text-align:center;font-size: 27px'>&#127940;</option>
                                        <option value='&#127941;'  style='text-align:center;font-size: 27px'>&#127941;</option>
                                        <option value='&#127942;'  style='text-align:center;font-size: 27px'>&#127942;</option>
                                        <option value='&#127943;'  style='text-align:center;font-size: 27px'>&#127943;</option>
                                        <option value='&#127944;'  style='text-align:center;font-size: 27px'>&#127944;</option>
                                        <option value='&#127945;'  style='text-align:center;font-size: 27px'>&#127945;</option>
                                        <option value='&#127946;'  style='text-align:center;font-size: 27px'>&#127946;</option>
                                        <option value='&#127947;'  style='text-align:center;font-size: 27px'>&#127947;</option>
                                        <option value='&#127948;'  style='text-align:center;font-size: 27px'>&#127948;</option>
                                        <option value='&#127949;'  style='text-align:center;font-size: 27px'>&#127949;</option>
                                        <option value='&#127950;'  style='text-align:center;font-size: 27px'>&#127950;</option>
                                        <option value='&#127951;'  style='text-align:center;font-size: 27px'>&#127951;</option>
                                        <option value='&#127952;'  style='text-align:center;font-size: 27px'>&#127952;</option>
                                        <option value='&#127953;'  style='text-align:center;font-size: 27px'>&#127953;</option>
                                        <option value='&#127954;'  style='text-align:center;font-size: 27px'>&#127954;</option>
                                        <option value='&#127955;'  style='text-align:center;font-size: 27px'>&#127955;</option>
                                        <option value='&#127956;'  style='text-align:center;font-size: 27px'>&#127956;</option>
                                        <option value='&#127957;'  style='text-align:center;font-size: 27px'>&#127957;</option>
                                        <option value='&#127958;'  style='text-align:center;font-size: 27px'>&#127958;</option>
                                        <option value='&#127959;'  style='text-align:center;font-size: 27px'>&#127959;</option>
                                        <option value='&#127960;'  style='text-align:center;font-size: 27px'>&#127960;</option>
                                        <option value='&#127961;'  style='text-align:center;font-size: 27px'>&#127961;</option>
                                        <option value='&#127962;'  style='text-align:center;font-size: 27px'>&#127962;</option>
                                        <option value='&#127963;'  style='text-align:center;font-size: 27px'>&#127963;</option>
                                        <option value='&#127964;'  style='text-align:center;font-size: 27px'>&#127964;</option>
                                        <option value='&#127965;'  style='text-align:center;font-size: 27px'>&#127965;</option>
                                        <option value='&#127966;'  style='text-align:center;font-size: 27px'>&#127966;</option>
                                        <option value='&#127967;'  style='text-align:center;font-size: 27px'>&#127967;</option>
                                        <option value='&#127968;'  style='text-align:center;font-size: 27px'>&#127968;</option>
                                        <option value='&#127969;'  style='text-align:center;font-size: 27px'>&#127969;</option>
                                        <option value='&#127970;'  style='text-align:center;font-size: 27px'>&#127970;</option>
                                        <option value='&#127971;'  style='text-align:center;font-size: 27px'>&#127971;</option>
                                        <option value='&#127972;'  style='text-align:center;font-size: 27px'>&#127972;</option>
                                        <option value='&#127973;'  style='text-align:center;font-size: 27px'>&#127973;</option>
                                        <option value='&#127974;'  style='text-align:center;font-size: 27px'>&#127974;</option>
                                        <option value='&#127975;'  style='text-align:center;font-size: 27px'>&#127975;</option>
                                        <option value='&#127976;'  style='text-align:center;font-size: 27px'>&#127976;</option>
                                        <option value='&#127977;'  style='text-align:center;font-size: 27px'>&#127977;</option>
                                        <option value='&#127978;'  style='text-align:center;font-size: 27px'>&#127978;</option>
                                        <option value='&#127979;'  style='text-align:center;font-size: 27px'>&#127979;</option>
                                        <option value='&#127980;'  style='text-align:center;font-size: 27px'>&#127980;</option>
                                        <option value='&#127981;'  style='text-align:center;font-size: 27px'>&#127981;</option>
                                        <option value='&#127982;'  style='text-align:center;font-size: 27px'>&#127982;</option>
                                        <option value='&#127983;'  style='text-align:center;font-size: 27px'>&#127983;</option>
                                        <option value='&#127984;'  style='text-align:center;font-size: 27px'>&#127984;</option>
                                        <option value='&#127987;'  style='text-align:center;font-size: 27px'>&#127987;</option>
                                        <option value='&#127988;'  style='text-align:center;font-size: 27px'>&#127988;</option>
                                        <option value='&#127989;'  style='text-align:center;font-size: 27px'>&#127989;</option>
                                        <option value='&#127991;'  style='text-align:center;font-size: 27px'>&#127991;</option>
                                        <option value='&#127992;'  style='text-align:center;font-size: 27px'>&#127992;</option>
                                        <option value='&#127993;'  style='text-align:center;font-size: 27px'>&#127993;</option>
                                        <option value='&#127994;'  style='text-align:center;font-size: 27px'>&#127994;</option>
                                        <option value='&#127995;'  style='text-align:center;font-size: 27px'>&#127995;</option>
                                        <option value='&#127996;'  style='text-align:center;font-size: 27px'>&#127996;</option>
                                        <option value='&#127997;'  style='text-align:center;font-size: 27px'>&#127997;</option>
                                        <option value='&#127998;'  style='text-align:center;font-size: 27px'>&#127998;</option>
                                        <option value='&#127999;'  style='text-align:center;font-size: 27px'>&#127999;</option>
                                        <option value='&#128000;'  style='text-align:center;font-size: 27px'>&#128000;</option>
                                        <option value='&#128001;'  style='text-align:center;font-size: 27px'>&#128001;</option>
                                        <option value='&#128002;'  style='text-align:center;font-size: 27px'>&#128002;</option>
                                        <option value='&#128003;'  style='text-align:center;font-size: 27px'>&#128003;</option>
                                        <option value='&#128004;'  style='text-align:center;font-size: 27px'>&#128004;</option>
                                        <option value='&#128005;'  style='text-align:center;font-size: 27px'>&#128005;</option>
                                        <option value='&#128006;'  style='text-align:center;font-size: 27px'>&#128006;</option>
                                        <option value='&#128007;'  style='text-align:center;font-size: 27px'>&#128007;</option>
                                        <option value='&#128008;'  style='text-align:center;font-size: 27px'>&#128008;</option>
                                        <option value='&#128009;'  style='text-align:center;font-size: 27px'>&#128009;</option>
                                        <option value='&#128010;'  style='text-align:center;font-size: 27px'>&#128010;</option>
                                        <option value='&#128011;'  style='text-align:center;font-size: 27px'>&#128011;</option>
                                        <option value='&#128012;'  style='text-align:center;font-size: 27px'>&#128012;</option>
                                        <option value='&#128013;'  style='text-align:center;font-size: 27px'>&#128013;</option>
                                        <option value='&#128014;'  style='text-align:center;font-size: 27px'>&#128014;</option>
                                        <option value='&#128015;'  style='text-align:center;font-size: 27px'>&#128015;</option>
                                        <option value='&#128016;'  style='text-align:center;font-size: 27px'>&#128016;</option>
                                        <option value='&#128017;'  style='text-align:center;font-size: 27px'>&#128017;</option>
                                        <option value='&#128018;'  style='text-align:center;font-size: 27px'>&#128018;</option>
                                        <option value='&#128019;'  style='text-align:center;font-size: 27px'>&#128019;</option>
                                        <option value='&#128020;'  style='text-align:center;font-size: 27px'>&#128020;</option>
                                        <option value='&#128021;'  style='text-align:center;font-size: 27px'>&#128021;</option>
                                        <option value='&#128022;'  style='text-align:center;font-size: 27px'>&#128022;</option>
                                        <option value='&#128023;'  style='text-align:center;font-size: 27px'>&#128023;</option>
                                        <option value='&#128024;'  style='text-align:center;font-size: 27px'>&#128024;</option>
                                        <option value='&#128025;'  style='text-align:center;font-size: 27px'>&#128025;</option>
                                        <option value='&#128026;'  style='text-align:center;font-size: 27px'>&#128026;</option>
                                        <option value='&#128027;'  style='text-align:center;font-size: 27px'>&#128027;</option>
                                        <option value='&#128028;'  style='text-align:center;font-size: 27px'>&#128028;</option>
                                        <option value='&#128029;'  style='text-align:center;font-size: 27px'>&#128029;</option>
                                        <option value='&#128030;'  style='text-align:center;font-size: 27px'>&#128030;</option>
                                        <option value='&#128031;'  style='text-align:center;font-size: 27px'>&#128031;</option>
                                        <option value='&#128032;'  style='text-align:center;font-size: 27px'>&#128032;</option>
                                        <option value='&#128033;'  style='text-align:center;font-size: 27px'>&#128033;</option>
                                        <option value='&#128034;'  style='text-align:center;font-size: 27px'>&#128034;</option>
                                        <option value='&#128035;'  style='text-align:center;font-size: 27px'>&#128035;</option>
                                        <option value='&#128036;'  style='text-align:center;font-size: 27px'>&#128036;</option>
                                        <option value='&#128037;'  style='text-align:center;font-size: 27px'>&#128037;</option>
                                        <option value='&#128038;'  style='text-align:center;font-size: 27px'>&#128038;</option>
                                        <option value='&#128039;'  style='text-align:center;font-size: 27px'>&#128039;</option>
                                        <option value='&#128040;'  style='text-align:center;font-size: 27px'>&#128040;</option>
                                        <option value='&#128041;'  style='text-align:center;font-size: 27px'>&#128041;</option>
                                        <option value='&#128042;'  style='text-align:center;font-size: 27px'>&#128042;</option>
                                        <option value='&#128043;'  style='text-align:center;font-size: 27px'>&#128043;</option>
                                        <option value='&#128044;'  style='text-align:center;font-size: 27px'>&#128044;</option>
                                        <option value='&#128045;'  style='text-align:center;font-size: 27px'>&#128045;</option>
                                        <option value='&#128046;'  style='text-align:center;font-size: 27px'>&#128046;</option>
                                        <option value='&#128047;'  style='text-align:center;font-size: 27px'>&#128047;</option>
                                        <option value='&#128048;'  style='text-align:center;font-size: 27px'>&#128048;</option>
                                        <option value='&#128049;'  style='text-align:center;font-size: 27px'>&#128049;</option>
                                        <option value='&#128050;'  style='text-align:center;font-size: 27px'>&#128050;</option>
                                        <option value='&#128051;'  style='text-align:center;font-size: 27px'>&#128051;</option>
                                        <option value='&#128052;'  style='text-align:center;font-size: 27px'>&#128052;</option>
                                        <option value='&#128053;'  style='text-align:center;font-size: 27px'>&#128053;</option>
                                        <option value='&#128054;'  style='text-align:center;font-size: 27px'>&#128054;</option>
                                        <option value='&#128055;'  style='text-align:center;font-size: 27px'>&#128055;</option>
                                        <option value='&#128056;'  style='text-align:center;font-size: 27px'>&#128056;</option>
                                        <option value='&#128057;'  style='text-align:center;font-size: 27px'>&#128057;</option>
                                        <option value='&#128058;'  style='text-align:center;font-size: 27px'>&#128058;</option>
                                        <option value='&#128059;'  style='text-align:center;font-size: 27px'>&#128059;</option>
                                        <option value='&#128060;'  style='text-align:center;font-size: 27px'>&#128060;</option>
                                        <option value='&#128061;'  style='text-align:center;font-size: 27px'>&#128061;</option>
                                        <option value='&#128062;'  style='text-align:center;font-size: 27px'>&#128062;</option>
                                        <option value='&#128063;'  style='text-align:center;font-size: 27px'>&#128063;</option>
                                        <option value='&#128064;'  style='text-align:center;font-size: 27px'>&#128064;</option>
                                        <option value='&#128065;'  style='text-align:center;font-size: 27px'>&#128065;</option>
                                        <option value='&#128066;'  style='text-align:center;font-size: 27px'>&#128066;</option>
                                        <option value='&#128067;'  style='text-align:center;font-size: 27px'>&#128067;</option>
                                        <option value='&#128068;'  style='text-align:center;font-size: 27px'>&#128068;</option>
                                        <option value='&#128069;'  style='text-align:center;font-size: 27px'>&#128069;</option>
                                        <option value='&#128070;'  style='text-align:center;font-size: 27px'>&#128070;</option>
                                        <option value='&#128071;'  style='text-align:center;font-size: 27px'>&#128071;</option>
                                        <option value='&#128072;'  style='text-align:center;font-size: 27px'>&#128072;</option>
                                        <option value='&#128073;'  style='text-align:center;font-size: 27px'>&#128073;</option>
                                        <option value='&#128074;'  style='text-align:center;font-size: 27px'>&#128074;</option>
                                        <option value='&#128075;'  style='text-align:center;font-size: 27px'>&#128075;</option>
                                        <option value='&#128076;'  style='text-align:center;font-size: 27px'>&#128076;</option>
                                        <option value='&#128077;'  style='text-align:center;font-size: 27px'>&#128077;</option>
                                        <option value='&#128078;'  style='text-align:center;font-size: 27px'>&#128078;</option>
                                        <option value='&#128079;'  style='text-align:center;font-size: 27px'>&#128079;</option>
                                        <option value='&#128080;'  style='text-align:center;font-size: 27px'>&#128080;</option>
                                        <option value='&#128081;'  style='text-align:center;font-size: 27px'>&#128081;</option>
                                        <option value='&#128082;'  style='text-align:center;font-size: 27px'>&#128082;</option>
                                        <option value='&#128083;'  style='text-align:center;font-size: 27px'>&#128083;</option>
                                        <option value='&#128084;'  style='text-align:center;font-size: 27px'>&#128084;</option>
                                        <option value='&#128085;'  style='text-align:center;font-size: 27px'>&#128085;</option>
                                        <option value='&#128086;'  style='text-align:center;font-size: 27px'>&#128086;</option>
                                        <option value='&#128087;'  style='text-align:center;font-size: 27px'>&#128087;</option>
                                        <option value='&#128088;'  style='text-align:center;font-size: 27px'>&#128088;</option>
                                        <option value='&#128089;'  style='text-align:center;font-size: 27px'>&#128089;</option>
                                        <option value='&#128090;'  style='text-align:center;font-size: 27px'>&#128090;</option>
                                        <option value='&#128091;'  style='text-align:center;font-size: 27px'>&#128091;</option>
                                        <option value='&#128092;'  style='text-align:center;font-size: 27px'>&#128092;</option>
                                        <option value='&#128093;'  style='text-align:center;font-size: 27px'>&#128093;</option>
                                        <option value='&#128094;'  style='text-align:center;font-size: 27px'>&#128094;</option>
                                        <option value='&#128095;'  style='text-align:center;font-size: 27px'>&#128095;</option>
                                        <option value='&#128096;'  style='text-align:center;font-size: 27px'>&#128096;</option>
                                        <option value='&#128097;'  style='text-align:center;font-size: 27px'>&#128097;</option>
                                        <option value='&#128098;'  style='text-align:center;font-size: 27px'>&#128098;</option>
                                        <option value='&#128099;'  style='text-align:center;font-size: 27px'>&#128099;</option>
                                        <option value='&#128100;'  style='text-align:center;font-size: 27px'>&#128100;</option>
                                        <option value='&#128101;'  style='text-align:center;font-size: 27px'>&#128101;</option>
                                        <option value='&#128102;'  style='text-align:center;font-size: 27px'>&#128102;</option>
                                        <option value='&#128103;'  style='text-align:center;font-size: 27px'>&#128103;</option>
                                        <option value='&#128104;'  style='text-align:center;font-size: 27px'>&#128104;</option>
                                        <option value='&#128105;'  style='text-align:center;font-size: 27px'>&#128105;</option>
                                        <option value='&#128106;'  style='text-align:center;font-size: 27px'>&#128106;</option>
                                        <option value='&#128107;'  style='text-align:center;font-size: 27px'>&#128107;</option>
                                        <option value='&#128108;'  style='text-align:center;font-size: 27px'>&#128108;</option>
                                        <option value='&#128109;'  style='text-align:center;font-size: 27px'>&#128109;</option>
                                        <option value='&#128110;'  style='text-align:center;font-size: 27px'>&#128110;</option>
                                        <option value='&#128111;'  style='text-align:center;font-size: 27px'>&#128111;</option>
                                        <option value='&#128112;'  style='text-align:center;font-size: 27px'>&#128112;</option>
                                        <option value='&#128113;'  style='text-align:center;font-size: 27px'>&#128113;</option>
                                        <option value='&#128114;'  style='text-align:center;font-size: 27px'>&#128114;</option>
                                        <option value='&#128115;'  style='text-align:center;font-size: 27px'>&#128115;</option>
                                        <option value='&#128116;'  style='text-align:center;font-size: 27px'>&#128116;</option>
                                        <option value='&#128117;'  style='text-align:center;font-size: 27px'>&#128117;</option>
                                        <option value='&#128118;'  style='text-align:center;font-size: 27px'>&#128118;</option>
                                        <option value='&#128119;'  style='text-align:center;font-size: 27px'>&#128119;</option>
                                        <option value='&#128120;'  style='text-align:center;font-size: 27px'>&#128120;</option>
                                        <option value='&#128121;'  style='text-align:center;font-size: 27px'>&#128121;</option>
                                        <option value='&#128122;'  style='text-align:center;font-size: 27px'>&#128122;</option>
                                        <option value='&#128123;'  style='text-align:center;font-size: 27px'>&#128123;</option>
                                        <option value='&#128124;'  style='text-align:center;font-size: 27px'>&#128124;</option>
                                        <option value='&#128125;'  style='text-align:center;font-size: 27px'>&#128125;</option>
                                        <option value='&#128126;'  style='text-align:center;font-size: 27px'>&#128126;</option>
                                        <option value='&#128127;'  style='text-align:center;font-size: 27px'>&#128127;</option>
                                        <option value='&#128128;'  style='text-align:center;font-size: 27px'>&#128128;</option>
                                        <option value='&#128129;'  style='text-align:center;font-size: 27px'>&#128129;</option>
                                        <option value='&#128130;'  style='text-align:center;font-size: 27px'>&#128130;</option>
                                        <option value='&#128131;'  style='text-align:center;font-size: 27px'>&#128131;</option>
                                        <option value='&#128132;'  style='text-align:center;font-size: 27px'>&#128132;</option>
                                        <option value='&#128133;'  style='text-align:center;font-size: 27px'>&#128133;</option>
                                        <option value='&#128134;'  style='text-align:center;font-size: 27px'>&#128134;</option>
                                        <option value='&#128135;'  style='text-align:center;font-size: 27px'>&#128135;</option>
                                        <option value='&#128136;'  style='text-align:center;font-size: 27px'>&#128136;</option>
                                        <option value='&#128137;'  style='text-align:center;font-size: 27px'>&#128137;</option>
                                        <option value='&#128138;'  style='text-align:center;font-size: 27px'>&#128138;</option>
                                        <option value='&#128139;'  style='text-align:center;font-size: 27px'>&#128139;</option>
                                        <option value='&#128140;'  style='text-align:center;font-size: 27px'>&#128140;</option>
                                        <option value='&#128141;'  style='text-align:center;font-size: 27px'>&#128141;</option>
                                        <option value='&#128142;'  style='text-align:center;font-size: 27px'>&#128142;</option>
                                        <option value='&#128143;'  style='text-align:center;font-size: 27px'>&#128143;</option>
                                        <option value='&#128144;'  style='text-align:center;font-size: 27px'>&#128144;</option>
                                        <option value='&#128145;'  style='text-align:center;font-size: 27px'>&#128145;</option>
                                        <option value='&#128146;'  style='text-align:center;font-size: 27px'>&#128146;</option>
                                        <option value='&#128147;'  style='text-align:center;font-size: 27px'>&#128147;</option>
                                        <option value='&#128148;'  style='text-align:center;font-size: 27px'>&#128148;</option>
                                        <option value='&#128149;'  style='text-align:center;font-size: 27px'>&#128149;</option>
                                        <option value='&#128150;'  style='text-align:center;font-size: 27px'>&#128150;</option>
                                        <option value='&#128151;'  style='text-align:center;font-size: 27px'>&#128151;</option>
                                        <option value='&#128152;'  style='text-align:center;font-size: 27px'>&#128152;</option>
                                        <option value='&#128153;'  style='text-align:center;font-size: 27px'>&#128153;</option>
                                        <option value='&#128154;'  style='text-align:center;font-size: 27px'>&#128154;</option>
                                        <option value='&#128155;'  style='text-align:center;font-size: 27px'>&#128155;</option>
                                        <option value='&#128156;'  style='text-align:center;font-size: 27px'>&#128156;</option>
                                        <option value='&#128157;'  style='text-align:center;font-size: 27px'>&#128157;</option>
                                        <option value='&#128158;'  style='text-align:center;font-size: 27px'>&#128158;</option>
                                        <option value='&#128159;'  style='text-align:center;font-size: 27px'>&#128159;</option>
                                        <option value='&#128160;'  style='text-align:center;font-size: 27px'>&#128160;</option>
                                        <option value='&#128161;'  style='text-align:center;font-size: 27px'>&#128161;</option>
                                        <option value='&#128162;'  style='text-align:center;font-size: 27px'>&#128162;</option>
                                        <option value='&#128163;'  style='text-align:center;font-size: 27px'>&#128163;</option>
                                        <option value='&#128164;'  style='text-align:center;font-size: 27px'>&#128164;</option>
                                        <option value='&#128165;'  style='text-align:center;font-size: 27px'>&#128165;</option>
                                        <option value='&#128166;'  style='text-align:center;font-size: 27px'>&#128166;</option>
                                        <option value='&#128167;'  style='text-align:center;font-size: 27px'>&#128167;</option>
                                        <option value='&#128168;'  style='text-align:center;font-size: 27px'>&#128168;</option>
                                        <option value='&#128169;'  style='text-align:center;font-size: 27px'>&#128169;</option>
                                        <option value='&#128170;'  style='text-align:center;font-size: 27px'>&#128170;</option>
                                        <option value='&#128171;'  style='text-align:center;font-size: 27px'>&#128171;</option>
                                        <option value='&#128172;'  style='text-align:center;font-size: 27px'>&#128172;</option>
                                        <option value='&#128173;'  style='text-align:center;font-size: 27px'>&#128173;</option>
                                        <option value='&#128174;'  style='text-align:center;font-size: 27px'>&#128174;</option>
                                        <option value='&#128175;'  style='text-align:center;font-size: 27px'>&#128175;</option>
                                        <option value='&#128176;'  style='text-align:center;font-size: 27px'>&#128176;</option>
                                        <option value='&#128177;'  style='text-align:center;font-size: 27px'>&#128177;</option>
                                        <option value='&#128178;'  style='text-align:center;font-size: 27px'>&#128178;</option>
                                        <option value='&#128179;'  style='text-align:center;font-size: 27px'>&#128179;</option>
                                        <option value='&#128180;'  style='text-align:center;font-size: 27px'>&#128180;</option>
                                        <option value='&#128181;'  style='text-align:center;font-size: 27px'>&#128181;</option>
                                        <option value='&#128182;'  style='text-align:center;font-size: 27px'>&#128182;</option>
                                        <option value='&#128183;'  style='text-align:center;font-size: 27px'>&#128183;</option>
                                        <option value='&#128184;'  style='text-align:center;font-size: 27px'>&#128184;</option>
                                        <option value='&#128185;'  style='text-align:center;font-size: 27px'>&#128185;</option>
                                        <option value='&#128186;'  style='text-align:center;font-size: 27px'>&#128186;</option>
                                        <option value='&#128187;'  style='text-align:center;font-size: 27px'>&#128187;</option>
                                        <option value='&#128188;'  style='text-align:center;font-size: 27px'>&#128188;</option>
                                        <option value='&#128189;'  style='text-align:center;font-size: 27px'>&#128189;</option>
                                        <option value='&#128190;'  style='text-align:center;font-size: 27px'>&#128190;</option>
                                        <option value='&#128191;'  style='text-align:center;font-size: 27px'>&#128191;</option>
                                        <option value='&#128192;'  style='text-align:center;font-size: 27px'>&#128192;</option>
                                        <option value='&#128193;'  style='text-align:center;font-size: 27px'>&#128193;</option>
                                        <option value='&#128194;'  style='text-align:center;font-size: 27px'>&#128194;</option>
                                        <option value='&#128195;'  style='text-align:center;font-size: 27px'>&#128195;</option>
                                        <option value='&#128196;'  style='text-align:center;font-size: 27px'>&#128196;</option>
                                        <option value='&#128197;'  style='text-align:center;font-size: 27px'>&#128197;</option>
                                        <option value='&#128198;'  style='text-align:center;font-size: 27px'>&#128198;</option>
                                        <option value='&#128199;'  style='text-align:center;font-size: 27px'>&#128199;</option>
                                        <option value='&#128200;'  style='text-align:center;font-size: 27px'>&#128200;</option>
                                        <option value='&#128201;'  style='text-align:center;font-size: 27px'>&#128201;</option>
                                        <option value='&#128202;'  style='text-align:center;font-size: 27px'>&#128202;</option>
                                        <option value='&#128203;'  style='text-align:center;font-size: 27px'>&#128203;</option>
                                        <option value='&#128204;'  style='text-align:center;font-size: 27px'>&#128204;</option>
                                        <option value='&#128205;'  style='text-align:center;font-size: 27px'>&#128205;</option>
                                        <option value='&#128206;'  style='text-align:center;font-size: 27px'>&#128206;</option>
                                        <option value='&#128207;'  style='text-align:center;font-size: 27px'>&#128207;</option>
                                        <option value='&#128208;'  style='text-align:center;font-size: 27px'>&#128208;</option>
                                        <option value='&#128209;'  style='text-align:center;font-size: 27px'>&#128209;</option>
                                        <option value='&#128210;'  style='text-align:center;font-size: 27px'>&#128210;</option>
                                        <option value='&#128211;'  style='text-align:center;font-size: 27px'>&#128211;</option>
                                        <option value='&#128212;'  style='text-align:center;font-size: 27px'>&#128212;</option>
                                        <option value='&#128213;'  style='text-align:center;font-size: 27px'>&#128213;</option>
                                        <option value='&#128214;'  style='text-align:center;font-size: 27px'>&#128214;</option>
                                        <option value='&#128215;'  style='text-align:center;font-size: 27px'>&#128215;</option>
                                        <option value='&#128216;'  style='text-align:center;font-size: 27px'>&#128216;</option>
                                        <option value='&#128217;'  style='text-align:center;font-size: 27px'>&#128217;</option>
                                        <option value='&#128218;'  style='text-align:center;font-size: 27px'>&#128218;</option>
                                        <option value='&#128219;'  style='text-align:center;font-size: 27px'>&#128219;</option>
                                        <option value='&#128220;'  style='text-align:center;font-size: 27px'>&#128220;</option>
                                        <option value='&#128221;'  style='text-align:center;font-size: 27px'>&#128221;</option>
                                        <option value='&#128222;'  style='text-align:center;font-size: 27px'>&#128222;</option>
                                        <option value='&#128223;'  style='text-align:center;font-size: 27px'>&#128223;</option>
                                        <option value='&#128224;'  style='text-align:center;font-size: 27px'>&#128224;</option>
                                        <option value='&#128225;'  style='text-align:center;font-size: 27px'>&#128225;</option>
                                        <option value='&#128226;'  style='text-align:center;font-size: 27px'>&#128226;</option>
                                        <option value='&#128227;'  style='text-align:center;font-size: 27px'>&#128227;</option>
                                        <option value='&#128228;'  style='text-align:center;font-size: 27px'>&#128228;</option>
                                        <option value='&#128229;'  style='text-align:center;font-size: 27px'>&#128229;</option>
                                        <option value='&#128230;'  style='text-align:center;font-size: 27px'>&#128230;</option>
                                        <option value='&#128231;'  style='text-align:center;font-size: 27px'>&#128231;</option>
                                        <option value='&#128232;'  style='text-align:center;font-size: 27px'>&#128232;</option>
                                        <option value='&#128233;'  style='text-align:center;font-size: 27px'>&#128233;</option>
                                        <option value='&#128234;'  style='text-align:center;font-size: 27px'>&#128234;</option>
                                        <option value='&#128235;'  style='text-align:center;font-size: 27px'>&#128235;</option>
                                        <option value='&#128236;'  style='text-align:center;font-size: 27px'>&#128236;</option>
                                        <option value='&#128237;'  style='text-align:center;font-size: 27px'>&#128237;</option>
                                        <option value='&#128238;'  style='text-align:center;font-size: 27px'>&#128238;</option>
                                        <option value='&#128239;'  style='text-align:center;font-size: 27px'>&#128239;</option>
                                        <option value='&#128240;'  style='text-align:center;font-size: 27px'>&#128240;</option>
                                        <option value='&#128241;'  style='text-align:center;font-size: 27px'>&#128241;</option>
                                        <option value='&#128242;'  style='text-align:center;font-size: 27px'>&#128242;</option>
                                        <option value='&#128243;'  style='text-align:center;font-size: 27px'>&#128243;</option>
                                        <option value='&#128244;'  style='text-align:center;font-size: 27px'>&#128244;</option>
                                        <option value='&#128245;'  style='text-align:center;font-size: 27px'>&#128245;</option>
                                        <option value='&#128246;'  style='text-align:center;font-size: 27px'>&#128246;</option>
                                        <option value='&#128247;'  style='text-align:center;font-size: 27px'>&#128247;</option>
                                        <option value='&#128248;'  style='text-align:center;font-size: 27px'>&#128248;</option>
                                        <option value='&#128249;'  style='text-align:center;font-size: 27px'>&#128249;</option>
                                        <option value='&#128250;'  style='text-align:center;font-size: 27px'>&#128250;</option>
                                        <option value='&#128251;'  style='text-align:center;font-size: 27px'>&#128251;</option>
                                        <option value='&#128252;'  style='text-align:center;font-size: 27px'>&#128252;</option>
                                        <option value='&#128253;'  style='text-align:center;font-size: 27px'>&#128253;</option>
                                        <option value='&#128255;'  style='text-align:center;font-size: 27px'>&#128255;</option>
                                        <option value='&#128256;'  style='text-align:center;font-size: 27px'>&#128256;</option>
                                        <option value='&#128257;'  style='text-align:center;font-size: 27px'>&#128257;</option>
                                        <option value='&#128258;'  style='text-align:center;font-size: 27px'>&#128258;</option>
                                        <option value='&#128259;'  style='text-align:center;font-size: 27px'>&#128259;</option>
                                        <option value='&#128260;'  style='text-align:center;font-size: 27px'>&#128260;</option>
                                        <option value='&#128261;'  style='text-align:center;font-size: 27px'>&#128261;</option>
                                        <option value='&#128262;'  style='text-align:center;font-size: 27px'>&#128262;</option>
                                        <option value='&#128263;'  style='text-align:center;font-size: 27px'>&#128263;</option>
                                        <option value='&#128264;'  style='text-align:center;font-size: 27px'>&#128264;</option>
                                        <option value='&#128265;'  style='text-align:center;font-size: 27px'>&#128265;</option>
                                        <option value='&#128266;'  style='text-align:center;font-size: 27px'>&#128266;</option>
                                        <option value='&#128267;'  style='text-align:center;font-size: 27px'>&#128267;</option>
                                        <option value='&#128268;'  style='text-align:center;font-size: 27px'>&#128268;</option>
                                        <option value='&#128269;'  style='text-align:center;font-size: 27px'>&#128269;</option>
                                        <option value='&#128270;'  style='text-align:center;font-size: 27px'>&#128270;</option>
                                        <option value='&#128271;'  style='text-align:center;font-size: 27px'>&#128271;</option>
                                        <option value='&#128272;'  style='text-align:center;font-size: 27px'>&#128272;</option>
                                        <option value='&#128273;'  style='text-align:center;font-size: 27px'>&#128273;</option>
                                        <option value='&#128274;'  style='text-align:center;font-size: 27px'>&#128274;</option>
                                        <option value='&#128275;'  style='text-align:center;font-size: 27px'>&#128275;</option>
                                        <option value='&#128276;'  style='text-align:center;font-size: 27px'>&#128276;</option>
                                        <option value='&#128277;'  style='text-align:center;font-size: 27px'>&#128277;</option>
                                        <option value='&#128278;'  style='text-align:center;font-size: 27px'>&#128278;</option>
                                        <option value='&#128279;'  style='text-align:center;font-size: 27px'>&#128279;</option>
                                        <option value='&#128280;'  style='text-align:center;font-size: 27px'>&#128280;</option>
                                        <option value='&#128281;'  style='text-align:center;font-size: 27px'>&#128281;</option>
                                        <option value='&#128282;'  style='text-align:center;font-size: 27px'>&#128282;</option>
                                        <option value='&#128283;'  style='text-align:center;font-size: 27px'>&#128283;</option>
                                        <option value='&#128284;'  style='text-align:center;font-size: 27px'>&#128284;</option>
                                        <option value='&#128285;'  style='text-align:center;font-size: 27px'>&#128285;</option>
                                        <option value='&#128286;'  style='text-align:center;font-size: 27px'>&#128286;</option>
                                        <option value='&#128287;'  style='text-align:center;font-size: 27px'>&#128287;</option>
                                        <option value='&#128288;'  style='text-align:center;font-size: 27px'>&#128288;</option>
                                        <option value='&#128289;'  style='text-align:center;font-size: 27px'>&#128289;</option>
                                        <option value='&#128290;'  style='text-align:center;font-size: 27px'>&#128290;</option>
                                        <option value='&#128291;'  style='text-align:center;font-size: 27px'>&#128291;</option>
                                        <option value='&#128292;'  style='text-align:center;font-size: 27px'>&#128292;</option>
                                        <option value='&#128293;'  style='text-align:center;font-size: 27px'>&#128293;</option>
                                        <option value='&#128294;'  style='text-align:center;font-size: 27px'>&#128294;</option>
                                        <option value='&#128295;'  style='text-align:center;font-size: 27px'>&#128295;</option>
                                        <option value='&#128296;'  style='text-align:center;font-size: 27px'>&#128296;</option>
                                        <option value='&#128297;'  style='text-align:center;font-size: 27px'>&#128297;</option>
                                        <option value='&#128298;'  style='text-align:center;font-size: 27px'>&#128298;</option>
                                        <option value='&#128299;'  style='text-align:center;font-size: 27px'>&#128299;</option>
                                        <option value='&#128300;'  style='text-align:center;font-size: 27px'>&#128300;</option>
                                        <option value='&#128301;'  style='text-align:center;font-size: 27px'>&#128301;</option>
                                        <option value='&#128302;'  style='text-align:center;font-size: 27px'>&#128302;</option>
                                        <option value='&#128303;'  style='text-align:center;font-size: 27px'>&#128303;</option>
                                        <option value='&#128304;'  style='text-align:center;font-size: 27px'>&#128304;</option>
                                        <option value='&#128305;'  style='text-align:center;font-size: 27px'>&#128305;</option>
                                        <option value='&#128306;'  style='text-align:center;font-size: 27px'>&#128306;</option>
                                        <option value='&#128307;'  style='text-align:center;font-size: 27px'>&#128307;</option>
                                        <option value='&#128308;'  style='text-align:center;font-size: 27px'>&#128308;</option>
                                        <option value='&#128309;'  style='text-align:center;font-size: 27px'>&#128309;</option>
                                        <option value='&#128310;'  style='text-align:center;font-size: 27px'>&#128310;</option>
                                        <option value='&#128311;'  style='text-align:center;font-size: 27px'>&#128311;</option>
                                        <option value='&#128312;'  style='text-align:center;font-size: 27px'>&#128312;</option>
                                        <option value='&#128313;'  style='text-align:center;font-size: 27px'>&#128313;</option>
                                        <option value='&#128314;'  style='text-align:center;font-size: 27px'>&#128314;</option>
                                        <option value='&#128315;'  style='text-align:center;font-size: 27px'>&#128315;</option>
                                        <option value='&#128316;'  style='text-align:center;font-size: 27px'>&#128316;</option>
                                        <option value='&#128317;'  style='text-align:center;font-size: 27px'>&#128317;</option>
                                        <option value='&#128329;'  style='text-align:center;font-size: 27px'>&#128329;</option>
                                        <option value='&#128330;'  style='text-align:center;font-size: 27px'>&#128330;</option>
                                        <option value='&#128331;'  style='text-align:center;font-size: 27px'>&#128331;</option>
                                        <option value='&#128332;'  style='text-align:center;font-size: 27px'>&#128332;</option>
                                        <option value='&#128333;'  style='text-align:center;font-size: 27px'>&#128333;</option>
                                        <option value='&#128334;'  style='text-align:center;font-size: 27px'>&#128334;</option>
                                        <option value='&#128336;'  style='text-align:center;font-size: 27px'>&#128336;</option>
                                        <option value='&#128337;'  style='text-align:center;font-size: 27px'>&#128337;</option>
                                        <option value='&#128338;'  style='text-align:center;font-size: 27px'>&#128338;</option>
                                        <option value='&#128339;'  style='text-align:center;font-size: 27px'>&#128339;</option>
                                        <option value='&#128340;'  style='text-align:center;font-size: 27px'>&#128340;</option>
                                        <option value='&#128341;'  style='text-align:center;font-size: 27px'>&#128341;</option>
                                        <option value='&#128342;'  style='text-align:center;font-size: 27px'>&#128342;</option>
                                        <option value='&#128343;'  style='text-align:center;font-size: 27px'>&#128343;</option>
                                        <option value='&#128344;'  style='text-align:center;font-size: 27px'>&#128344;</option>
                                        <option value='&#128345;'  style='text-align:center;font-size: 27px'>&#128345;</option>
                                        <option value='&#128346;'  style='text-align:center;font-size: 27px'>&#128346;</option>
                                        <option value='&#128347;'  style='text-align:center;font-size: 27px'>&#128347;</option>
                                        <option value='&#128348;'  style='text-align:center;font-size: 27px'>&#128348;</option>
                                        <option value='&#128349;'  style='text-align:center;font-size: 27px'>&#128349;</option>
                                        <option value='&#128350;'  style='text-align:center;font-size: 27px'>&#128350;</option>
                                        <option value='&#128351;'  style='text-align:center;font-size: 27px'>&#128351;</option>
                                        <option value='&#128352;'  style='text-align:center;font-size: 27px'>&#128352;</option>
                                        <option value='&#128353;'  style='text-align:center;font-size: 27px'>&#128353;</option>
                                        <option value='&#128354;'  style='text-align:center;font-size: 27px'>&#128354;</option>
                                        <option value='&#128355;'  style='text-align:center;font-size: 27px'>&#128355;</option>
                                        <option value='&#128356;'  style='text-align:center;font-size: 27px'>&#128356;</option>
                                        <option value='&#128357;'  style='text-align:center;font-size: 27px'>&#128357;</option>
                                        <option value='&#128358;'  style='text-align:center;font-size: 27px'>&#128358;</option>
                                        <option value='&#128359;'  style='text-align:center;font-size: 27px'>&#128359;</option>
                                        <option value='&#128367;'  style='text-align:center;font-size: 27px'>&#128367;</option>
                                        <option value='&#128368;'  style='text-align:center;font-size: 27px'>&#128368;</option>
                                        <option value='&#128371;'  style='text-align:center;font-size: 27px'>&#128371;</option>
                                        <option value='&#128372;'  style='text-align:center;font-size: 27px'>&#128372;</option>
                                        <option value='&#128373;'  style='text-align:center;font-size: 27px'>&#128373;</option>
                                        <option value='&#128374;'  style='text-align:center;font-size: 27px'>&#128374;</option>
                                        <option value='&#128375;'  style='text-align:center;font-size: 27px'>&#128375;</option>
                                        <option value='&#128376;'  style='text-align:center;font-size: 27px'>&#128376;</option>
                                        <option value='&#128377;'  style='text-align:center;font-size: 27px'>&#128377;</option>
                                        <option value='&#128378;'  style='text-align:center;font-size: 27px'>&#128378;</option>
                                        <option value='&#128391;'  style='text-align:center;font-size: 27px'>&#128391;</option>
                                        <option value='&#128394;'  style='text-align:center;font-size: 27px'>&#128394;</option>
                                        <option value='&#128395;'  style='text-align:center;font-size: 27px'>&#128395;</option>
                                        <option value='&#128396;'  style='text-align:center;font-size: 27px'>&#128396;</option>
                                        <option value='&#128397;'  style='text-align:center;font-size: 27px'>&#128397;</option>
                                        <option value='&#128400;'  style='text-align:center;font-size: 27px'>&#128400;</option>
                                        <option value='&#128405;'  style='text-align:center;font-size: 27px'>&#128405;</option>
                                        <option value='&#128406;'  style='text-align:center;font-size: 27px'>&#128406;</option>
                                        <option value='&#128420;'  style='text-align:center;font-size: 27px'>&#128420;</option>
                                        <option value='&#128421;'  style='text-align:center;font-size: 27px'>&#128421;</option>
                                        <option value='&#128424;'  style='text-align:center;font-size: 27px'>&#128424;</option>
                                        <option value='&#128433;'  style='text-align:center;font-size: 27px'>&#128433;</option>
                                        <option value='&#128434;'  style='text-align:center;font-size: 27px'>&#128434;</option>
                                        <option value='&#128444;'  style='text-align:center;font-size: 27px'>&#128444;</option>
                                        <option value='&#128450;'  style='text-align:center;font-size: 27px'>&#128450;</option>
                                        <option value='&#128451;'  style='text-align:center;font-size: 27px'>&#128451;</option>
                                        <option value='&#128452;'  style='text-align:center;font-size: 27px'>&#128452;</option>
                                        <option value='&#128465;'  style='text-align:center;font-size: 27px'>&#128465;</option>
                                        <option value='&#128466;'  style='text-align:center;font-size: 27px'>&#128466;</option>
                                        <option value='&#128467;'  style='text-align:center;font-size: 27px'>&#128467;</option>
                                        <option value='&#128476;'  style='text-align:center;font-size: 27px'>&#128476;</option>
                                        <option value='&#128477;'  style='text-align:center;font-size: 27px'>&#128477;</option>
                                        <option value='&#128478;'  style='text-align:center;font-size: 27px'>&#128478;</option>
                                        <option value='&#128481;'  style='text-align:center;font-size: 27px'>&#128481;</option>
                                        <option value='&#128483;'  style='text-align:center;font-size: 27px'>&#128483;</option>
                                        <option value='&#128488;'  style='text-align:center;font-size: 27px'>&#128488;</option>
                                        <option value='&#128495;'  style='text-align:center;font-size: 27px'>&#128495;</option>
                                        <option value='&#128499;'  style='text-align:center;font-size: 27px'>&#128499;</option>
                                        <option value='&#128506;'  style='text-align:center;font-size: 27px'>&#128506;</option>
                                        <option value='&#128507;'  style='text-align:center;font-size: 27px'>&#128507;</option>
                                        <option value='&#128508;'  style='text-align:center;font-size: 27px'>&#128508;</option>
                                        <option value='&#128509;'  style='text-align:center;font-size: 27px'>&#128509;</option>
                                        <option value='&#128510;'  style='text-align:center;font-size: 27px'>&#128510;</option>
                                        <option value='&#128511;'  style='text-align:center;font-size: 27px'>&#128511;</option>
                                        <option value='&#128512;'  style='text-align:center;font-size: 27px'>&#128512;</option>
                                        <option value='&#128513;'  style='text-align:center;font-size: 27px'>&#128513;</option>
                                        <option value='&#128514;'  style='text-align:center;font-size: 27px'>&#128514;</option>
                                        <option value='&#128515;'  style='text-align:center;font-size: 27px'>&#128515;</option>
                                        <option value='&#128516;'  style='text-align:center;font-size: 27px'>&#128516;</option>
                                        <option value='&#128517;'  style='text-align:center;font-size: 27px'>&#128517;</option>
                                        <option value='&#128518;'  style='text-align:center;font-size: 27px'>&#128518;</option>
                                        <option value='&#128519;'  style='text-align:center;font-size: 27px'>&#128519;</option>
                                        <option value='&#128520;'  style='text-align:center;font-size: 27px'>&#128520;</option>
                                        <option value='&#128521;'  style='text-align:center;font-size: 27px'>&#128521;</option>
                                        <option value='&#128522;'  style='text-align:center;font-size: 27px'>&#128522;</option>
                                        <option value='&#128523;'  style='text-align:center;font-size: 27px'>&#128523;</option>
                                        <option value='&#128524;'  style='text-align:center;font-size: 27px'>&#128524;</option>
                                        <option value='&#128525;'  style='text-align:center;font-size: 27px'>&#128525;</option>
                                        <option value='&#128526;'  style='text-align:center;font-size: 27px'>&#128526;</option>
                                        <option value='&#128527;'  style='text-align:center;font-size: 27px'>&#128527;</option>
                                        <option value='&#128528;'  style='text-align:center;font-size: 27px'>&#128528;</option>
                                        <option value='&#128529;'  style='text-align:center;font-size: 27px'>&#128529;</option>
                                        <option value='&#128530;'  style='text-align:center;font-size: 27px'>&#128530;</option>
                                        <option value='&#128531;'  style='text-align:center;font-size: 27px'>&#128531;</option>
                                        <option value='&#128532;'  style='text-align:center;font-size: 27px'>&#128532;</option>
                                        <option value='&#128533;'  style='text-align:center;font-size: 27px'>&#128533;</option>
                                        <option value='&#128534;'  style='text-align:center;font-size: 27px'>&#128534;</option>
                                        <option value='&#128535;'  style='text-align:center;font-size: 27px'>&#128535;</option>
                                        <option value='&#128536;'  style='text-align:center;font-size: 27px'>&#128536;</option>
                                        <option value='&#128537;'  style='text-align:center;font-size: 27px'>&#128537;</option>
                                        <option value='&#128538;'  style='text-align:center;font-size: 27px'>&#128538;</option>
                                        <option value='&#128539;'  style='text-align:center;font-size: 27px'>&#128539;</option>
                                        <option value='&#128540;'  style='text-align:center;font-size: 27px'>&#128540;</option>
                                        <option value='&#128541;'  style='text-align:center;font-size: 27px'>&#128541;</option>
                                        <option value='&#128542;'  style='text-align:center;font-size: 27px'>&#128542;</option>
                                        <option value='&#128543;'  style='text-align:center;font-size: 27px'>&#128543;</option>
                                        <option value='&#128544;'  style='text-align:center;font-size: 27px'>&#128544;</option>
                                        <option value='&#128545;'  style='text-align:center;font-size: 27px'>&#128545;</option>
                                        <option value='&#128546;'  style='text-align:center;font-size: 27px'>&#128546;</option>
                                        <option value='&#128547;'  style='text-align:center;font-size: 27px'>&#128547;</option>
                                        <option value='&#128548;'  style='text-align:center;font-size: 27px'>&#128548;</option>
                                        <option value='&#128549;'  style='text-align:center;font-size: 27px'>&#128549;</option>
                                        <option value='&#128550;'  style='text-align:center;font-size: 27px'>&#128550;</option>
                                        <option value='&#128551;'  style='text-align:center;font-size: 27px'>&#128551;</option>
                                        <option value='&#128552;'  style='text-align:center;font-size: 27px'>&#128552;</option>
                                        <option value='&#128553;'  style='text-align:center;font-size: 27px'>&#128553;</option>
                                        <option value='&#128554;'  style='text-align:center;font-size: 27px'>&#128554;</option>
                                        <option value='&#128555;'  style='text-align:center;font-size: 27px'>&#128555;</option>
                                        <option value='&#128556;'  style='text-align:center;font-size: 27px'>&#128556;</option>
                                        <option value='&#128557;'  style='text-align:center;font-size: 27px'>&#128557;</option>
                                        <option value='&#128558;'  style='text-align:center;font-size: 27px'>&#128558;</option>
                                        <option value='&#128559;'  style='text-align:center;font-size: 27px'>&#128559;</option>
                                        <option value='&#128560;'  style='text-align:center;font-size: 27px'>&#128560;</option>
                                        <option value='&#128561;'  style='text-align:center;font-size: 27px'>&#128561;</option>
                                        <option value='&#128562;'  style='text-align:center;font-size: 27px'>&#128562;</option>
                                        <option value='&#128563;'  style='text-align:center;font-size: 27px'>&#128563;</option>
                                        <option value='&#128564;'  style='text-align:center;font-size: 27px'>&#128564;</option>
                                        <option value='&#128565;'  style='text-align:center;font-size: 27px'>&#128565;</option>
                                        <option value='&#128566;'  style='text-align:center;font-size: 27px'>&#128566;</option>
                                        <option value='&#128567;'  style='text-align:center;font-size: 27px'>&#128567;</option>
                                        <option value='&#128568;'  style='text-align:center;font-size: 27px'>&#128568;</option>
                                        <option value='&#128569;'  style='text-align:center;font-size: 27px'>&#128569;</option>
                                        <option value='&#128570;'  style='text-align:center;font-size: 27px'>&#128570;</option>
                                        <option value='&#128571;'  style='text-align:center;font-size: 27px'>&#128571;</option>
                                        <option value='&#128572;'  style='text-align:center;font-size: 27px'>&#128572;</option>
                                        <option value='&#128573;'  style='text-align:center;font-size: 27px'>&#128573;</option>
                                        <option value='&#128574;'  style='text-align:center;font-size: 27px'>&#128574;</option>
                                        <option value='&#128575;'  style='text-align:center;font-size: 27px'>&#128575;</option>
                                        <option value='&#128576;'  style='text-align:center;font-size: 27px'>&#128576;</option>
                                        <option value='&#128577;'  style='text-align:center;font-size: 27px'>&#128577;</option>
                                        <option value='&#128578;'  style='text-align:center;font-size: 27px'>&#128578;</option>
                                        <option value='&#128579;'  style='text-align:center;font-size: 27px'>&#128579;</option>
                                        <option value='&#128580;'  style='text-align:center;font-size: 27px'>&#128580;</option>
                                        <option value='&#128581;'  style='text-align:center;font-size: 27px'>&#128581;</option>
                                        <option value='&#128582;'  style='text-align:center;font-size: 27px'>&#128582;</option>
                                        <option value='&#128583;'  style='text-align:center;font-size: 27px'>&#128583;</option>
                                        <option value='&#128584;'  style='text-align:center;font-size: 27px'>&#128584;</option>
                                        <option value='&#128585;'  style='text-align:center;font-size: 27px'>&#128585;</option>
                                        <option value='&#128586;'  style='text-align:center;font-size: 27px'>&#128586;</option>
                                        <option value='&#128587;'  style='text-align:center;font-size: 27px'>&#128587;</option>
                                        <option value='&#128588;'  style='text-align:center;font-size: 27px'>&#128588;</option>
                                        <option value='&#128589;'  style='text-align:center;font-size: 27px'>&#128589;</option>
                                        <option value='&#128590;'  style='text-align:center;font-size: 27px'>&#128590;</option>
                                        <option value='&#128591;'  style='text-align:center;font-size: 27px'>&#128591;</option>
                                        <option value='&#128640;'  style='text-align:center;font-size: 27px'>&#128640;</option>
                                        <option value='&#128641;'  style='text-align:center;font-size: 27px'>&#128641;</option>
                                        <option value='&#128642;'  style='text-align:center;font-size: 27px'>&#128642;</option>
                                        <option value='&#128643;'  style='text-align:center;font-size: 27px'>&#128643;</option>
                                        <option value='&#128644;'  style='text-align:center;font-size: 27px'>&#128644;</option>
                                        <option value='&#128645;'  style='text-align:center;font-size: 27px'>&#128645;</option>
                                        <option value='&#128646;'  style='text-align:center;font-size: 27px'>&#128646;</option>
                                        <option value='&#128647;'  style='text-align:center;font-size: 27px'>&#128647;</option>
                                        <option value='&#128648;'  style='text-align:center;font-size: 27px'>&#128648;</option>
                                        <option value='&#128649;'  style='text-align:center;font-size: 27px'>&#128649;</option>
                                        <option value='&#128650;'  style='text-align:center;font-size: 27px'>&#128650;</option>
                                        <option value='&#128651;'  style='text-align:center;font-size: 27px'>&#128651;</option>
                                        <option value='&#128652;'  style='text-align:center;font-size: 27px'>&#128652;</option>
                                        <option value='&#128653;'  style='text-align:center;font-size: 27px'>&#128653;</option>
                                        <option value='&#128654;'  style='text-align:center;font-size: 27px'>&#128654;</option>
                                        <option value='&#128655;'  style='text-align:center;font-size: 27px'>&#128655;</option>
                                        <option value='&#128656;'  style='text-align:center;font-size: 27px'>&#128656;</option>
                                        <option value='&#128657;'  style='text-align:center;font-size: 27px'>&#128657;</option>
                                        <option value='&#128658;'  style='text-align:center;font-size: 27px'>&#128658;</option>
                                        <option value='&#128659;'  style='text-align:center;font-size: 27px'>&#128659;</option>
                                        <option value='&#128660;'  style='text-align:center;font-size: 27px'>&#128660;</option>
                                        <option value='&#128661;'  style='text-align:center;font-size: 27px'>&#128661;</option>
                                        <option value='&#128662;'  style='text-align:center;font-size: 27px'>&#128662;</option>
                                        <option value='&#128663;'  style='text-align:center;font-size: 27px'>&#128663;</option>
                                        <option value='&#128664;'  style='text-align:center;font-size: 27px'>&#128664;</option>
                                        <option value='&#128665;'  style='text-align:center;font-size: 27px'>&#128665;</option>
                                        <option value='&#128666;'  style='text-align:center;font-size: 27px'>&#128666;</option>
                                        <option value='&#128667;'  style='text-align:center;font-size: 27px'>&#128667;</option>
                                        <option value='&#128668;'  style='text-align:center;font-size: 27px'>&#128668;</option>
                                        <option value='&#128669;'  style='text-align:center;font-size: 27px'>&#128669;</option>
                                        <option value='&#128670;'  style='text-align:center;font-size: 27px'>&#128670;</option>
                                        <option value='&#128671;'  style='text-align:center;font-size: 27px'>&#128671;</option>
                                        <option value='&#128672;'  style='text-align:center;font-size: 27px'>&#128672;</option>
                                        <option value='&#128673;'  style='text-align:center;font-size: 27px'>&#128673;</option>
                                        <option value='&#128674;'  style='text-align:center;font-size: 27px'>&#128674;</option>
                                        <option value='&#128675;'  style='text-align:center;font-size: 27px'>&#128675;</option>
                                        <option value='&#128676;'  style='text-align:center;font-size: 27px'>&#128676;</option>
                                        <option value='&#128677;'  style='text-align:center;font-size: 27px'>&#128677;</option>
                                        <option value='&#128678;'  style='text-align:center;font-size: 27px'>&#128678;</option>
                                        <option value='&#128679;'  style='text-align:center;font-size: 27px'>&#128679;</option>
                                        <option value='&#128680;'  style='text-align:center;font-size: 27px'>&#128680;</option>
                                        <option value='&#128681;'  style='text-align:center;font-size: 27px'>&#128681;</option>
                                        <option value='&#128682;'  style='text-align:center;font-size: 27px'>&#128682;</option>
                                        <option value='&#128683;'  style='text-align:center;font-size: 27px'>&#128683;</option>
                                        <option value='&#128684;'  style='text-align:center;font-size: 27px'>&#128684;</option>
                                        <option value='&#128685;'  style='text-align:center;font-size: 27px'>&#128685;</option>
                                        <option value='&#128686;'  style='text-align:center;font-size: 27px'>&#128686;</option>
                                        <option value='&#128687;'  style='text-align:center;font-size: 27px'>&#128687;</option>
                                        <option value='&#128688;'  style='text-align:center;font-size: 27px'>&#128688;</option>
                                        <option value='&#128689;'  style='text-align:center;font-size: 27px'>&#128689;</option>
                                        <option value='&#128690;'  style='text-align:center;font-size: 27px'>&#128690;</option>
                                        <option value='&#128691;'  style='text-align:center;font-size: 27px'>&#128691;</option>
                                        <option value='&#128692;'  style='text-align:center;font-size: 27px'>&#128692;</option>
                                        <option value='&#128693;'  style='text-align:center;font-size: 27px'>&#128693;</option>
                                        <option value='&#128694;'  style='text-align:center;font-size: 27px'>&#128694;</option>
                                        <option value='&#128695;'  style='text-align:center;font-size: 27px'>&#128695;</option>
                                        <option value='&#128696;'  style='text-align:center;font-size: 27px'>&#128696;</option>
                                        <option value='&#128697;'  style='text-align:center;font-size: 27px'>&#128697;</option>
                                        <option value='&#128698;'  style='text-align:center;font-size: 27px'>&#128698;</option>
                                        <option value='&#128699;'  style='text-align:center;font-size: 27px'>&#128699;</option>
                                        <option value='&#128700;'  style='text-align:center;font-size: 27px'>&#128700;</option>
                                        <option value='&#128701;'  style='text-align:center;font-size: 27px'>&#128701;</option>
                                        <option value='&#128702;'  style='text-align:center;font-size: 27px'>&#128702;</option>
                                        <option value='&#128703;'  style='text-align:center;font-size: 27px'>&#128703;</option>
                                        <option value='&#128704;'  style='text-align:center;font-size: 27px'>&#128704;</option>
                                        <option value='&#128705;'  style='text-align:center;font-size: 27px'>&#128705;</option>
                                        <option value='&#128706;'  style='text-align:center;font-size: 27px'>&#128706;</option>
                                        <option value='&#128707;'  style='text-align:center;font-size: 27px'>&#128707;</option>
                                        <option value='&#128708;'  style='text-align:center;font-size: 27px'>&#128708;</option>
                                        <option value='&#128709;'  style='text-align:center;font-size: 27px'>&#128709;</option>
                                        <option value='&#128715;'  style='text-align:center;font-size: 27px'>&#128715;</option>
                                        <option value='&#128716;'  style='text-align:center;font-size: 27px'>&#128716;</option>
                                        <option value='&#128717;'  style='text-align:center;font-size: 27px'>&#128717;</option>
                                        <option value='&#128718;'  style='text-align:center;font-size: 27px'>&#128718;</option>
                                        <option value='&#128719;'  style='text-align:center;font-size: 27px'>&#128719;</option>
                                        <option value='&#128720;'  style='text-align:center;font-size: 27px'>&#128720;</option>
                                        <option value='&#128721;'  style='text-align:center;font-size: 27px'>&#128721;</option>
                                        <option value='&#128722;'  style='text-align:center;font-size: 27px'>&#128722;</option>
                                        <option value='&#128736;'  style='text-align:center;font-size: 27px'>&#128736;</option>
                                        <option value='&#128737;'  style='text-align:center;font-size: 27px'>&#128737;</option>
                                        <option value='&#128738;'  style='text-align:center;font-size: 27px'>&#128738;</option>
                                        <option value='&#128739;'  style='text-align:center;font-size: 27px'>&#128739;</option>
                                        <option value='&#128740;'  style='text-align:center;font-size: 27px'>&#128740;</option>
                                        <option value='&#128741;'  style='text-align:center;font-size: 27px'>&#128741;</option>
                                        <option value='&#128745;'  style='text-align:center;font-size: 27px'>&#128745;</option>
                                        <option value='&#128747;'  style='text-align:center;font-size: 27px'>&#128747;</option>
                                        <option value='&#128748;'  style='text-align:center;font-size: 27px'>&#128748;</option>
                                        <option value='&#128752;'  style='text-align:center;font-size: 27px'>&#128752;</option>
                                        <option value='&#128755;'  style='text-align:center;font-size: 27px'>&#128755;</option>
                                        <option value='&#128756;'  style='text-align:center;font-size: 27px'>&#128756;</option>
                                        <option value='&#128757;'  style='text-align:center;font-size: 27px'>&#128757;</option>
                                        <option value='&#128758;'  style='text-align:center;font-size: 27px'>&#128758;</option>
                                        <option value='&#128759;'  style='text-align:center;font-size: 27px'>&#128759;</option>
                                        <option value='&#128760;'  style='text-align:center;font-size: 27px'>&#128760;</option>
                                        <option value='&#128761;'  style='text-align:center;font-size: 27px'>&#128761;</option>
                                        <option value='&#128762;'  style='text-align:center;font-size: 27px'>&#128762;</option>
                                        <option value='&#129296;'  style='text-align:center;font-size: 27px'>&#129296;</option>
                                        <option value='&#129297;'  style='text-align:center;font-size: 27px'>&#129297;</option>
                                        <option value='&#129298;'  style='text-align:center;font-size: 27px'>&#129298;</option>
                                        <option value='&#129299;'  style='text-align:center;font-size: 27px'>&#129299;</option>
                                        <option value='&#129300;'  style='text-align:center;font-size: 27px'>&#129300;</option>
                                        <option value='&#129301;'  style='text-align:center;font-size: 27px'>&#129301;</option>
                                        <option value='&#129302;'  style='text-align:center;font-size: 27px'>&#129302;</option>
                                        <option value='&#129303;'  style='text-align:center;font-size: 27px'>&#129303;</option>
                                        <option value='&#129304;'  style='text-align:center;font-size: 27px'>&#129304;</option>
                                        <option value='&#129305;'  style='text-align:center;font-size: 27px'>&#129305;</option>
                                        <option value='&#129306;'  style='text-align:center;font-size: 27px'>&#129306;</option>
                                        <option value='&#129307;'  style='text-align:center;font-size: 27px'>&#129307;</option>
                                        <option value='&#129308;'  style='text-align:center;font-size: 27px'>&#129308;</option>
                                        <option value='&#129309;'  style='text-align:center;font-size: 27px'>&#129309;</option>
                                        <option value='&#129310;'  style='text-align:center;font-size: 27px'>&#129310;</option>
                                        <option value='&#129311;'  style='text-align:center;font-size: 27px'>&#129311;</option>
                                        <option value='&#129312;'  style='text-align:center;font-size: 27px'>&#129312;</option>
                                        <option value='&#129313;'  style='text-align:center;font-size: 27px'>&#129313;</option>
                                        <option value='&#129314;'  style='text-align:center;font-size: 27px'>&#129314;</option>
                                        <option value='&#129315;'  style='text-align:center;font-size: 27px'>&#129315;</option>
                                        <option value='&#129316;'  style='text-align:center;font-size: 27px'>&#129316;</option>
                                        <option value='&#129317;'  style='text-align:center;font-size: 27px'>&#129317;</option>
                                        <option value='&#129318;'  style='text-align:center;font-size: 27px'>&#129318;</option>
                                        <option value='&#129319;'  style='text-align:center;font-size: 27px'>&#129319;</option>
                                        <option value='&#129320;'  style='text-align:center;font-size: 27px'>&#129320;</option>
                                        <option value='&#129321;'  style='text-align:center;font-size: 27px'>&#129321;</option>
                                        <option value='&#129322;'  style='text-align:center;font-size: 27px'>&#129322;</option>
                                        <option value='&#129323;'  style='text-align:center;font-size: 27px'>&#129323;</option>
                                        <option value='&#129324;'  style='text-align:center;font-size: 27px'>&#129324;</option>
                                        <option value='&#129325;'  style='text-align:center;font-size: 27px'>&#129325;</option>
                                        <option value='&#129326;'  style='text-align:center;font-size: 27px'>&#129326;</option>
                                        <option value='&#129327;'  style='text-align:center;font-size: 27px'>&#129327;</option>
                                        <option value='&#129328;'  style='text-align:center;font-size: 27px'>&#129328;</option>
                                        <option value='&#129329;'  style='text-align:center;font-size: 27px'>&#129329;</option>
                                        <option value='&#129330;'  style='text-align:center;font-size: 27px'>&#129330;</option>
                                        <option value='&#129331;'  style='text-align:center;font-size: 27px'>&#129331;</option>
                                        <option value='&#129332;'  style='text-align:center;font-size: 27px'>&#129332;</option>
                                        <option value='&#129333;'  style='text-align:center;font-size: 27px'>&#129333;</option>
                                        <option value='&#129334;'  style='text-align:center;font-size: 27px'>&#129334;</option>
                                        <option value='&#129335;'  style='text-align:center;font-size: 27px'>&#129335;</option>
                                        <option value='&#129336;'  style='text-align:center;font-size: 27px'>&#129336;</option>
                                        <option value='&#129337;'  style='text-align:center;font-size: 27px'>&#129337;</option>
                                        <option value='&#129338;'  style='text-align:center;font-size: 27px'>&#129338;</option>
                                        <option value='&#129340;'  style='text-align:center;font-size: 27px'>&#129340;</option>
                                        <option value='&#129341;'  style='text-align:center;font-size: 27px'>&#129341;</option>
                                        <option value='&#129342;'  style='text-align:center;font-size: 27px'>&#129342;</option>
                                        <option value='&#129344;'  style='text-align:center;font-size: 27px'>&#129344;</option>
                                        <option value='&#129345;'  style='text-align:center;font-size: 27px'>&#129345;</option>
                                        <option value='&#129346;'  style='text-align:center;font-size: 27px'>&#129346;</option>
                                        <option value='&#129347;'  style='text-align:center;font-size: 27px'>&#129347;</option>
                                        <option value='&#129348;'  style='text-align:center;font-size: 27px'>&#129348;</option>
                                        <option value='&#129349;'  style='text-align:center;font-size: 27px'>&#129349;</option>
                                        <option value='&#129351;'  style='text-align:center;font-size: 27px'>&#129351;</option>
                                        <option value='&#129352;'  style='text-align:center;font-size: 27px'>&#129352;</option>
                                        <option value='&#129353;'  style='text-align:center;font-size: 27px'>&#129353;</option>
                                        <option value='&#129354;'  style='text-align:center;font-size: 27px'>&#129354;</option>
                                        <option value='&#129355;'  style='text-align:center;font-size: 27px'>&#129355;</option>
                                        <option value='&#129356;'  style='text-align:center;font-size: 27px'>&#129356;</option>
                                        <option value='&#129357;'  style='text-align:center;font-size: 27px'>&#129357;</option>
                                        <option value='&#129358;'  style='text-align:center;font-size: 27px'>&#129358;</option>
                                        <option value='&#129359;'  style='text-align:center;font-size: 27px'>&#129359;</option>
                                        <option value='&#129360;'  style='text-align:center;font-size: 27px'>&#129360;</option>
                                        <option value='&#129361;'  style='text-align:center;font-size: 27px'>&#129361;</option>
                                        <option value='&#129362;'  style='text-align:center;font-size: 27px'>&#129362;</option>
                                        <option value='&#129363;'  style='text-align:center;font-size: 27px'>&#129363;</option>
                                        <option value='&#129364;'  style='text-align:center;font-size: 27px'>&#129364;</option>
                                        <option value='&#129365;'  style='text-align:center;font-size: 27px'>&#129365;</option>
                                        <option value='&#129366;'  style='text-align:center;font-size: 27px'>&#129366;</option>
                                        <option value='&#129367;'  style='text-align:center;font-size: 27px'>&#129367;</option>
                                        <option value='&#129368;'  style='text-align:center;font-size: 27px'>&#129368;</option>
                                        <option value='&#129369;'  style='text-align:center;font-size: 27px'>&#129369;</option>
                                        <option value='&#129370;'  style='text-align:center;font-size: 27px'>&#129370;</option>
                                        <option value='&#129371;'  style='text-align:center;font-size: 27px'>&#129371;</option>
                                        <option value='&#129372;'  style='text-align:center;font-size: 27px'>&#129372;</option>
                                        <option value='&#129373;'  style='text-align:center;font-size: 27px'>&#129373;</option>
                                        <option value='&#129374;'  style='text-align:center;font-size: 27px'>&#129374;</option>
                                        <option value='&#129375;'  style='text-align:center;font-size: 27px'>&#129375;</option>
                                        <option value='&#129376;'  style='text-align:center;font-size: 27px'>&#129376;</option>
                                        <option value='&#129377;'  style='text-align:center;font-size: 27px'>&#129377;</option>
                                        <option value='&#129378;'  style='text-align:center;font-size: 27px'>&#129378;</option>
                                        <option value='&#129379;'  style='text-align:center;font-size: 27px'>&#129379;</option>
                                        <option value='&#129380;'  style='text-align:center;font-size: 27px'>&#129380;</option>
                                        <option value='&#129381;'  style='text-align:center;font-size: 27px'>&#129381;</option>
                                        <option value='&#129382;'  style='text-align:center;font-size: 27px'>&#129382;</option>
                                        <option value='&#129383;'  style='text-align:center;font-size: 27px'>&#129383;</option>
                                        <option value='&#129384;'  style='text-align:center;font-size: 27px'>&#129384;</option>
                                        <option value='&#129385;'  style='text-align:center;font-size: 27px'>&#129385;</option>
                                        <option value='&#129386;'  style='text-align:center;font-size: 27px'>&#129386;</option>
                                        <option value='&#129387;'  style='text-align:center;font-size: 27px'>&#129387;</option>
                                        <option value='&#129408;'  style='text-align:center;font-size: 27px'>&#129408;</option>
                                        <option value='&#129409;'  style='text-align:center;font-size: 27px'>&#129409;</option>
                                        <option value='&#129410;'  style='text-align:center;font-size: 27px'>&#129410;</option>
                                        <option value='&#129411;'  style='text-align:center;font-size: 27px'>&#129411;</option>
                                        <option value='&#129412;'  style='text-align:center;font-size: 27px'>&#129412;</option>
                                        <option value='&#129413;'  style='text-align:center;font-size: 27px'>&#129413;</option>
                                        <option value='&#129414;'  style='text-align:center;font-size: 27px'>&#129414;</option>
                                        <option value='&#129415;'  style='text-align:center;font-size: 27px'>&#129415;</option>
                                        <option value='&#129416;'  style='text-align:center;font-size: 27px'>&#129416;</option>
                                        <option value='&#129417;'  style='text-align:center;font-size: 27px'>&#129417;</option>
                                        <option value='&#129418;'  style='text-align:center;font-size: 27px'>&#129418;</option>
                                        <option value='&#129419;'  style='text-align:center;font-size: 27px'>&#129419;</option>
                                        <option value='&#129420;'  style='text-align:center;font-size: 27px'>&#129420;</option>
                                        <option value='&#129421;'  style='text-align:center;font-size: 27px'>&#129421;</option>
                                        <option value='&#129422;'  style='text-align:center;font-size: 27px'>&#129422;</option>
                                        <option value='&#129423;'  style='text-align:center;font-size: 27px'>&#129423;</option>
                                        <option value='&#129424;'  style='text-align:center;font-size: 27px'>&#129424;</option>
                                        <option value='&#129425;'  style='text-align:center;font-size: 27px'>&#129425;</option>
                                        <option value='&#129426;'  style='text-align:center;font-size: 27px'>&#129426;</option>
                                        <option value='&#129427;'  style='text-align:center;font-size: 27px'>&#129427;</option>
                                        <option value='&#129428;'  style='text-align:center;font-size: 27px'>&#129428;</option>
                                        <option value='&#129429;'  style='text-align:center;font-size: 27px'>&#129429;</option>
                                        <option value='&#129430;'  style='text-align:center;font-size: 27px'>&#129430;</option>
                                        <option value='&#129431;'  style='text-align:center;font-size: 27px'>&#129431;</option>
                                        <option value='&#129472;'  style='text-align:center;font-size: 27px'>&#129472;</option>
                                        <option value='&#129488;'  style='text-align:center;font-size: 27px'>&#129488;</option>
                                        <option value='&#129489;'  style='text-align:center;font-size: 27px'>&#129489;</option>
                                        <option value='&#129490;'  style='text-align:center;font-size: 27px'>&#129490;</option>
                                        <option value='&#129491;'  style='text-align:center;font-size: 27px'>&#129491;</option>
                                        <option value='&#129492;'  style='text-align:center;font-size: 27px'>&#129492;</option>
                                        <option value='&#129493;'  style='text-align:center;font-size: 27px'>&#129493;</option>
                                        <option value='&#129494;'  style='text-align:center;font-size: 27px'>&#129494;</option>
                                        <option value='&#129495;'  style='text-align:center;font-size: 27px'>&#129495;</option>
                                        <option value='&#129496;'  style='text-align:center;font-size: 27px'>&#129496;</option>
                                        <option value='&#129497;'  style='text-align:center;font-size: 27px'>&#129497;</option>
                                        <option value='&#129498;'  style='text-align:center;font-size: 27px'>&#129498;</option>
                                        <option value='&#129499;'  style='text-align:center;font-size: 27px'>&#129499;</option>
                                        <option value='&#129500;'  style='text-align:center;font-size: 27px'>&#129500;</option>
                                        <option value='&#129501;'  style='text-align:center;font-size: 27px'>&#129501;</option>
                                        <option value='&#129502;'  style='text-align:center;font-size: 27px'>&#129502;</option>
                                        <option value='&#129503;'  style='text-align:center;font-size: 27px'>&#129503;</option>
                                        <option value='&#129504;'  style='text-align:center;font-size: 27px'>&#129504;</option>
                                        <option value='&#129505;'  style='text-align:center;font-size: 27px'>&#129505;</option>
                                        <option value='&#129506;'  style='text-align:center;font-size: 27px'>&#129506;</option>
                                        <option value='&#129507;'  style='text-align:center;font-size: 27px'>&#129507;</option>
                                        <option value='&#129508;'  style='text-align:center;font-size: 27px'>&#129508;</option>
                                        <option value='&#129509;'  style='text-align:center;font-size: 27px'>&#129509;</option>
                                        <option value='&#129510;'  style='text-align:center;font-size: 27px'>&#129510;</option>
                                    </select>
                                </div>                                
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
        <script src="js/grupos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple.js"></script>        
        <script src="./vendor/sweetalert2/dist/sweetalert2.min.js"></script>
    </body>
</html>
