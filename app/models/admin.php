<?php
require_once('dataprovider.php');
class admin extends DataProvider
{
    //Indetifier Un admin par son ID
    public function indetifiedadmin($idadmin)
    {
        $db = $this->connecter();
        if ($db === null) {
            return;
        }
        $sql = "SELECT *FROM users WHERE users.id=:id_compte";
        $stm = $db->prepare($sql);
        $stm->execute([
            ':id_compte' => $idadmin
        ]);
        $data = $stm->fetch(PDO::FETCH_OBJ);
        return $data ?? null;
    }
    //Pour Faire Une Redirection 
    public function redirect($page)
    {
        header("Location:$page.php");
    }
    //Pour Faire Update Les Infoo De Admin Sauf Le ID
    public function updateadmin($id, $nom, $prenom, $email, $tel, $password, $profile)
    {
        $db = $this->connecter();
        if ($db === null) {
            return;
        }
        try {
            $sql = "UPDATE users SET nom=:nom,prenom=:prenom,email=:email,tel=:tel,password=:password,profile=:profile  WHERE users.id=:idcompte";
            $stm = $db->prepare($sql);
            $stm->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':password' => $password,
                ':idcompte' => $id,
                ':tel' => $tel,
                ':profile' => $profile

            ]);
            return "Profile Modifie Avec succès";
        } catch (PDOException $ex) {
            // return "oups une erreur";
            return $ex;
        }
    }
    //Ajouter Une nouveau Admin Pour Gerer Le Site
    public function newadmin($nom, $prenom, $email, $tel, $password)
    {
        $db = $this->connecter();
        if ($db === null) {
            return;
        }
        try {
            $sql = "INSERT INTO users (nom,prenom,email,is_admin,tel,PASSWORD) values (:nom,:prenom,:email,:is_admin,:tel,:password) ";
            $stm = $db->prepare($sql);
            $stm->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':email' => $email,
                ':is_admin' => true,
                ':tel' => $tel,
                ':password' => $password,

            ]);
            return "Profile Ajouter Avec succès";
        } catch (PDOException $ex) {
            return $ex;
        }
    }
}
