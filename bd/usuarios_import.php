<?php
    include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();



    function sanitize($cadena){
        $cadena = str_replace("'","",$cadena);
        $cadena = str_replace("`","",$cadena);
        $cadena = str_replace('"',"",$cadena);
        return $cadena;
    }


    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $login = (isset($_POST['login'])) ? sanitize($_POST['login']) : '';
    $name = (isset($_POST['name'])) ? sanitize($_POST['name']) : '';
    $avatar_url = (isset($_POST['avatar_url'])) ? sanitize($_POST['avatar_url']) : '';
    $email = (isset($_POST['email'])) ? sanitize($_POST['email']) : '';
    $company = (isset($_POST['company'])) ? sanitize($_POST['company']) : '';
    $blog = (isset($_POST['blog'])) ? sanitize($_POST['blog']) : '';
    $location = (isset($_POST['location'])) ? sanitize($_POST['location']) : '';
    $bio = (isset($_POST['bio'])) ? sanitize($_POST['bio']) : '';
    $twitter_username = (isset($_POST['twitter_username'])) ? sanitize($_POST['twitter_username']) : '';
    $follower = (isset($_POST['follower'])) ? $_POST['follower'] : '';
    $following = (isset($_POST['following'])) ? $_POST['following'] : '';

    $accion = "";
    try{
        //Valida si existe hace un update
        if (strlen($id) == 0){
            $query = "SELECT id, login, follower, following ".
                    "FROM USUARIO ".
                    "WHERE login=:login";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':login', $login, PDO::PARAM_STR);
            $resultado->execute();

            while($data = $resultado->fetch(PDO::FETCH_ASSOC)){
                $id = $data['id'];   
                if ($follower == 1){
                    $following = $data['following'];
                }else if ($following == 1){
                    $follower= $data['follower'];
                }
                break;
            }
        }

        $query = "";
        if (strlen($id) > 0){
            $query = "UPDATE USUARIO SET login='".$login."',  ".
                    "name='".$name."',  ".
                    "avatar_url='".$avatar_url."',  ".
                    "email='".$email."',  ".
                    "company='".$company."',  ".
                    "blog='".$blog."',  ".
                    "location='".$location."',  ".
                    "bio='".$bio."',  ".
                    "twitter_username='".$twitter_username."',  ".
                    "follower=".$follower.",  ".
                    "following=".$following."  ".
                    " WHERE id=:id";
            $resultado = $conexion->prepare($query);
            $resultado->bindParam(':id', $id, PDO::PARAM_INT);
            $accion = "Existe";
        } else {
            $query = "INSERT INTO USUARIO ".
                    "(id, login, name, email, avatar_url, ".
                    "company, blog, location, bio, twitter_username, ".
                    "follower, following) ".
                    "values ( ".
                    "0, '".$login."', '".$name."', '".$email."', '".$avatar_url."', ".
                    "'".$company."', '".$blog."', '".$location."', '".$bio."', '".$twitter_username."', ".
                    $follower.", ".$following.")";
            $resultado = $conexion->prepare($query);
            $accion = "Nuevo";
        }
        $resultado->execute();
        print "OK ".$accion;
    }catch(PDOException $e)    {
        print "Error Exception: ".$e->getMessage()." query: ".$query;
    }
    $conexion=null;
?>