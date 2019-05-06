<?php

class Vue_label_maisonDB {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getLabelByMaison($nommaison) {
        try {
            $this->_db->beginTransaction();
            $query = "select * from vue_label_maison where nommaison=:nommaison";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':nommaison', $nommaison);
            $resultset->execute();
            $this->_db->commit();
            while ($data = $resultset->fetch()) {
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

    public function getAllLabel() {
        try {
            $this->_db->beginTransaction();
            $query = "select * from vue_label_maison";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            $this->_db->commit();
            while ($data = $resultset->fetch()) {
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

}
