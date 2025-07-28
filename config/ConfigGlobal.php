<?php

$config = [
    'URL' => 'http://localhost/certificados/',    
];

class Config{
    public static function ruta(){    
        global $config;
        return $config['URL'];   
    }
    
}

// titulo de la pagina
class Titulo{
    public static function titulo(){       
        return 'Jaidec';
    }
    
}

// pagina que aparece en el certificado
class Web {
    public static function web(){       
        return 'www.devcayao.com/certificado';
    }
    
}


?>