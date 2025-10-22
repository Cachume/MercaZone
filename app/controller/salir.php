<?php
    class Salir {
        public function default() {
            session_start();
            session_unset();
            session_destroy();
            header("Location: /MercaZone/");
            exit();
        }
    }