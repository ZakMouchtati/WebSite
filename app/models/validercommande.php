<?php
require_once("dataprovider.php");
class Commande extends DataProvider
{
    //Ajouter Une Commande
    public function AddCommmande($id_client, $methodpaiment, $items)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "INSERT INTO commandes (user_id,methodpaiment) VALUES (:id,:paiment)";
            $stm = $db->prepare($sql);
            $stm->execute([':id' => $id_client, ":paiment" => $methodpaiment]);
            $nocmd = $db->lastInsertId();
            foreach ($items as $item) {
                $this->addlignecommande($nocmd, $item->id, $item->qte);
            }
        } catch (PDOException $ex) {
            return $ex;
        }
    }
    //Pour Ajouter Plusieurs Produit
    public function addlignecommande($nocmd, $idart, $qte)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "INSERT INTO lignecommandes (commande_id,article_id,qte) VALUES (:nocmd,:idart,:qte)";
            $stm = $db->prepare($sql);
            $stm->execute([':nocmd' => $nocmd, ":idart" => $idart, ":qte" => $qte]);
        } catch (PDOException $ex) {
            return $ex;
        }
    }
}
