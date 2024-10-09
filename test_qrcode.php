<?php

require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta




use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

$renderer = new ImageRenderer(
    new RendererStyle(200),
    new ImagickImageBackEnd()
);
$writer = new Writer($renderer);

$qr_image = base64_encode($writer->writeString($string));
