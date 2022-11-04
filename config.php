<?php

    //Banco de dados
    define('HOST','localhost');
    define('DATABASE','suporte_personalizado');
    define('USER','root');
    define('PASSWORD','');

    define('INCLUDE_PATH','http://localhost/Desenvolvimento_Web_completo/02-Projeto-Suporte-Personalizado/');

    $autoload = function($class){
        include('Class/'.$class.'.php');
    };
    spl_autoload_register($autoload);

?>