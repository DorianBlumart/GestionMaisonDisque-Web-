<?php
class AdminDB extends Admin {

    private $_db;
    private $_array = array(); // _c'est pour les variables private

    public function __construct($db) {//2_ '__' quand méthode magique, qui s'éxecute tt seule, tous les constructeurs en php sont __construct
        $this->_db = $db; //envoie des données ce connexion à l'instanciation (contenu de $cnx de l'index)
    }

    public function getAdmin($login, $pswd) {
        try {
            $query = "select * from pr_admin where login=:login and pswd =:pswd"; //préparation requête
            $resultset = $this->_db->prepare($query); //toujours $this, et avec $this ce qui suit est sans '$'. Prépare requête
            $resultset->bindValue(':login',$login);
            $resultset->bindValue(':pswd',$pswd);
            $resultset->execute();

            while ($data = $resultset->fetch()) {
                $_array[] = new Admin($data); //récupère dans tab
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
