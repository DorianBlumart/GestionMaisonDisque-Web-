<?php

class PersoDB extends Perso {

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getPerso() {
        try {
            $query = "select * from pr_perso";
            $resultset = $this->_db->prepare($query);
            //$resultset->bindValue(':login', $login);
            //$resultset->bindValue(':password', $password);
            $resultset->execute();

            while ($data = $resultset->fetch()) {
                $_array[] = new Perso($data);
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
