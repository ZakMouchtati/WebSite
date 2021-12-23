<div class="card item">
    <a href=<?php echo "./showProduct.php?code=$item->id " ?> class="commander">
        <div class="img">
            <img src="<?php echo "./" . $item->path ?>" width="100%" height="100%" class="card-img-top" alt="product item">
        </div>
    </a>
    <div class="card-body">
        <a href=<?php echo "./showProduct.php?code=$item->id " ?> " class=" commander">
            <h5 class="card-title title"><?php echo $item->libelle; ?> </h5>
            <p class="card-text prix"><?php echo $item->prix; ?></p>
        </a>
        <a href=<?php echo "./showProduct.php?code=$item->id " ?> class="btn btn-warning btn-block btncommade my-3">
            Detail Produit
        </a>
    </div>
</div>