<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        .main {

            display: flex;

        }

        .inner {

            border: 1px double black;
            padding: 15px;

        }

    </style>

</head>

<body>

    <h1>Avenger Quote to XML</h1>

    <?php

        function autoload($pClassName) { 
            
            include(__DIR__. '/' . $pClassName. '.php'); 
        
        }

        spl_autoload_register("autoload");

        $avengerQuote1 = new AvengerQuote(228, "vasya", "shkila", [ "poc.jpg", "poc2.jpg" ]);
        $avengerQuote1->addComment("LOL");
        $avengerQuote1->addComment("kek");

        $avengerQuote2 = new AvengerQuote(1488, "flhhbgkvbn", "SOS", [ "photo.jpg" ]);
        $avengerQuote2->addComment("...");
        
        $avengerQuote4 = new AvengerQuote(333, "dyadya", "pamagite", [ "123", "help me" ]);
        $avengerQuote4->addComment("rofl");

        $listAvengerQuote = new ListAvengerQuotes();
        $listAvengerQuote->addAvengerQuote($avengerQuote1);
        $listAvengerQuote->addAvengerQuote($avengerQuote2);
        $listAvengerQuote->addAvengerQuote($avengerQuote4);
        $listAvengerQuote->toXML("file.xml");

        echo '<div class="main"><div class="inner">To XML<pre><br>';
        print_r($listAvengerQuote); 
        echo '</pre></div><div class="inner">From XML<pre><br>';
        print_r($listAvengerQuote->fromXML("file.xml"));
        echo '</pre></div>';

    ?>

</body>

</html>