<hgroup>
    <h3 class="my-title text-center">Ajout label</h3>
</hgroup>
<?php
include ('lib/php/verifier_connexion.php');
if (isset($_GET['creer'])) {
    extract($_GET, EXTR_OVERWRITE);

    if (empty($nomlabel) || empty($style) || empty($id_maison)){
        $erreur = "<span class='txtWarn'>Veuillez remplir tous les champs</span>";
    } else {
           $lb = new LabelDB($cnx);
           $retour = $lb->addLabel($_GET);
           //var_dump($_GET);
    }
}
?>




<div class="container">
    <?php
    if (isset($erreur))
        print $erreur;
    ?>

    <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get" id="form_labelAdd">
        <div class="form-group">
            Nom :
            <input type="text" name ="nomlabel" class="form-control" id="nomlabel" placeholder="Entrez le nom du label">
        </div>
        <div class="form-group">
            Style :
            <input type="text" name="style" class="form-control" id="style" placeholder="Entrez le style musical du label">
        </div>
        <div class="form-group">
            Maison de disques :
            <input type="number" name="id_maison" class="form-control" id="id_maison" placeholder="Entrez l'identifiant de la maison de disques associée">
        </div>
        <br>
        <button type="submit" name="creer" id="creer" class="btn btn-primary">Valider</button>           
    </form>
</div>
