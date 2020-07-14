<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title></title>
</head>
<body>

	<form method="GET">
	   <input type="search" name="q" placeholder="Recherche..." />
	   <input type="submit" value="Valider" />
	</form>

</body>
</html>

<?php
	$url = "https://api.androidhive.info/json/movies.json";

	if(isset($_GET['q']) AND !empty($_GET['q'])) {
	   $q = htmlspecialchars($_GET['q']);

	   $articles = json_decode(file_get_contents($url), true);
	   $articles = array_filter($articles, function($article) use ($q) {
	   	return strpos(strtolower($article['title']), strtolower($q)) !== false;
	   });
	}
?>

<?php if($articles && count($articles) > 0) { ?>
   <ul>
		<?php 
		/*
		while($a = $articles->fetch()) { ?>
		  <li><?= $a['titre'] ?></li>
		<?php 
		} */

		foreach ($articles as $a) { ?>
		  <li><?php echo $a['title'] ?> <br/>
          <?php
            $image = $a['image'] ;
            print '<img src="'.$image.'" width="200" height="150" alt="texte alternatif" />';?> <br/>
		  <?php echo $a['rating'] ?> /10 <br/>
		  <?php echo $a['releaseYear'] ?> </li> <br/>
		<?php 
		}
		?>
   </ul>
<?php } else { ?>
	Aucun résultat pour: <?= $q ?>...
<?php } ?>

