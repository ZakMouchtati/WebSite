<?php
require_once("dataprovider.php");
class Product extends DataProvider
{
    //Afficher TOus Les Articles Pour Afficher Dans La Page Accueil
    public function index()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $query = $db->query("SELECT articles.id,articles.libelle,articles.qtestock,articles.prix,marques.name,images.path FROM articles JOIN images ON (images.article_id=articles.id) JOIN marques ON (marques.id=articles.marque_id) WHERE images.etat=1 ORDER BY articles.id");
        $item = $query->fetchAll(PDO::FETCH_OBJ);
        return $item;
    }
    public function show()
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $query = $db->query("SELECT articles.id,articles.libelle,articles.qtestock,articles.prix,marques.name,images.path FROM articles JOIN images ON (images.article_id=articles.id) JOIN marques ON (marques.id=articles.marque_id) WHERE images.etat=1 ORDER BY RAND() LIMIT 4");
        $item = $query->fetchAll(PDO::FETCH_OBJ);
        return $item;
    }
    //Afficher Un Article On Se Base De Id de Produit
    public function getOneProduct($idproduct)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT articles.id,articles.libelle,articles.qtestock,articles.prix,articles.description,marques.name,marques.id AS marque_id ,images.path FROM articles  JOIN images ON (images.article_id=articles.id) JOIN marques ON (marques.id=articles.marque_id) WHERE images.etat=1 AND ARTICLES.ID=:id_article";
        $stm = $db->prepare($sql);
        $stm->execute([":id_article" => $idproduct]);
        $data = $stm->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    //Recupper Les Image Secondire Pour Afficher Dans La Page Show
    public function GetsecondaireImg($id_article)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT images.id,path FROM articles JOIN images ON (images.article_id=articles.id) JOIN marques ON (marques.id=articles.marque_id) WHERE images.etat=0 AND ARTICLES.ID=:id_article";
        $stm = $db->prepare($sql);
        $stm->execute([":id_article" => $id_article]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }
    //Search Pour Un Produit On Se Base De Libelle Ou Bien Marque Ou Les Deux
    public function searchproduct($marque, $libelle)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT articles.id,articles.libelle,articles.qtestock,articles.prix,articles.description,marques.name,images.path FROM ARTICLES JOIN images ON (images.article_id=articles.id) JOIN marques ON (marques.id=articles.marque_id) WHERE images.etat=1 AND  (LIBELLE like :libelle OR marques.name=:marque)";
        $stm = $db->prepare($sql);
        $stm->execute([
            ':libelle' => "%$libelle%",
            ':marque' => $marque
        ]);
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if ($data == null) {
            return null;
        }
        return $data;
    }
    // Partie dashboard
    //Supprimer Un Produit
    public function deleteProduit($idproduit)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "DELETE FROM IMAGES WHERE images.id=:idarticle";
            $stm = $db->prepare($sql);
            $stm->execute([":idarticle" => $idproduit]);
            $req = "DELETE FROM ARTICLES WHERE ARTICLES.id=:idarticle";
            $pre = $db->prepare($req);
            $pre->execute([":idarticle" => $idproduit]);
            return "produit supprimé avec succès";
        } catch (PDOException $ex) {
            return "tu ne peux pas supprimer ce produit";
        }
    }
    //ajouter Un nouveaux Article 
    public function addproduit($libelle, $qtestock, $prix, $idmarque, $description, $firstimg, $images)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "INSERT INTO articles (libelle,qtestock,prix,marque_id,description) VALUES (:libelle,:qtestock,:prix,:idmarque,:description)";
            $stm = $db->prepare($sql);
            $stm->execute([
                ':libelle' => $libelle,
                ':qtestock' => $qtestock,
                ':prix' => $prix,
                ':idmarque' => $idmarque,
                ':description' => $description,
            ]);
            $idproduit = $db->lastInsertId();
            $req = "INSERT INTO images(path,article_id,etat) VALUES (:src,:idproduit,:etat)";
            $st = $db->prepare($req);
            $st->execute([
                ':src' => $firstimg,
                ":idproduit" => $idproduit,
                ":etat" => 1
            ]);
            foreach ($images as $image) {
                $sec = $db->prepare($req);
                $sec->execute([
                    ':src' => $image,
                    ":idproduit" => $idproduit,
                    ":etat" => 0
                ]);
            }
            return "produit ajouté avec succès";
        } catch (PDOException $ex) {
            return "$ex";
        }
    }
    //Update Un Produit
    public function updateproduit($id, $libelle, $qtestock, $prix, $idmarque, $description, $firstimg, $images)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        try {
            $sql = "UPDATE  articles SET libelle=:libelle,qtestock=:qtestock,prix=:prix,marque_id=:idmarque,description=:description where articles.id=:id";
            $stm = $db->prepare($sql);
            $stm->execute([
                ':libelle' => $libelle,
                ':qtestock' => $qtestock,
                ':prix' => $prix,
                ':idmarque' => $idmarque,
                ':description' => $description,
                ":id" => $id
            ]);
            $req = "UPDATE  images set path=:src WHERE images.article_id=:idproduit and etat=:etat";
            $st = $db->prepare($req);
            $st->execute([
                ':src' => $firstimg,
                ":idproduit" => $id,
                ":etat" => 1
            ]);
            foreach ($images as $image) {
                $sec = $db->prepare('INSERT INTO images(path,article_id,etat) VALUES (:src,:idproduit,:etat)');
                $sec->execute([
                    ':src' => $image,
                    ":idproduit" => $id,
                    ":etat" => 0
                ]);
            }
            return "produit modifié avec succès";
        } catch (PDOException $ex) {
            echo $ex;
            die();
        }
    }
    //Supprimer Une
    public function deleteImg($idimage)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = "SELECT images.path FROM images WHERE images.id=:id_images";
        $stm = $db->prepare($sql);
        $stm->execute([
            ':id_images' => $idimage
        ]);
        $path = $stm->fetch(PDO::FETCH_COLUMN);
        unlink("../../" . $path);
        $stm = $db->prepare("DELETE FROM images WHERE images.id=:id_images");
        $stm->execute([
            ':id_images' => $idimage
        ]);
    }
}
