<form method="post">
    <input type="text" placeholder="Entre le titre de la tache" name="titre">
    <input type="text" placeholder="Entre ta tache" name="tache">
    <button name="submit" type="submit">Finis</button>
    <button name="affiche" type="submit">Affiche</button>
    <button name="supprime" type="submit">supprime</button>
</form>

<?php

session_start();
if (empty($_SESSION["tache"])) {
    $_SESSION["tache"] = array();
}

require_once("Tache.php");

if (isset($_POST["submit"])) {
    $newTache = new Tache($_POST["titre"], $_POST["tache"]);

    // $_SESSION["tache"] = serialize($newTache);
    array_push($_SESSION["tache"], serialize($newTache));
}

if (isset($_POST["affiche"])) {
    foreach ($_SESSION["tache"] as $tache) {
        $tache = unserialize($tache);
        $tache->sayTache();
    }
}
if (isset($_POST["supprime"])) {
    session_destroy();
}
var_dump($_POST);
var_dump($_SESSION["tache"]);
?>