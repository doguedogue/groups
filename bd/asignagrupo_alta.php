<?php

    include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();

    

    $id_grupo = (isset($_POST['id_grupo'])) ? $_POST['id_grupo'] : '';
    $arreglo_usuarios = (isset($_POST['arreglo_usuarios'])) ? $_POST['arreglo_usuarios'] : '';

    $conexion->beginTransaction();    
    try{
        $query = "";
        if (strlen($id_grupo) > 0){
            foreach($arreglo_usuarios as $id_usuario){
                $query = "INSERT INTO grupo_usuario (id, id_usuario, id_grupo)".
                    " VALUES(0, ".$id_usuario.", '".$id_grupo."')";
                $resultado = $conexion->prepare($query);
                $resultado->execute();
            }
        }
        $conexion->commit();
        print "OK";         
    }catch(PDOException $e)    {
        $conexion->rollBack();
        print "Error Exception: ".$e->getMessage()." query: ".$query;;
    }
    $conexion=null;
?>