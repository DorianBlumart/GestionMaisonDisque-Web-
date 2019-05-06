<hgroup>
    <h3 class="my-title text-center">Maisons de disques inscrites</h3>
</hgroup>

<?php
$vue = new MaisonDB($cnx);
$liste = array();
$liste = null;

$liste = $vue->getMaison();
//var_dump($liste);
$nbr = count($liste);
?>

<!--<div class="row">
    <div class="col-sm-12">
        <a href="./pages/printCatalogue.php" class="pull-right" target="_blank">Imprimer</a>
    </div>
</div>-->

<div class="container my-container table">
    <table class="table-responsive table-striped">
        <tr class="table-light table-bordered">
            <th class="ecart">Id</th>
            <th class="ecart">Nom</th>
            <th class="ecart">Date de création</th>
            <th class="ecart">Budget</th>
        </tr>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr class="table-bordered">
                <td class="ecart"><?php print $liste[$i]['id_maison']; ?></td>
                <td><span contenteditable="true" name="nommaison" class="ecart" id="<?php print $liste[$i]['id_maison']; ?>">
                        <?php print $liste[$i]['nommaison']; ?></span>
                </td>
                <td><span contenteditable="true" name="datecrea" class="ecart" id="<?php print $liste[$i]['id_maison']; ?>">
                        <?php print $liste[$i]['datecrea']; ?></span>
                </td>
                <td><span contenteditable="true" name="budget" class="ecart" id="<?php print $liste[$i]['id_maison']; ?>">
                        <?php print $liste[$i]['budget']; ?></span>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>  
</div>
