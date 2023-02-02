<form method="post">
    <input type="text" placeholder="Entre le titre de la tache" name="titre">
    <input type="text" placeholder="Entre ta tache" name="tache">
    <button name="submit" type="submit">Finis</button>
    <input type="text" placeholder="Entre ta tache a affiché" name="nomaffiche">
    <button name="affiche" type="submit">Affiche</button>
    <button name="supprime" type="submit">supprime</button>
    <input type="number" placeholder="entre le numéro de la tache a supprimer" name="numero">
    <button type="submit" name="supp">Supprime dans la db</button>
    <button type="submit" name="affichetout">Affiche Tout</button>
</form>

<?php

// session_start();
// if (empty($_SESSION["tache"])) {
//     $_SESSION["tache"] = array();
// }

require_once("Tache.php");

require_once("pdo.php");

if (isset($_POST["submit"])) {
    $newTache = new Tache($_POST["titre"], $_POST["tache"]);

    // $_SESSION["tache"] = serialize($newTache);
    // array_push($_SESSION["tache"], serialize($newTache));
    //mysqladmin -u root password
   

    $test= "insert into tache set Titre = ? , Tache = ? ";
    $req= $pdo->prepare($test);
    $title = $_POST["titre"];
    $task=$_POST["tache"];
    $req->execute([$title,$task]);

    
    
}

if (isset($_POST["affiche"])) {
    // foreach ($_SESSION["tache"] as $tache) {
    //     $tache = unserialize($tache);
    //     $tache->sayTache();
    //     echo "<br>";
    // }

    $select = $pdo->query("SELECT * from tache where Titre = '" . $_POST["nomaffiche"] . "'");
    $selectobj = $select->fetch(PDO::FETCH_OBJ);
    echo $selectobj->Titre . " : " . $selectobj->Tache;

}

if (isset($_POST["affichetout"])) {
    // foreach ($_SESSION["tache"] as $tache) {
    //     $tache = unserialize($tache);
    //     $tache->sayTache();
    //     echo "<br>";
    // }

    $select = $pdo->query("SELECT * from tache");
    $selectobj = $select->fetchall(PDO::FETCH_ASSOC);
    var_dump($selectobj);
    foreach ($selectobj as $key => $value) {
        
            foreach ($value as $key1 => $value) {
                echo $value;
                echo "<br>";
            }
        }
        
    }


if (isset($_POST["supprime"])) {
    session_destroy();
    $pdo = new PDO("mysql:dbname=tache;host=localhost",'root','');
    $pdo->exec("DELETE from tache");
}

if(isset($_POST["supp"])){
    $pdo = new PDO("mysql:dbname=tache;host=localhost",'root','');
    $pdo->exec("DELETE from tache where id_tache=". $_POST["numero"]);
}
// var_dump($_POST);
// var_dump($_SESSION["tache"]);
?>