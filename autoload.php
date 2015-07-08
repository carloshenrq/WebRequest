<?php

try
{
    spl_autoload_register(function($class) {
        $class = str_replace('\\', '/', __DIR__ . '/'.$class.'.php');

        if( is_file( $class ) && file_exists($class) )
        {
            require_once $class;
        }

    }, true);
}
catch(Exception $ex)
{
    echo $ex->getMessage();
    exit;
}
