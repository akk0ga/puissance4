<?php
session_start();
include ("fonctions.php");
if(isset($_POST["submit"]) && isset($_POST["case"])){
    //ajouter la valeur la case
    setArrayValue(intval($_POST["case"]), $_SESSION["player"]);
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
    <section class="d-flex flex-column align-items-center justify-content-center">
        <div class="array">
            <form action="#" method="post">
                <?php
                for ($i=1; $i <= 6; $i++):?>
                    <ul class="d-flex flex-row">
                        <?php
                        for ($j=0; $j < 7; $j++):
                            if ($_SESSION["array"][intval($i."".$j)] === 0){?>
                                <li><input type="radio" value=<?php echo $i."".$j ?> name="case" <?php echo (!empty($checkWin))?"disabled":disabled($i, $j, $_SESSION["firstTurn"]) ?>></li>
                            <?php
                            }else{?>
                                <li><img src="<?php displayImage($i, $j)?>" alt="circle"></li>
                            <?php
                            }
                        endfor;
                        ?>
                    </ul>
                <?php
                endfor;
                ?>
                <input type="submit" value="submit" name="submit" class="btn btn-primary">
            </form>
        </div>
    </section>
</main>
<?php
//verifier si cest le premier tour
if($_SESSION["firstTurn"] === true){
    $_SESSION["firstTurn"] = false;
}
    include("templateFooter.html");
?>