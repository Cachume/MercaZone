<?php

    class MzDB{

        public static function conectar(){
            try {
                $conect = new PDO("mysql:host=localhost;dbname=mercazone", "root", "");
                return $conect;
            } catch (PDOException $e) {
                return false;
            }
        } 

    }



?>