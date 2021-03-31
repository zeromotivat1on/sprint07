<?php

    session_start();

    if(isset($_POST['clear_button'])) {

        session_destroy();

    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>

    <h1>Charset</h1>

    <form action="index.php" method="post">

        <span>Change charset:</span><input name="string" placeholder="Input string"><br><br>
        <span>Select charset or several charsets:</span>

        <select multiple name="encode[]" size="3">

            <option>UTF-8</option>
            <option>ISO-8859-1</option>
            <option>Windows-1252</option>

        </select>

        <input name="change_charset_button" type="submit" value="Change charset" >
        <input name="clear_button" type="submit" value="Clear">

    </form><br>

    <?php

        if(isset($_POST['change_charset_button'])) {

            $_SESSION['string'] = $_POST['string'];
            
            $i = 0;
            while($_POST['encode'][$i]) {

                utf8_encode($_SESSION['string']);

                if($i == 0) {

                    echo 'Input string'.'<br>';

                    echo '<textarea>';
                    echo $_SESSION['string'];
                    echo '</textarea><br>';

                }

                if($_POST['encode'][$i]) {

                    echo $_POST['encode'][$i].'<br>';
                    echo '<textarea>';
                    if($i == 0)
                        echo $_SESSION['string'];
                    else if($i == 1)
                        echo iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $_SESSION['string']);
                    else if($i == 2)
                        echo iconv('UTF-8', 'Windows-1252', $_SESSION['string']);
                    echo '</textarea><br>';

                }

                $i++;
            }

        }
    
    ?>


</body>

</html>