<?php
require_once("dataprovider.php");
class Marque extends DataProvider
{
    //Recupper Tous Les Marque Pour afficher dans Le Form De Search
    public function index()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $query = $db->query("SELECT *FROM marques");
        $li = $query->fetchAll(PDO::FETCH_OBJ);
        return $li;
    }
}
