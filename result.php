<?php
// 1. Tell the browser to expect an image
header('Content-Type: image/jpeg');

// 2. Get the filename from the URL and locate the image
if (isset($_GET['file'])) {
    $imgname = "images/" . $_GET['file'] . ".jpg";
    $img = imagecreatefromjpeg($imgname);

    // 3. Apply the width query string (Step 3) - default to 100 if missing
    $w = isset($_GET['width']) ? intval($_GET['width']) : 100;
    $newimg = imagescale($img, $w, $w);

    // 4. Set up the font and color for the meme text
    $fontFile = realpath('font/Lato-Medium.ttf');
    $textColor = imagecolorallocate($newimg, 255, 255, 255); // White text

    // 5. Add Meme 1 Text (from the form inputs)
    if (isset($_GET['text1']) && !empty($_GET['text1'])) {
        $size1 = isset($_GET['size1']) ? intval($_GET['size1']) : 24;
        imagettftext($newimg, $size1, 0, 10, 50, $textColor, $fontFile, $_GET['text1']);
    }

    // 6. Add Meme 2 Text (from the form inputs)
    if (isset($_GET['text2']) && !empty($_GET['text2'])) {
        $size2 = isset($_GET['size2']) ? intval($_GET['size2']) : 48;
        // Positioned lower on the image
        imagettftext($newimg, $size2, 0, 10, $w - 20, $textColor, $fontFile, $_GET['text2']);
    }

    // 7. Output the final processed image to the browser
    imagejpeg($newimg);
}
?>