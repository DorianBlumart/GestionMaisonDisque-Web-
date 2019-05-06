<?php

class AlbumDB extends Album{

    private $_db;
    private $_array = array();

    public function __construct($db) {//contenu de $cnx (index)
        $this->_db = $db;
    }

    public function getAlbum() {
        try {
            $query = "select * from pr_album";
            $resultset = $this->_db->prepare($query);
            //$resultset->bindValue(':login', $login);
            //$resultset->bindValue(':password', $password);
            $resultset->execute();

            while ($data = $resultset->fetch()) {
                $_array[] = new Album($data);
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
