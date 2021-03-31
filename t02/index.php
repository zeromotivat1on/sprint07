<?php
    
    session_start();

    if(isset($_POST['save_button'])) {

        header('Refresh:0');

    }

    if(isset($_POST['clear_button'])) {

        header('Refresh:0');

    }
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

    <h1>Password</h1>

    <?php

        if(isset($_POST['check_button']) && isset($_POST['check_password'])) {

            if(crypt($_POST['check_password'], $_SESSION['salt']) == $_SESSION['hashed_password']) {

                echo '<p style="color: green;">Hacked!</p>';
                unset($_SESSION['hashed_password']);
                unset($_SESSION['salt']);
                session_destroy();

            } else {

                echo '<p style="color: red;">Access denied!</p>';

            }

        }

    ?>

    <form action="index.php" method="post" <?php if(isset($_SESSION['hashed_password'])) {echo ' hidden';} else {echo ' display';} ?> >

        <span>Password not saved at session</span><br>
        <span>Password for saving to session</span><input name="password" required placeholder="Password to session"><br>
        <span>Salt for saving to session</span><input name="salt" required placeholder="Salt to session"><br>

        <input name="save_button" type="submit" value="Save">

    </form>

    <form action="index.php" method="post" <?php if(!isset($_SESSION['hashed_password'])) {echo ' hidden';} else {echo ' display';} ?> >

        <span>Password saved at session</span><br>
        <span>Hash is <span><?php echo $_SESSION['hashed_password'] ?></span></span><br>
        <span>Try to guess</span><input name="check_password" placeholder="Password to session"><input name="check_button" type="submit" value="Check password"><br>

        <input name="clear_button" type="submit" value="Clear">

    </form>

    <?php
   

        if(isset($_POST['save_button']) && isset($_POST['password']) && isset($_POST['salt'])) {

            $_SESSION['hashed_password'] = crypt($_POST['password'], $_POST['salt']);
            $_SESSION['salt'] = $_POST['salt'];

        }

        if(isset($_POST['clear_button'])) {

            session_destroy();
            
        }

    ?>
</body>

</html>