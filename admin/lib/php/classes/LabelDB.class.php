<?php

class LabelDB extends Label {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getLabel() {
        try {
            $query = "select * from pr_label";
            $resultset = $this->_db->prepare($query);
            //$resultset->bindValue(':login', $login);
            //$resultset->bindValue(':password', $password);
            $resultset->execute();

            while ($data = $resultset->fetch()) {
                $_array[] = new Label($data);
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
    
    public function addLabel($data) {
        //$_db->beginTransaction();     récup bonne syntaxe
        //var_dump($data);
        try{
            $query="insert into pr_label(id_maison,nomlabel,style)"
                    . "values(:id_maison,:nomlabel,:style)";
            $resultset = $this->_db->prepare($query);           
            $resultset->bindValue(':id_maison', $data['id_maison']);    //$data + nom champs du formulaire
            $resultset->bindValue(':nomlabel', $data['nomlabel']);
            $resultset->bindValue(':style', $data['style']);
            $resultset->execute();
            echo"<span class='txtOk'>Insertion effectuée</span>";
        } catch (PDOException $e) {
            echo "<span class='txtWarn'>Echec d\'insertion</span>";
        }
        //$_db->commit();       pareil
    }

        
}
