<?php
    function customAutoLoader( $class )
    {
        $class = ltrim($class, '\\');
        if (strpos($class,'\\') !== false) {
            $class = implode('/',
                array_map('ucfirst', explode('\\', $class))
            );
        }

        $file = rtrim(dirname(__FILE__), '/') . '/../' . $class . '.php';
        if ( file_exists($file) ) {
            require $file;
        } else {
            return;
        }
    }

    spl_autoload_register('customAutoLoader');
