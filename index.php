<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Blog</title>
	<style>
h1, h3{
    text-align:center;
}
h3{
    background-color:black;
    color:white;
    font-size:0.9em;
    margin-bottom:0px;
}
.news p{
    background-color:#CCCCCC;
    margin-top:0px;
}
.news{
    width:70%;
    margin:auto;
    background-color:lightgrey;
}

a{
    text-decoration: none;
    color: blue;
}
	</style>
</head>
<body>

<h1>Mon blog</h1>
<p>Les derniers billets du blog : </p>
<?php
//connection
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=Blog;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

//requête 
$req = $bdd->query('SELECT * FROM billets ORDER BY id DESC LIMIT 0,5');
//récupération
while ($donnees = $req->fetch()){
    echo '<div class="news"><p><h3>' . htmlspecialchars($donnees['titre']) .' le <em>' .htmlspecialchars($donnees['date_creation']) .'</em></h3></p>'. htmlspecialchars($donnees['contenu']) . '<br /><a href=\'commentaires.php?id='.$donnees['id'].'\'>Commentaires</a></div>';
}
$req->closeCursor();
?>







</body>
</html>