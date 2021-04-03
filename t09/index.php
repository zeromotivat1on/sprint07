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
    
    <h1 class="main_header">Comics from Marvel API</h1>

    <?php
    
        $api_base = "http://gateway.marvel.com/v1/public/comics?";
        $time = time();
        $public_key = "83c7e9d18759bd3682df58b2a610a798";
        $private_key = "fa65a9720e0ffc79162770b42b96c019dd98ebd8";
        $hash = md5($time.$private_key.$public_key);

        $api = $api_base."ts=".$time."&apikey=".$public_key."&hash=".$hash;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $json = curl_exec($curl);
        curl_close($curl);
        echo(parse_json(json_decode($json, true)));

        function parse_json($json) {

            $res = '<div class="block">';
            foreach ($json as $k => $v) {

                if (is_array($v)) {

                    $res .= "<span class=\"header\"><br>$k:</span>";
                    $res .= parse_json($v);

                } else {

                    $res .= "<div class=\"line\"> <span class=\"key\">$k: </span> <span class=\"value\">$v</span> </div>";

                }

            }

            $res .= "</div>";
            return $res;

        }

    ?>

</body>

</html>