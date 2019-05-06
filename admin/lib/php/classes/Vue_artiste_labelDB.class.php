<?php

class Vue_artiste_labelDB {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getArtisteByLabel($nomlabel) {
        try {
            $this->_db->beginTransaction();
            $query = "select * from vue_artiste_label where nomlabel=:nomlabel";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(':nomlabel', $nomlabel);
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

    public function getAllArtiste() {
        try {
            $this->_db->beginTransaction();
            $query = "select * from vue_artiste_label";
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
