<?php
require_once("dataprovider.php");
require_once("product.php");
class Panier extends DataProvider
{
    //Ajouter Un Article Dans painer
    public function add($id, $qte)
    {
        if (isset($_SESSION['panier'])) {
            $_SESSION['panier'][$id] = $qte;
        } else {
            $_SESSION['panier'] = [$id => $qte];
        }
        $_SESSION['msg'] = "Product Has Added To Your Panier";
        $_SESSION["color"] = "success";
    }
    //Supprimer Un Article Dans painer
    public function deletePanier($id)
    {
        unset($_SESSION['panier'][$id]);
    }

    //Afficher Tous Les Articles Dans Le Panier
    public function GetAllItem()
    {
        $product = new Product();
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        if (!isset($_SESSION['panier']) || $_SESSION['panier'] == null) {
            return null;
        }
        $listItems = [];
        foreach ($_SESSION['panier'] as $id => $qte) {
            $item = $product->getOneProduct($id);
            $item->qte = $qte;
            $listItems = [...$listItems, $item];
        }
        return $listItems;
    }
}
