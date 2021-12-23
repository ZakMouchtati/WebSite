<?php
require_once("dataprovider.php");
class Boite extends DataProvider
{
    //Pour Ajouter Un Message Ou Admin De Site
    public function AddMessage($email, $object, $message)
    {
        $db = $this->connecter();
        if ($db === null) {
            return;
        }
        $sql = "INSERT INTO messages (email,object,contenu) VALUES (:email,:objmsg,:message)";
        $stm = $db->prepare($sql);
        $stm->execute([
            ':email' => $email,
            ':objmsg' => $object,
            ':message' => $message
        ]);
    }
}
