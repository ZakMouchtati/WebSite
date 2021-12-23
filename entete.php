<?php
session_start();
require_once(dirname(__FILE__) . "/app/models/marque.php");
require_once(dirname(__FILE__) . "/app/models/client.php");
$marque = new Marque();
$allMarque = $marque->index();
$id = $_SESSION['idclient'] ?? '';
$Client = new Client();
$user = $Client->indetifiedClient($id);
?>
<header>
    <div class="container">
        <div class="logo">
            <a href="./">
                <img src="./img/header.png" alt="">
            </a>
        </div>
        <div class="icon-menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </div>
        <div class="clear"></div>
        <div class="link">
            <form action="search.php" id="form-search">
                <select name="marque" style="display: none" id="select-marque">
                    <option value="null">Tous les Collection</option>
                    <?php
                    foreach ($allMarque as $li) {
                        echo "<option>$li->description</option> ";
                    }

                    ?>
                </select>
                <input type="text" placeholder="Rechecher un produit" class="seachheaderproduit" name="clelibelle" />
                <button type="submit" class="BtnSeachheader">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search search-icon" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
                </button>
            </form>
            <ul>
                <li><a href="index.php"> Accueil </a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="panier.php">Votre Panier</a></li>
                <div class="clearfix"></div>
            </ul>
        </div>
        <div class="panier">
            <button class="Btn-toggle-search">
                <img src="./img/search.svg" width="25" height="25" alt="" class="bi bi-search search-icon">
            </button>
            <?php if ($user == null) { ?>
                <img src="./img/user-circle.svg" width="25" height="25" alt="" id="user">
            <?php } else { ?>
                <img src="<?php echo $user->profile ?>" width="30" height="30" alt="" id="userConnecter">
                <div class="choix-user">
                    <ul>
                        <li><a href="profile.php">Edit Profile</a></li>
                        <li><a href="YourCommande.php">Your Commande</a> </li>
                        <li><a href="logout.php">LogOut</a> </li>
                    </ul>
                </div>

            <?php } ?>
        </div>
        <div class="clearfix"></div>
    </div>

    <form class="search" action="./search.php">
        <div class="container">
            <select name="marque">
                <option value="null">Tous les Collection</option>
                <?php
                foreach ($allMarque as $li) {
                    echo "<option>$li->name</option> ";
                }

                ?>
            </select>
            <input type="text" placeholder="Rechecher un produit" class="seachproduit" name="clelibelle" />
            <button type="submit" class="BtnseachProduit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search search-icon" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>
            <div class="clearfix"></div>
        </div>
    </form>
</header>