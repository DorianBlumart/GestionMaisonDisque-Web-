<hgroup>
    <h3 class="my-title text-center">Discographies</h3>
</hgroup>

<?php
//récupération des albums
$album = new Vue_album_artiste_labelDB($cnx);
$liste = array();
$liste = null;

//récupération des artistes pour la liste déroulante
$artiste = new ArtisteDB($cnx);
$artistes = $artiste->getArtiste();
$nbr_artistes = count($artistes);

//sans filtre de label
if (!isset($_GET['submit_choix_artiste'])) {   //si on a pas cliqué sur name boutn
    $liste = $album->getAllAlbum();
}
//avec filtre si on a fait un choix dans la liste déroulante: 
else {

    if (isset($_GET['choix_artiste']) && $_GET['choix_artiste'] != "") {        //si on a fait un choix alors on filtre par type
        $liste = $album->getAlbumByArtiste($_GET['choix_artiste']);
    } else {
        $liste = $album->getAllAlbum();    //si on a validé sans rien choisir dans filtre
    }
}
?>

<!--liste déroulante-->
<div class="container">
    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="row">
            <div class="col-sm-12 hidden-xs text-right">Filtrer par artistes : </div> 
            <div class="col-sm-12 text-right">
                <select name="choix_artiste" id="choix_artiste">
                    <option value="">Tous</option>
                    <?php
                    for ($i = 0; $i < $nbr_artistes; $i++) {
                        ?>
                        <option value="<?php print $artistes[$i]->alias; ?>">
                            <?php
                            print $artistes[$i]->alias; //récup dans table
                            ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
                <input type="submit" name="submit_choix_artiste" id="submit_choix_artiste">
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
                        print $liste[$i]['nomalbum'];  //pour vue
                        print " (identifiant " . $liste[$i]['id_album'] . ")<br/>-Interprète: ";
                        print $liste[$i]['alias'];
                        print "<br>-Sortie: " . $liste[$i]['sortie'] . "<br>-Prix: ".$liste[$i]['prix']." euros";
                        print "<br/>-Label propriétaire: " . $liste[$i]['nomlabel'];
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
        <p>Cet artiste n'a sorti aucun album</p>
    </div>
    <?php
}

