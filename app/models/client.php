<?php
require_once('dataprovider.php');
class Client extends DataProvider
{
    //Pour Register Un Nouveau Client 
    public function newClient($nom, $prenom, $email, $adresse, $tel, $password, $profile)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "INSERT INTO users (nom,prenom,email,tel,adresse,password,profile) VALUES (:nom,:prenom,:email,:tel,:adresse,:password,:profile)";
            $stm = $db->prepare($sql);
            $stm->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ":tel" => $tel,
                ':adresse' => $adresse,
                ":password" => $password,
                ":profile" => $profile
            ]);
            return "Votre Compte a été Créé avec success <br> <a href='index.php'>GO TO LOGING</a> ";
            header('location:login.php');
        } catch (Exception $ex) {
            return $ex;
            // return 'veuillez entrer des informations Exact';
        }
    }
    //Indefier Un Client On Se Base De ID
    public function indetifiedClient($idclient)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT *FROM users WHERE id=:ID";
        $stm = $db->prepare($sql);
        $stm->execute([':ID' => $idclient]);
        $data = $stm->fetch(PDO::FETCH_OBJ);
        if ($data == null) {
            return null;
        }
        return $data;
    }
    //Update Un Client Sauf Le ID
    public function UpdateClient($idClient, $nom, $prenom, $email, $tel, $adresse, $profile)
    {
        $db = $this->connecter();
        if ($db === null) {
            return;
        }
        $sql = "UPDATE users SET nom=:nom,prenom=:prenom,email=:email,tel=:tel,adresse=:adresse,profile=:profile WHERE id=:id";
        $stm = $db->prepare($sql);
        $stm->execute(
            [
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':tel' => $tel,
                ':adresse' => $adresse,
                ':id' => $idClient,
                ':profile' => $profile
            ]
        );

        $_SESSION['msg'] = "Your Information Was Updated";
        $_SESSION["color"] = "success";
    }
    //Recupper Tous Les Commandes d'un Client On Se Base Id Client
    public function getconnamdes($idclient)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT DISTINCT(commandes.id),commandes.datecommande,commandes.etat FROM commandes  JOIN users on (commandes.user_id=users.id) WHERE users.id=:id";
        $stm = $db->prepare($sql);
        $stm->execute([":id" => $idclient]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    //Recupper Une Seule Commande d'un Client
    public function getOnecommmande($idcommande, $idclient)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT commandes.id,commandes.datecommande,commandes.etat,images.path,articles.libelle,articles.prix,lignecommandes.qte FROM lignecommandes JOIN commandes on (commandes.id=lignecommandes.commande_id) JOIN (articles) on (lignecommandes.article_id=articles.id) JOIN images on (images.article_id=articles.id ) JOIN users On(commandes.user_id=users.id) WHERE images.etat=1 AND commandes.id=:id_commande AND users.id=:id_client";
        $stm = $db->prepare($sql);
        $stm->execute([
            ":id_commande" => $idcommande,
            ":id_client" => $idclient
        ]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if ($data) {
            return $data;
        } else {
            header("Location:YourCommande.php");
        }
    }
}
