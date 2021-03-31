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
    
        .hidden {

            display: none;

        }

        .display {

            display: flex;

        }
    
    </style>
    
</head>

<body>

    <h1>Session for new</h1>

    <form action="index.php" method="post" style="border: 1px solid black; padding: 40px 20px 30px;"
        <?php if(isset($_POST['send_button'])) {echo ' hidden';} else {echo ' display';} ?> >

        <div style="border: 1px solid black; padding: 20px 10px;">

            <span style="position:absolute; top: 108px; padding: 5px; background-color: white;">About candidate</span><br>

            <span>Real Name</span>
            <input type="text" name="name" required placeholder="Tell your name"></input>
            <span>Current Alias</span>
            <input type="text" name="alias" placeholder="Tell your alias"></input>
            <span>Age</span>
            <input type="number" name="age" size="6" min="1" max="999" step="1"></input><br><br>
            <span>About</span>
            <textarea rows="5" cols="52" name="description" maxlength="500" placeholder="Tell about yourself, max 500 symbols"></textarea><br><br>
            <span>Photo:</span>
            <input type="file" name="photo"> </input>

        </div><br>

        <div style="border: 1px solid black; padding: 20px 10px;">

            <span style="position:absolute; top: 350px; padding: 5px; background-color: white;">Powers</span><br>

            <input type="checkbox" name="strength">Strength</input>
            <input type="checkbox" name="speed">Speed</input>
            <input type="checkbox" name="intelligence">Intelligence</input>
            <input type="checkbox" name="teleportation">Teleportation</input>
            <input type="checkbox" name="immortal">Immortal</input>
            <input type="checkbox" name="another">Another</input><br><br>

            <input type="range" value="0" name="control_lvl">Level of control</input>

        </div><br>

        <div style="border: 1px solid black; padding: 20px 10px;">

            <span style="position:absolute; top: 487px; padding: 5px; background-color: white;">Publicity</span><br>

            <input type="radio" name="publicity">UNKNOWN</input>
            <input type="radio" name="publicity">LIKE A GHOST</input>
            <input type="radio" name="publicity">I AM IN COMICS</input>
            <input type="radio" name="publicity">I HAVE FUN CLUB</input>
            <input type="radio" name="publicity">SUPERSTAR</input>

        </div><br>

        <input name="clear_button" type="reset" value="CLEAR">
        <input name="send_button" type="submit" value="SEND"></input>

    </form><br>

    <form action="index.php" method="post"
        <?php if(!isset($_POST['send_button'])) {echo ' hidden';} else {echo ' display';} ?> >

        <div style="padding-left: 40px;">

            <?php

                if(isset($_POST['send_button'])) {

                    send_button();
                    
                }

                function send_button() {

                    $arr = [
                        "name" => $_POST["name"] ? $_POST["name"] : "does not have",
                        "alias" => $_POST["alias"] ? $_POST["alias"] : "does not have",
                        "age" => $_POST["age"] ? $_POST["age"] : "does not have",
                        "description" => $_POST["description"] ? $_POST["description"] : "does not have",
                        "strength" => $_POST["strength"] ? "has" : "does not have",
                        "speed" => $_POST["speed"] ? "has" : "does not have",
                        "intelligence" => $_POST["intelligence"] ? "has" : "does not have",
                        "teleportation" => $_POST["teleportation"] ? "has" : "does not have",
                        "immortal" => $_POST["immortal"] ? "has" : "does not have",
                        "another" => $_POST["another"] ? "another" : "does not have",
                        "level" => $_POST["control_lvl"] ? ($_POST["control_lvl"] / 10) : "does not have",
                        "publicity" => $_POST["publicity"] ? $_POST["publicity"] : "does not have",
                    ];

                    $_SESSION["form_data"] = $arr;
                    
                    if($_SESSION["form_data"]) {
                        
                        foreach($_SESSION["form_data"] as $key => $value) {

                            echo $key.": ".$value."<br>";

                        }

                    }

                }

                if(isset($_POST['forget_button'])) {

                    forget_button();
                    
                }

                function forget_button() {

                    session_destroy();

                }

            ?>

        </div>

        <div style="border: 1px solid black; padding: 20px; margin-top: 20px;">

            <input name="forget_button" type="submit" value="FORGET">

        </div>

    </form>

</body>

</html>