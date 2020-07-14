
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

