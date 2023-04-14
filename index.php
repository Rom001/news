<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
	<title>Bienvenue sur mon site</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
		h1,
		h3 {
			text-align: center;
		}

		h3 {
			background-color: black;
			color: white;
			font-size: 0.9em;
			margin-bottom: 0px;
		}

		.news p {
			background-color: #CCCCCC;
			margin-top: 0px;
		}

		.news {
			width: 70%;
			margin: auto;
		}
	</style>
</head>

<body>
	<h1>Bienvenue sur mon site !</h1>
	<p>Voici les dernières news :</p>

	<?php
	$mysqli = mysqli_connect("localhost", "root", "root","test_news");
	// Check connection
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}

	//mysqli_select_db("test");
	// On récupère les cinq dernières news.
	$retour = mysqli_query($mysqli, "SELECT * FROM news ORDER BY timestamp DESC LIMIT 0, 5");

	while ($donnees = mysqli_fetch_array($retour)) {
	?>
		<div class="news">
			<h3>
				<?php echo $donnees['titre']; ?>
				<em>le <?php echo date('d/m/Y à H\hi', $donnees['timestamp']); ?></em>
			</h3>

			<p>
				<?php
				// On enlève les éventuels antislashs, PUIS on crée les entrées en HTML (<br />).
				$contenu = nl2br(stripslashes($donnees['contenu']));
				echo $contenu;
				?>
			</p>
		</div>
	<?php
	} // Fin de la boucle des <italique>news</italique>.
	?>
</body>

</html>