<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

	<?php include('src/header.php'); ?>
	<?php require('connect.php'); ?>

	<section>
		<div id="login-body">
			<h1>S'inscrire</h1>

			<form method="post" action="inscription.php">
				<?php

				if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_two'])) {
					$email = $_POST['email'];
					$password = $_POST['password'];
					;
					$sql_request = $db->prepare('SELECT email FROM users WHERE email = ?');
					$sql_request->execute(array($email));

					$email_db = $sql_request->fetch();
					if ($email_db == true) {
						echo '<p class="alert warning">L\'adresse e-mail est déjà utilisée. </p> ';
					} else if ($_POST['password'] !== $_POST['password_two']) {
						echo "<p class='alert error'>Les mots de passe ne sont pas identique.</p>";
					} else if (Strlen($password) <= 2) {
						echo "<p class='alert warning'>Le mot de passe n'est pas assez long.</p>";
					} else {
						$password = sha1($_POST['password']);
						$insert_request = $db->prepare('INSERT INTO users(email,password,status) VALUES (?,?,?)');
						$insert_request->execute(array($email, $password, 'client'));

						header('location: index.php?inscription=1');
					}
				}

				?>
				<input type="email" name="email" placeholder="Votre adresse email" required />
				<input type="password" name="password" placeholder="Mot de passe" required />
				<input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />

				<button type="submit">S'inscrire</button>
			</form>

			<p class="grey">Déjà sur Netflix ? <a href="index.php">Connectez-vous</a>.</p>
		</div>
	</section>


	<?php include('src/footer.php'); ?>
</body>

</html>