<?php

// SET ´GD LIBRARY TO IGNORE JPEG ERRORS
// ini_set("gd.jpeg_ignore_warning", 1);

// RESIZE AN IMAGE PROPORTIONALLY AND CROP TO THE CENTER
function resize_and_crop($original_image_url, $thumb_image_url, $thumb_w, $thumb_h, $quality = 100)
{
    // ACQUIRE THE ORIGINAL IMAGE: http://php.net/manual/en/function.imagecreatefromjpeg.php
    $original = imagecreatefromjpeg($original_image_url);
    if (!$original) return FALSE;

    // GET ORIGINAL IMAGE DIMENSIONS
    list($original_w, $original_h) = getimagesize($original_image_url);

    // RESIZE IMAGE AND PRESERVE PROPORTIONS
    $thumb_w_resize = $thumb_w;
    $thumb_h_resize = $thumb_h;
    if ($original_w > $original_h)
    {
        $thumb_h_ratio  = $thumb_h / $original_h;
        $thumb_w_resize = (int)round($original_w * $thumb_h_ratio);
    }
    else
    {
        $thumb_w_ratio  = $thumb_w / $original_w;
        $thumb_h_resize = (int)round($original_h * $thumb_w_ratio);
    }
    if ($thumb_w_resize < $thumb_w)
    {
        $thumb_h_ratio  = $thumb_w / $thumb_w_resize;
        $thumb_h_resize = (int)round($thumb_h * $thumb_h_ratio);
        $thumb_w_resize = $thumb_w;
    }

    // CREATE THE PROPORTIONAL IMAGE RESOURCE
    $thumb = imagecreatetruecolor($thumb_w_resize, $thumb_h_resize);
    if (!imagecopyresampled($thumb, $original, 0,0,0,0, $thumb_w_resize, $thumb_h_resize, $original_w, $original_h)) return FALSE;

    // ACTIVATE THIS TO STORE THE INTERMEDIATE IMAGE
    // imagejpeg($thumb, 'RAY_temp_' . $thumb_w_resize . 'x' . $thumb_h_resize . '.jpg', 100);

    // CREATE THE CENTERED CROPPED IMAGE TO THE SPECIFIED DIMENSIONS
    $final = imagecreatetruecolor($thumb_w, $thumb_h);

    $thumb_w_offset = 0;
    $thumb_h_offset = 0;
    if ($thumb_w < $thumb_w_resize)
    {
        $thumb_w_offset = (int)round(($thumb_w_resize - $thumb_w) / 2);
    }
    else
    {
        $thumb_h_offset = (int)round(($thumb_h_resize - $thumb_h) / 2);
    }

    if (!imagecopy($final, $thumb, 0,0, $thumb_w_offset, $thumb_h_offset, $thumb_w_resize, $thumb_h_resize)) return FALSE;

    // STORE THE FINAL IMAGE - WILL OVERWRITE $thumb_image_url
    if (!imagejpeg($final, $thumb_image_url, $quality)) return FALSE;
    return TRUE;
}

/*foreach (glob("*") as $file) {
    if($file == '.' || $file == '..') continue;
    # print $file . '<br>';
    resize_and_crop($file, $file.'_289x210.jpg', 289, 210);
    resize_and_crop($file, $file.'_370x445.jpg', 370, 445);
    resize_and_crop($file, $file.'_420x250.jpg', 420, 250);
    resize_and_crop($file, $file.'_620x350.jpg', 620, 350);
}*/

/*foreach (glob("*.jpg") as $arquivo) {
    $nameWithoutExtensionJPG = str_replace('.jpg', '', $arquivo);
    resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_289x210.jpg', 289, 210);    
    # resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_370x445.jpg', 370, 445);
    # resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_420x250.jpg', 420, 250);
    # resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_620x350.jpg', 620, 350);
}*/

/*foreach (glob("*.jpg") as $arquivo) {
    $nameWithoutExtensionJPG = str_replace('.jpg', '', $arquivo);
    resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_100x100.jpg', 100, 100);
    # resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_200x100.jpg', 200, 100);
    # resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_200x300.jpg', 200, 300);
}*/

/*foreach (glob("*.jpg") as $arquivo) {
    $nameWithoutExtensionJPG = str_replace('.jpg', '', $arquivo);
    resize_and_crop($arquivo, $nameWithoutExtensionJPG.'_100x100.jpg', 100, 100);
}*/

/*$formatos = array('png','jpg','jpge','gif');

foreach(glob('*.{'.implode(',', $formatos).'}', GLOB_BRACE) as $imagem){
    resize_and_crop($imagem, $imagem.'_100x100.jpg', 100, 100);
    # print $imagem . "<br/>";
}*/

resize_and_crop('aaa66479e46920568f25ea83046e9b2f.jpg', '_teste_100x100.jpg', 100, 100);
/*resize_and_crop('5ff4d6b8aade359acaba3fc5bdd930db.jpg', '5ff4d6b8aade359acaba3fc5bdd930db_289x210.jpg', 289, 210);    
resize_and_crop('5ff4d6b8aade359acaba3fc5bdd930db.jpg', '5ff4d6b8aade359acaba3fc5bdd930db_370x445.jpg', 370, 445);    
resize_and_crop('5ff4d6b8aade359acaba3fc5bdd930db.jpg', '5ff4d6b8aade359acaba3fc5bdd930db_420x250.jpg', 420, 250);    
resize_and_crop('5ff4d6b8aade359acaba3fc5bdd930db.jpg', '5ff4d6b8aade359acaba3fc5bdd930db_620x350.jpg', 620, 350);    
*/

/*$img = imagecreatefromjpeg('5ff4d6.jpeg');
if (!$img) {
    printf("Failed to load jpeg image \"%s\".\n", $file);
    die();
}*/

/*
$dir = "*.jpg";*/

/*// Pega todas as imagens do tipo jpg e coloca dentro de uma array com nome $images
$images = glob($dir);

// Roda todas as imagens do array $images
foreach($images as $image):
    echo "<img src='" . $image . "' />";
    resize_and_crop("5ff4d6.jpg", "teste_100x100.jpg", 100, 100);
    // Apenas um exemplo de código aqui dentro do loop
    // Coloca a função resize_and_crop() aqui dentro.
endforeach;