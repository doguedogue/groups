<?php

    include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    
    try{
        $query = "DELETE FROM GRUPO WHERE id=:id";        
        $resultado = $conexion->prepare($query);
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado->execute();
        print "OK";
    }catch(PDOException $e)    {
        print "Error ".$e;
    }

    $conexion=null;

?>