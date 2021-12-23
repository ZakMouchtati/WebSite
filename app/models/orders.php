<?php
require_once('dataprovider.php');
class Orders extends DataProvider
{
    //Recupper Tous Les Commandes
    public function getallorders()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT *FROM commandes WHERE commandes.etat=0 ORDER BY commandes.id desc";
        $stm = $db->query($sql);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if ($data) {
            return $data;
        } else {
            return null;
        }
    }
    //Recupper Une Seule Commande
    public function getoneorder($idcommande)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT commandes.id,commandes.etat,commandes.datecommande,commandes.methodpaiment,users.nom,users.prenom,users.email,users.tel,users.adresse,articles.libelle,articles.prix,images.path,lignecommandes.qte FROM commandes JOIN lignecommandes On (lignecommandes.commande_id=commandes.id) JOIN articles On(articles.id=lignecommandes.article_id) JOIN images ON (articles.id=images.article_id) JOIN users On (commandes.user_id=users.id) WHERE images.etat=1 AND commandes.id=:idcommande";
        $stm = $db->prepare($sql);
        $stm->execute([':idcommande' => $idcommande]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    //traiter Une Commande 
    public function traitercommande($idcommande)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "Update commandes set etat=1 WHERE commandes.id=:idcommande";
            $stm = $db->prepare($sql);
            $stm->execute([':idcommande' => $idcommande]);
            return "Commande traitée avec succès";
        } catch (PDOException $ex) {
            return "Commande ne pas traiter";
        }
    }
    //Afficher Les Commandes Qui Traiter
    public function getallorderTraiter()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT *FROM commandes WHERE commandes.etat=1 ORDER BY commandes.id desc";
        $stm = $db->query($sql);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
}
