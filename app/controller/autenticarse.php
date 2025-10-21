<?php
    require_once __DIR__ . '/../core/config.php';
    class Autenticarse{

        public $data;
        public function __construct(){}

        public function default(){
            global $client;
            $this->data= $client->createAuthUrl();
            require_once './app/views/auth/auth.php';
        }
    }

?>