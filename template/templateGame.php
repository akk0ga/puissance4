<?php
include ("fonctions.php");

echo generateHead(strval($_GET["page"]), "fr", "UTF-8", "puissance4" );
?>
<main>
    <?php echo generateSectionCommande(6, 7, "post", "#", "commande"); ?>
</main>
<?php
    include("");
?>