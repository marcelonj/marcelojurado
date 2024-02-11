<?php
    spl_autoload_register(function ($clase){
        $ruta= str_replace("\\","/",$clase).".php";
        if(is_readable($ruta)){
            require_once $ruta;
        }
        else{
            throw new Exception("No se encontró la clase {$clase}");
        };
    });

    use app\Conexion;

    $test= new Conexion;

    $test->prueba_consulta();
?>