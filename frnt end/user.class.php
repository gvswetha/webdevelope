<?php

include_once 'db.class.php';


class user
{
    public static function signup($user, $email, $password, $reenterpassword)
    {
        $conn = Database::getconnection();
    
        $sql = "INSERT INTO 'reg' ('username', 'email', 'password', 'reenterpassword')
        VALUES ('$user', '$email', '$password', '$reenterpassword')";
    
        $result = false;
        if ($conn->query($sql) == true){
            $result = true;
        }else{
            
            echo "Error: ". $sql . < br> . $conn ->error;
            $result = false;
        }
    
        $conn->close();
        return $result;
    
    }

}