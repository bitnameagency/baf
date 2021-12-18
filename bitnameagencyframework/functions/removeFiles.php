<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

    function removeFiles($dir, $hiddingTime = null)
    {
        // dizin kontrol
        if (is_dir($dir)) {
 
            // klasörü tara
            $objects = scandir($dir);
 
            // klasördeki nesneler için döngü
            foreach ($objects as $object) {
 
                if ($object != "." && $object != "..") {
 
                    if (filetype($dir . "/". $object) == "dir") {
 
                        // recursive işlev çağrımı
                        $this->removeFiles($dir . "/" . $object);
                    }
                    else {
 
                        // dosya adresini al
                        $file = $dir . "/" . $object;
 
                        if(is_file($file)) {
 
                            // dosyayı sil
                            unlink($file);
                        }
                    }
                }
            }
        }
    }