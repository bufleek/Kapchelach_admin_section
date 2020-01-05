<?php

abstract class db{
    public function connect(){
        $server  = "localhost";
        $user = "root";
        $password = "";
        $db = "kapchelach";
        
        $conn = new mysqli($server, $user, $password, $db);
        return $conn;
    }
}

