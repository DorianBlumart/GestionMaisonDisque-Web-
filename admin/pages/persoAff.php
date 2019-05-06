<hgroup>
    <h3 class="my-title text-center">Personnel</h3>
</hgroup>

<?php
//récupération des artistes
$perso = new Vue_perso_labelDB($cnx);
$liste = array();
$liste = null;

//récupération des labels pour la liste déroulante
$label = new LabelDB($cnx);
$labels = $label->getLabel();
$nbr_labels = count($labels);

//sans filtre de label
if (!isset($_GET['submit_choix_label'])) {   //si on a pas cliqué sur name boutn
    $liste = $perso->getAllPerso();
}
//avec filtre si on a fait un choix dans la liste déroulante: 
else {

    if (isset($_GET['choix_label']) && $_GET['choix_label'] != "") {        //si on a fait un choix alors on filtre par type
        $liste = $perso->getPersoByLabel($_GET['choix_label']);
    } else {
        $liste = $perso->getAllPerso();    //si on a validé sans rien choisir dans filtre
    }
}
?>

<!--liste déroulante-->
<div class="container">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="row">
            <div class="col-sm-12 hidden-xs text-right">Filtrer par labels : </div> 
            <div class="col-sm-12 text-right">
                <select name="choix_label" id="choix_label">
                    <option value="">Tous</option>
                    <?php
                    for ($i = 0; $i < $nbr_labels; $i++) {
                        ?>
                        <option value="<?php print $labels[$i]->nomlabel; ?>">
                            <?php
                            print $labels[$i]->nomlabel; //récup dans table
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" name="submit_choix_label" id="submit_choix_label">
            </div>
        </div>
    </form>
</div>

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
                        print $liste[$i]['nomperso'];
                        print(" ");  //pour vue
                        print $liste[$i]['prenomperso'];
                        print " (identifiant " . $liste[$i]['id_perso'] . ")<br/>-Age: ";
                        print $liste[$i]['ageperso'];
                        print "<br/>-Label: " . $liste[$i]['nomlabel']."<br/>-Date d'engagement: " . $liste[$i]['hiredate'];
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
        <p>Personne ne travaille dans ce label</p>
    </div>
    <?php
}

