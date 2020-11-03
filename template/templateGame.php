<?php
session_start();
include ("fonctions.php");
if(isset($_POST["submit"]) && isset($_POST["case"])){
    setArrayValue($_POST["case"], $_SESSION["player"]);
    $_SESSION["player"] = ($_SESSION["player"] === 1)?2:1;
}
var_dump($_SESSION["array"]);

generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4");
generateHeader("puissance 4", $_SESSION["player"]);
?>
<main>
    <?php
     generateSection(6, 7, "", "", "visual", "", "graphic");
     generateSection(6, 7, "post", "#", "", "commande", "interactive");
    ?>
</main>
<?php
    include("templateFooter.html");
?>