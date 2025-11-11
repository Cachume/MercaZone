<?php

    class MzDB{

        public static function conectar(){
            try {
                $conect = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
                return $conect;
            } catch (PDOException $e) {
                return false;
            }
        } 

    }



?>