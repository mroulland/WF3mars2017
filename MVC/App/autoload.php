<?php
spl_autoload_register(function($className){
    $file = __DIR__ . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR
        . str_replace('\\', DIRECTORY_SEPARATOR, $className)
        . '.php'
    ;
   // DIRECTORY_SEPARATOR trouve le séparateur de répertoire propre à l'OS dédié  
    require $file;
    
});