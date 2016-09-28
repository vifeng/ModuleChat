<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mon commentaire</title>
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
.news > p{
    background-color:red;
    margin-top:0px;
}
.commentaires {background-color: lightgrey;}
.commentaires > h3{
    background-color:white;
    color:black;
    font-size:0.9em;
    margin-bottom:0px;
    text-align: left;
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
.newCom{
    padding: 4px;
}
    </style>

</head>
<body>

<h1>Mon commentaire</h1>
<p>je regarde un commentaire : </p>
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
$req = $bdd->prepare('SELECT * FROM billets WHERE id= :id ORDER BY id DESC LIMIT 0,5');
$req->execute(array(
        'id' => $_GET['id'],
        ));

;

//récupération
while ($donnees = $req->fetch()){
    echo '<div class="news"><p><h3>' . htmlspecialchars($donnees['titre']) .' le <em>' .htmlspecialchars($donnees['date_creation']) .'</em></h3></p>'. htmlspecialchars($donnees['contenu']) .'<br /></div>';

}
$req->closeCursor();

//requete 2
$req2 = $bdd->prepare('SELECT * FROM commentaires WHERE id_billet= :id ORDER BY id DESC');
$req2->execute(array(
        'id' => htmlspecialchars($_GET['id']),
        ));
//récupération
while ($donnees = $req2->fetch()){
    echo '<div class="commentaires"><p><h3> COMMENTAIRES ' . htmlspecialchars($donnees['auteur']) .' le <em>' .htmlspecialchars($donnees['date_commentaire']) .'</em></h3></p>'. htmlspecialchars($donnees['commentaire']) .'<br /></div>';
}
$req2->closeCursor();

$idtrans=intval($_GET['id']);
?>


<div class="newCom">
    <form action="commentaires_post.php" method="POST">
        <p><h2>Ajouter un nouveau commentaire</h2>
        <input type="hidden" name="id_billet" value="<?php echo $idtrans;?>"></p>
        <p><label for="auteur">Auteur</label>
        <input type="text" name="auteur"></p>

        <p><label for="commentaire">Commentaire</label>
        <input type="text" name="commentaire"></p>

        <input type="submit" value="Envoyer"></input>
    </form>
</div>
<p><a href="index.php">Revenir à la home</a></p>

<?php 
if (isset($_GET['insertion']) && $_GET['insertion']==='bravo') {
    echo "bravo, votre commentaire été ajouté";
}elseif(isset($_GET['insertion']) && $_GET['insertion']==='failed'){
    echo "Désolé, votre commentaire n'a pas été enregistré.";
}else{
    echo "";
};

?>

</body>
</html>