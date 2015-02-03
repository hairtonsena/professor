<?php

require 'manipular_imagem/lib/WideImage.php';

class manipular_imagem {

//    public function __construct() {
//        parent::__construct();
//    }

    public function criar_miniatura_imagem($image=NULL,$pasta_destino=NULL) {
        
        $img = WideImage::load($image);

        $red = $img->resize('200', '200', 'outside');

        $cropped = $red->crop("center", "middle", 200, 150);

        $cropped->saveToFile($pasta_destino, 100);

    }

}
?>

