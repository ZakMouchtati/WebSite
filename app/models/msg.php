<?php
require_once('dataprovider.php');
class Msg extends DataProvider
{
    //Recupper les Tous Les Msg pour Afficher Dans Le Dashboard
    public function getmsg()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $stm = $db->query("SELECT *FROM messages ");
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    //Supprimer Un Msg On Se base de Id
    public function deletemsg($idmsg)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = 'DELETE FROM messages WHERE id=:idcontact';
            $stm = $db->prepare($sql);
            $stm->execute([":idcontact" => $idmsg]);
        } catch (PDOException $ex) {
            return;
        }
    }
}
