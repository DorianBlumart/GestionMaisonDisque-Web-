<?php

class AccueilDB extends Accueil {
    private $_db;
    private $_array = array();//_ c'est pour les variables private
    
    public function __construct($db){//2_ '__' quand méthode magique, qui s'éxecute tt seule
        $this->_db = $db;//envoie des données ce connexion à l'instanciation (contenu de $cnx de l'index)
    }
    
    public function getTexteAccueil(){
        try{
            $query = "select * from pr_maison";
            $resultset = $this->_db->prepare($query);//toujours $this, et avec $this ce qui suit est sans '$'. Prépare requête
            $resultset->execute();

            while($data = $resultset->fetch()){
                $_array[] = new Accueil($data);//récupère dans tab
            }        
        }
        catch(PDOException $e){
            print $e->getMessage();
        }
        if(!empty($_array)){
            return $_array;
        }
        else {
            return null;
        }
    }
}