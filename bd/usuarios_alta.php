<?php
     include_once 'conexion.php';
    $objconexion = new Conexion();

    $conexion = $objconexion->Conectar();

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $login = (isset($_POST['login'])) ? $_POST['login'] : '';
    $name = (isset($_POST['name'])) ? $_POST['name'] : '';
    $avatar_url = (isset($_POST['avatar_url'])) ? $_POST['avatar_url'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $company = (isset($_POST['company'])) ? $_POST['company'] : '';
    $blog = (isset($_POST['blog'])) ? $_POST['blog'] : '';
    $location = (isset($_POST['location'])) ? $_POST['location'] : '';
    $bio = (isset($_POST['bio'])) ? $_POST['bio'] : '';
    $twitter_username = (isset($_POST['twitter_username'])) ? $_POST['twitter_username'] : '';
    $follower = (isset($_POST['follower'])) ? $_POST['follower'] : '';
    $following = (isset($_POST['following'])) ? $_POST['following'] : '';

    try{
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
        }
        $resultado->execute();
        print "OK query: ".$query;
    }catch(PDOException $e)    {
        print "Error Exception: ".$e->getMessage()." query: ".$query;
    }
    $conexion=null;
?>