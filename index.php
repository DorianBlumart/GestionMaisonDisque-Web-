<?php
session_start(); //on ouvre la session (permettra les variables de session)
?>
<!doctype html>
<?php
require './admin/lib/php/admin_liste_include.php';
$cnx = Connexion::getInstance($dsn, $user, $pass);
?>

<head>
    <meta charset="UTF-8">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./admin/lib/js/jquery.editable.js"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--librairie icônes-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="admin/lib/css/style.css"/>
    <script src="admin/lib/js/fonctionsJqueryDA.js"></script>
</head>
<header>
    <div class="container-fluid my-containerTop">    
        <div class="row my-row">
            <div class="col-6 my-col">                
                <a href="index.php?page=login.php" class="textTop">Connexion</a>  
            </div>   
            <div class="col-6 text-right my-col">                
                <a href="index.php?page=savoir.php" class="textTop">En savoir plus </a>  
            </div> 
        </div>
    </div>
    <div class="container-fluid my-container">
        <div class="row my-row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 my-col">
                <img src="./admin/images/bann2.jpg" class="img-fluid" alt="Banner"> 
            </div>
        </div>
    </div>
</header>
<body>
    <!--main part-->
    <section id="main">
        <div class="container my-container">
            <!--insérer nav pour le projet-->
            <div class="row my-row">
                <div class="col-4 col-md-2 col-lg-2 col-sm-3 my-col">                
                    <nav>
                        <?php
                        if (file_exists('./lib/php/p_menu.php')) {
                            require './lib/php/p_menu.php';
                        }
                        ?>
                    </nav> 
                </div> 
                <!--test existance existance variable php (!isset)-->
                <div class="col-8 col-sm-9 col-lg-10 col-md-10 my-col text-center"> 
                    <?php
                    if (!isset($_SESSION['page'])) { //si pas variable sessiion c'est qu on vient d arriver donc on va créer
                        $_SESSION['page'] = "accueil.php"; //crée variable session où on met page par défaut
                    }
                    if (isset($_GET['page'])) {  //$_GET = d'office url, page c'est une variable qui arrive dans url
                        //si on a cliqué sur un lien du menu
                        $_SESSION['page'] = $_GET['page'];
                        //echo $_SESSION['page'];
                    }
                    $path = "./pages/" . $_SESSION['page']; //on met le lien à joindre
                    if (file_exists($path)) {   //si chemin mène à qlqch
                        include($path); //on ajoute
                    } else {
                        include('accueil.php');    //page spécifique
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
<footer>
    <div class="container-fluid my-containerTop">
        <div class="row my-row">
            <div class="col-lg-12 text-center my-col txtWhite">
                <a>Merci pour votre visite</a>
            </div>
        </div>
</footer>


