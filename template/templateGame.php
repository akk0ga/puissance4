<?php
session_start();
include ("fonctions.php");
if(isset($_POST["submit"]) && isset($_POST["case"])){
    //ajouter la valeur la case
    setArrayValue($_POST["case"], $_SESSION["player"]);
    //verifier si il a gagner
    calcWin();
    //savoir quel joueur doit jouer
    $_SESSION["player"] = ($_SESSION["player"] === 1)?2:1;
}
//verifier quel joueur gagne si calcwin() a renvoyer un nombre
$checkWin = (calcWin() === 1 || calcWin() === 2)?true:false;

generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4");
generateHeader("puissance 4", $_SESSION["player"], $checkWin);
?>
<main>
    <?php
        generateSection(6, 7, "post", "#", "interactive", $_SESSION["firstTurn"], $checkWin);
    ?>
</main>
<?php
//verifier si cest le premier tour
if($_SESSION["firstTurn"] === true){
    $_SESSION["firstTurn"] = false;
}
    include("templateFooter.html");
?>