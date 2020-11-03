<?php
session_start();
if(isset($_POST["submit"]) && isset($_POST["case"])){
    $case = $_POST["case"];
    echo $case." / ". gettype($case);
    foreach ($_SESSION["array"] as $key => $value) {
        if ($key === $case) {
            
        }
    }
    var_dump($_SESSION["array"]);
}

include ("fonctions.php");
generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4");
?>
<header>
        <h1 class="text-center">Puissance 4</h1>
</header>
<main>
    <?php
     generateSection(6, 7, "", "", "visual", "", "graphic");
     generateSection(6, 7, "post", "#", "", "commande", "interactive");
    ?>
</main>
<?php
    include("templateFooter.html");
?>