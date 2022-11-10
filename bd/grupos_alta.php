<?php
     include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $icon = (isset($_POST['icon'])) ? $_POST['icon'] : '';

    try{
        $query = "";
        if (strlen($id) > 0){
            $query = "UPDATE GRUPO SET nombre='".$nombre."',  ".
                "icon='".$icon."'  ".
                " WHERE id=:id";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $query = "INSERT INTO GRUPO (id, nombre, icon) ".
                "values (0, '".$nombre."', '".$icon."')";
            $resultado = $conexion->prepare($query);
        }
        $resultado->execute();
        print "OK";
    }catch(PDOException $e)    {
        print "Error Exception: ".$e->getMessage();
    }
    $conexion=null;
?>