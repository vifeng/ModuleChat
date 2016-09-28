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

$new=htmlspecialchars(extract($_POST), ENT_QUOTES);
intval($id_billet);
if (isset($new) && !empty($new) && $id_billet>0 && !empty($auteur) && ! empty($commentaire)) {
	//requête 
	$req = $bdd->prepare('INSERT INTO commentaires (id_billet, auteur, commentaire, date_commentaire) VALUES(:id_billet, :auteur, :commentaire, NOW())');

	$req->bindValue(':id_billet', intval($id_billet), PDO::PARAM_INT);
	$req->bindValue(':auteur', $auteur, PDO::PARAM_STR);
	$req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
	$req->execute();

	$req->closeCursor();
	header ("Location: $_SERVER[HTTP_REFERER]&insertion=bravo");
}else{
	//echo "<br>c'est vide";
	header ("Location: $_SERVER[HTTP_REFERER]&insertion=failed");
}


?>