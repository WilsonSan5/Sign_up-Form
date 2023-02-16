<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="design/default.css">
	<link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

	<?php
	session_start();
	include('src/header.php');
	require('connect.php')
		?>

	<section>
		<div id="login-body">
			<h1>S'identifier</h1>

			<form method="post" action="index.php">
				<?php
				if (isset($_GET['inscription'])) {
					echo "<p class='alert success'>Inscription réussie. </p>";
				}
				;
				if (isset($_POST['email']) && isset($_POST['password'])) {
					$email = $_POST['email'];
					$password = sha1($_POST['password']);

					$get_request = $db->prepare('SELECT * FROM users WHERE email = ?');
					$get_request->execute(array($email)); // Il va selectionner le password de la ligne contenant $email
				

					$user = $get_request->fetch(); // La je met la ligne dans une variable $user sous forme de tableau.
					if ($user != false) {
						if ($user['password'] == $password) {
							if ($user['status'] == 'client') {
								header("location: bienvenue.php?email=$email");
							} else if ($user['status'] == 'admin')
								header("location: admin_page.php?email=$email");
						} else
							echo "<p class='alert error'>Mot de passe incorrect.</p>";
					} else
						echo "<p class='alert error'>Email incorrect.</p>";
				}
				?>
				<input type="email" name="email" placeholder="Votre adresse email" required />
				<input type="password" name="password" placeholder="Mot de passe" required />
				<button type="submit">S'identifier</button>
				<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>
			</form>
			<p class="grey">Première visite sur Netflix ? <a href="inscription.php">Inscrivez-vous</a>.</p>
		</div>
	</section>

</body>

</html>