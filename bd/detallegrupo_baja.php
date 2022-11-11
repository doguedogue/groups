<?php

    include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';

    $conexion->beginTransaction();
    try{
        $query = "DELETE FROM GRUPO_USUARIO WHERE id=:id";        
        $resultado = $conexion->prepare($query);
        $resultado->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado->execute();
    }catch(PDOException $e)    {
        $conexion->rollBack();
        print "Error Exception: ".$e->getMessage();
        return;
    }
    

    $conexion->commit();
    print "OK";
    $conexion=null;
?>