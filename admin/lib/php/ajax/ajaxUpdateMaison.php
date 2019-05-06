<?php
//brand new, voir fonctionsJqueryDA + ajouter updtae dans produi
header('Content-Type: application/json');
require '../pgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Maison.class.php';
require '../classes/MaisonDB.class.php';

$cnx = Connexion::getInstance($dsn,$user,$pass);

try{       
   $update= new MaisonDB($cnx);
   
   extract($_GET,EXTR_OVERWRITE);
    $parametre = 'id='.$id.'&champ='.$champ.'&nouveau='.$nouveau;
    $update->updateMaison($champ, $nouveau, $id);
    print json_encode($update);  
}
catch(PDOException $e){
    print $e->getMessage()." ".$e->getLine()." ".$e->getTrace()." ".$e->getCode();
}


