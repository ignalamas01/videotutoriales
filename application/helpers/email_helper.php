<?php 
    function enviarEmail($emailDestinatario,$asunto,$contenido,$adjunto=""){
        try{
            //proceso de nevio de correo
            $CI=&get_instance();//generando instanacia de codignaiter
            $CI->load->library('email');//cargado de la libreria email
            $configuracionCorreo = array(
                'protocol'=>'smtp',
                'smtp_host'=>'smtp.gmail.com',
                'smtp_port'=>'587',
                '_smtp_auth'=>TRUE,
                'smtp_crypto'=>'tls',
                'smtp_user' => 'poner_correo',
                'smtp_pass' => 'poner_clave',
            )
        }
    }







?>



