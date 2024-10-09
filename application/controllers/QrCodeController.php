<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

use BaconQrCode\Renderer\ImageRenderer; // Esta línea está correcta
use BaconQrCode\Renderer\Image\ImagickImageBackEnd; // Esta línea está correcta
use BaconQrCode\Renderer\RendererStyle\RendererStyle; // Esta línea está correcta
use BaconQrCode\Writer; // Esta línea está correcta

class QrCodeController extends CI_Controller {

    public function generate() {
        // Crear el renderer
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);

        // Generar el código QR
        $writer->writeFile('Test QR Code', 'qrcode.png');

        // Mostrar mensaje de éxito
        echo "Código QR generado exitosamente en formato PNG.";
    }
}
