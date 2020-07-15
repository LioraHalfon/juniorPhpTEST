<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8" />
	<title></title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<style>
     body {background-color:#e6ebef;}
     h5 {background-color:#8ebf42;}
    </style>
	
	<form method="GET">
	   <header>
	    <h5>My application <style="text-align:left;">      
       </header>
	   
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

