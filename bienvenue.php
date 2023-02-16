<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Netflix</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
    <link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

    <?php
    include('src/header.php');

    require('user.php');
    require('connect.php');
    ?>
    <?php

    $email = $_GET['email'];
    $get_request = $db->prepare('SELECT * FROM users WHERE email = ?');
    $get_request->execute(array($email)); // Il va selectionner le password de la ligne contenant $email
    $user = $get_request->fetch(); // La je met la ligne dans une variable $user sous forme de tableau.
    
    $user_object = new user($user['id'], $user['email'], $user['password'], $user['status']);
    echo 'Compte ' . $user_object->get_status();
    ?>

    <section>
        <div class='container'>
            <h1 class='alert'>Bienvenue
                <?php echo $user_object->get_email() ?>
            </h1>
            <form method="post" action="account_setting.php">
                <input type="hidden" name="email" value='<?php echo $user_object->get_email() ?>'>
                <input type="hidden" name="id" value='<?php echo $user_object->get_id() ?>'>
                <button id='btn_setting' type="submit"> Espace Client</button>
            </form>
        </div>

    </section>





    <?php include('src/footer.php'); ?>
</body>

</html>