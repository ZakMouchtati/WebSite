<?php
require_once("dataprovider.php");
class authentification extends DataProvider
{
    //Pour authentifier Un Client Ou Bien Un Admin On Se Base de Email Est Password
    public function authentified($username, $password)
    {
        $db = $this->connecter();
        if ($db == null) {
            return;
        }
        $sql = 'SELECT *FROM users WHERE email=:email AND password=:password';
        $stm = $db->prepare($sql);
        $stm->execute([':email' => $username, ":password" => $password]);
        $data = $stm->fetch(PDO::FETCH_OBJ);
        if ($data) {
            if ($data->is_admin) {
                $_SESSION['admin'] = $data->id;
                header('Location:dashboard/Products.php');
            } else {
                $_SESSION['idclient'] = $data->id;
                $_SESSION['namepage'] ? header("Location:{$_SESSION['namepage']}.php") : header('Location:index.php');
            }
        } else {

            return 'EMAIL AND PASSWORD NOT FOUND';
        }
    }
}
