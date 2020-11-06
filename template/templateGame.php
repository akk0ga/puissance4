<?php
session_start();
if(isset($_POST["submit"]) && isset($_POST["case"])){
    //ajouter la valeur la case
    setValue(intval($_POST["case"]), $_SESSION["player"]);
    //verifier si il a gagner
    calcWin();
    //savoir quel joueur doit jouer
    $_SESSION["player"] = ($_SESSION["player"] === 1)?2:1;
}
//verifier quel joueur gagne si calcwin() a renvoyer un nombre
$checkWin = (calcWin() === 1 || calcWin() === 2)?true:false;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <?php
    if ($_GET["page"] === "game"):?>
        <link rel="stylesheet" href="assets/css/game.css">
    <?php endif; ?>
    <title>puissance4</title>
</head>
<body>
    <header>
        <h1 class="text-captitalize text-center">puissance 4</h1>
        <?php
        if (!empty($_SESSION["player"]) && $checkWin === false):?>
            <h2 class="text-center text-secondary">A vous de jouer : <?php echo ($_SESSION["player"] === 1)?"Joueur 1": "Joueur 2";?></h2>
    <?php elseif($checkWin === true && calcWin() === 2 || calcWin() === 1):?>
            <h2 class="text-center text-success"><?php echo (calcWin() === 1)?"Joueur 1 win": "Joueur 2 win";?></h2>
    <?php endif;
        ?>
    </header>
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