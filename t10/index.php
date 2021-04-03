<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Document</title>

</head>

<body>
    
    <h1>Make square image</h1>

    <form action="index.php" method="post">

        <input type="url" name="img_url" placeholder="Image url...">
        <input type="submit" name="go" value="Go">

    </form>

    <?php
    
        if(isset($_POST['img_url']) && isset($_POST['go'])) {

            $url = $_POST['img_url'];
            $intial = 'intial';



            $ch = curl_init($url);
            $fp = fopen($intial, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            if(strpos($url, '.jpg') || strpos($url, '.jpeg')) {

                $temp = imagecreatefromjpeg($intial);
                $sizex = imagesx($temp);
                $sizey = imagesy($temp);
                $res = imagecreatetruecolor($sizex * 2, $sizey * 2);

                imagecopyresampled($res, $temp, 0, 0, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefromjpeg($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 255, 0, 0);
                imagecopyresampled($res, $temp, $sizex, 0, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefromjpeg($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 0, 255, 0);
                imagecopyresampled($res, $temp, 0, $sizey, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefromjpeg($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 0, 0, 255);
                imagecopyresampled($res, $temp, $sizex, $sizey, 0, 0, $sizex, $sizey, $sizex, $sizey);

                imagejpeg($res, "res.jpg");

                echo '<img src="res.jpg">';

            } else if(strpos($url, '.png')) {

                $temp = imagecreatefrompng($intial);
                $sizex = imagesx($temp);
                $sizey = imagesy($temp);
                $res = imagecreatetruecolor($sizex * 2, $sizey * 2);

                imagecopyresampled($res, $temp, 0, 0, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefrompng($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 255, 0, 0);
                imagecopyresampled($res, $temp, $sizex, 0, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefrompng($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 0, 255, 0);
                imagecopyresampled($res, $temp, 0, $sizey, 0, 0, $sizex, $sizey, $sizex, $sizey);

                $temp = imagecreatefrompng($intial);
                imagefilter($temp, IMG_FILTER_COLORIZE, 0, 0, 255);
                imagecopyresampled($res, $temp, $sizex, $sizey, 0, 0, $sizex, $sizey, $sizex, $sizey);

                imagepng($res, "res.jpg");

                echo '<img src="res.jpg">';

            }
        }

    ?>

</body>

</html>