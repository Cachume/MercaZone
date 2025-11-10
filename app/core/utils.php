<?php

class UtilsZone{
    
    public static function instaMessage($type = 'error', $title,$text){
        $_SESSION['alert'] = [
            'type' => $type,
            'title' => $title,
            'text' => $text
        ];
    }
}