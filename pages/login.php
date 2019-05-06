<?php
//si on a cliquÃ© sur le bouton d'envoi du formulaire
if (isset($_POST['submit_login']) & isset($_POST['test'])) {
    //pour pouvoir utiliser les donnÃ©es hors tabl $_GET ou $_POST
    extract($_POST, EXTR_OVERWRITE);
    $log = new AdminDB($cnx);

    //$admin et $password sont les noms des champs du formulaire
    $admin = $log->getAdmin($login, $password);
    if (is_null($admin)) {
        print "<span class='txtWarn'>Données incorrectes</span>";
    } else {
        $_SESSION['admin'] = 1;
        unset($_SESSION['page']);
        print "<meta http-equiv=\"refresh\": Content=\"0;URL=./admin/index.php\">";
    }
}
?>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        Login :
        <input type="text" name ="login" class="form-control" id="admin" placeholder="Entrez votre login administrateur">
        <small id="" class="form-text text-muted">Ne communiquez jamais vos informations personnelles.</small>
    </div>
    <div class="form-group">
        Mot de passe :
        <input type="password" name="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
    </div>
    <div class="form-check">
        <input type="checkbox" name="test" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Je m'engage à garder secrètes les informations qui vont suivre</label>
    </div><br>
    <button type="submit" name="submit_login" id="submit_login" class="btn btn-primary">Valider</button>
</form>


