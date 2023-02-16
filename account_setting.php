<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Netflix</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
    <link rel="icon" type="image/pngn" href="img/favicon.png">
</head>


<body>
    <section>
        <div id="login-body">
            <h1>Espace client</h1>
            <?php
            include('connect.php');
            include('user.php');
            $id = $_POST['id'];
            if (isset($_POST['new_email'])) {
                $new_email = $_POST['new_email'];
                $get_request = $db->prepare('SELECT * FROM users WHERE email = ?');
                $get_request->execute(array($new_email));
                $user = $get_request->fetch(); // La je met la ligne dans une variable $user sous forme de tableau.
                if ($user == true) {
                    echo '<p class="alert warning">Email déjà utilisé.</p>';
                } else
                    echo '<p class="alert success">Email mis à jour.</p>';
                $get_request = $db->prepare('UPDATE users SET email = ? WHERE id = ?');
                $get_request->execute(array($new_email, $id));
            }
            ;
            ?>
            <form method="post" action="account_setting.php">
                <input type="email" name="new_email" placeholder="Nouvelle adresse email" required />
                <input type="password" name="password" placeholder="Nouveau mot de passe" />
                <input type="password" name="password_two" placeholder="Retapez votre mot de passe" />
                <input type="hidden" name="id" value='<?php echo $id ?>'>
                <button type="submit">Modifier</button>
            </form>
            <p class="grey"><a href="Bienvenue.php">Retour</a></p>
        </div>
    </section>
</body>