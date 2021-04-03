<?php

    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        table, table th, table td {

            border: 1px solid black;

        }

    </style>

</head>

<body>

    <h1>Parsing CSV data</h1>

    <form method="post">

        <span>Upload file:</span>
        <input type="file" name="file">
        <input type="submit" value="Upload">

    </form>

    <?php

        if ($_POST["file"] || $_SESSION["file"]) {

            echo '<form method="get"> <span>Filter:</span> <select name="filter">';

                if ($_GET["filter"]) {  

                    if ($_GET["filter"] == "NOT SELECTED") {

                        echo '<option selected value="NOT SELECTED">NOT SELECTED</option>';

                    } else {
                        
                        echo '<option value="NOT SELECTED">NOT SELECTED</option>';

                    }

                    if ($_GET["filter"] == "good") {

                        echo '<option selected value="good">good</option>';

                    } else {
                        
                        echo '<option value="good">good</option>';

                    }

                    if ($_GET["filter"] == "bad") {
                        
                        echo '<option selected value="bad">bad</option>';

                    } else {
                        
                        echo '<option value="bad">bad</option>';

                    }

                    if ($_GET["filter"] == "-") {
                        
                        echo '<option selected value="-">-</option>';

                    } else {
                        
                        echo '<option value="-">-</option>';

                    } 
                    
                    if ($_GET["filter"] == "neutral") {
                        
                        echo '<option selected value="neutral">neutral</option>';

                    } else {
                        
                        echo '<option value="neutral">neutral</option>';

                    }

                } else {

                    echo '<option value="NOT SELECTED">NOT SELECTED</option>
                    <option value="good" selected>good</option>
                    <option value="bad">bad</option>
                    <option value="-">-</option>
                    <option value="neutral">neutral</option>';

                }

            echo '</select> <input type="submit" name="apply" value="APPLY"> </form>';

            $filter = "NOT SELECTED";

            if ($_GET["filter"]) {

                $filter = $_GET["filter"];

            }

            if ($_POST["file"]) {

                $_SESSION = Array();

            }

            if (!$_SESSION["file"]) {

                $_SESSION["file"] = $_POST["file"];

            }

            $newFile = fopen($_SESSION["file"], "r");

            echo '<table>';
            if ($csv = fgetcsv($newFile)) {

                echo '<tr>';
                foreach($csv as $v) {

                    echo '<th>'.$v."</th>";

                }
                echo '</tr>';

            }

            while ($csv = fgetcsv($newFile)) {

                if (($filter == "good" && $csv[2] != "good") || ($filter == "bad" && $csv[2] != "bad") ||
                    ($filter == "-" && $csv[2] != "-") || ($filter == "neutral" && $csv[2] != "neutral")) {

                        continue;

                    }

                echo '<tr>';
                foreach($csv as $v) {

                    echo '<td>' . $v . "</td>";

                }
                echo '</tr>';
                
            }
            echo '</table>';

            fclose($newFile);
            
        }

    ?>

</body>

</html>