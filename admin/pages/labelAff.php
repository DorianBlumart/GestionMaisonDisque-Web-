<hgroup>
    <h3 class="my-title text-center">Labels</h3>
</hgroup>

<?php
//récupération des labels
include ('lib/php/verifier_connexion.php');
$label = new Vue_label_maisonDB($cnx);
$liste = array();
$liste = null;

//récupération des maisons pour la liste déroulante
$maison = new MaisonDB($cnx);
$maisons = $maison->getMaison();
$nbr_maisons = count($maisons);

//sans filtre de maison
if (!isset($_GET['submit_choix_maison'])) {   //si on a pas cliqué sur name boutn
    $liste = $label->getAllLabel();
}
//avec filtre si on a fait un choix dans la liste déroulante: 
else {

    if (isset($_GET['choix_maison']) && $_GET['choix_maison'] != "") {        //si on a fait un choix alors on filtre par type
        $liste = $label->getLabelByMaison($_GET['choix_maison']);
    } else {
        $liste = $label->getAllLabel();    //si on a validé sans rien choisir dans filtre
    }
}
?>

<!--liste déroulante-->
<!--<div class="container">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="row">
            <div class="col-sm-12 hidden-xs text-right">Filtrer par maison de disque : </div> 
            <div class="col-sm-12 text-right">
                <select name="choix_maison" id="choix_maison">
                    <option value="">Tous</option>
                    <?php
                    for ($i = 0; $i < $nbr_maisons; $i++) {
                        ?>
                        <option value="<?php print $maisons[$i]->nommaison; ?>">
                            <?php
                            print $maisons[$i]->nommaison; //récup dans table
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" name="submit_choix_maison" id="submit_choix_maison">
            </div>
        </div>
    </form>
</div>-->

<!--affichage données, TODO afficher une mention spéciale pour notre maison, TODO affichage maison-->
<?php
if ($liste != null) {
    $nbr = count($liste);
    ?>
    <div class="container my-contenu">
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <div class="row">
                <div class="col text-center">
                    <p class="my-paragraph">
                        <?php
                        print $liste[$i]['nomlabel'];  //pour vue
                        print " (identifiant " . $liste[$i]['id_label'] . ")<br/>-Style: ";
                        print $liste[$i]['style'] . "<br/>-Appartient à " . $liste[$i]['nommaison'];
                        ?>
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}//fin if $nbr >0
else {
    ?>
    <div class="container">
        <p>Cette maison de disques n'a aucun label</p>
    </div>
    <?php }
?>
<a type="button" class="btn btn-light" href="./index.php?page=labelAdd.php">+</a><br>


