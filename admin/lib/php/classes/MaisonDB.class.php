<?php

class MaisonDB extends Maison {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getMaison() {
        try {
            $query = "select * from pr_maison";
            $resultset = $this->_db->prepare($query);
            //$resultset->bindValue(':login', $login);
            //$resultset->bindValue(':password', $password);
            $resultset->execute();

            while ($data = $resultset->fetch()) {
                //$_array[] = new Maison($data);
                $_array[] = $data;
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        if (!empty($_array)) {
            return $_array;
        } else {
            return null;
        }
    }
    
        public function updateMaison($champ,$nouveau,$id){        
        
        try {
          // PREPARER LA REQUETE COMME VU PRECEDEMMENT
            $query="UPDATE pr_maison set ".$champ." = '".$nouveau."' where id_maison ='".$id."'"; 
            echo $query;
            $resultset = $this->_db->prepare($query);
            $resultset->execute();            
            
        }catch(PDOException $e){
            print $e->getMessage();
        }
    }
}
