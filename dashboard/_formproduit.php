<form action="" method="POST" enctype="multipart/form-data">
    <div class="col-12 p-2">
        <label for="libelle" class="form-label ms-1">Libelle du produit:</label>
        <div class="input-group has-validation">
            <input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $item->libelle ?>" required>
        </div>
    </div>
    <div class="row p-2">
        <div class="col-6">
            <label for="qtestock" class="form-label ms-1">Qte Stock du produit:</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="qtestock" name="qtestock" value="<?php echo $item->qtestock ?>" required>
            </div>
        </div>
        <div class="col-6">
            <label for="prix" class="form-label ms-1">Prix du produit:</label>
            <div class="input-group has-validation">
                <input type="text" class="form-control" id="prix" name="prix" value="<?php echo $item->prix ?>" required>
            </div>
        </div>
    </div>
    <div class="col-12 p-2">
        <label for="marque" class="form-label ms-1">Marque du produit :</label>
        <div class="has-validation">
            <select name="marque" id="" class="form-select">
                <?php foreach ($marques->index() as $marque) { ?>
                    <?php if ($item->name !== $marque->name) { ?>
                        <option value="<?php echo $marque->marque_id ?>"><?php echo $marque->name ?> </option>
                    <?php } else { ?>
                        <option value="<?php echo $marque->marque_id ?>" selected> <?php echo $marque->name ?> </option>
                    <?php } ?>
                <?php } ?>
            </select>
            <button>Add New Marque</button>
        </div>
    </div>
    <div class="col-12 p-2">
        <label for="desc" class="form-label ms-1">Description du produit :</label>
        <div class="has-validation">
            <textarea name="desc" id="desc" cols="30" rows="5" class="form-control"><?php echo $item->description ?></textarea>
        </div>
    </div>
    <div class="col-12 p-2">
        <label for="imgprincipal" class="form-label ms-1">Image Principal :</label>
        <div class="has-validation">
            <img src="<?php echo "../../" . $item->path ?>" width="100px" alt="">
            <input type="file" name="imgprincipal" id="imgprincipal" class="form-control">
        </div>
    </div>
    <div class="col-12 p-2">
        <label for="desc" class="form-label ms-1">Images Secondaire :</label>
        <div class="has-validation">
            <?php foreach ($images as $img) { ?>
                <img src="<?php echo "../../" . $img->path ?>" width="100px" alt="">
                <a href="deleteimg.php?idimg=<?php echo $img->id ?>&code=<?php echo $id ?>">
                    <img src="../../img/trash-alt.svg" alt="" width="20" height="20">
                </a>
            <?php } ?>
        </div>
        <div class="addmoreimg">
            <input type="file" name="imgsecondaire[]" id="desc" class="form-control">
        </div>
        <div class="mt-2 text-center">
            <img src="../../img/plus-square.svg" alt="plus" height="25" width="25" id="more-img">
        </div>

    </div>
    <div class="text-center mt-3">
        <a href="Products.php" class="btn btn-md px-5 btn-primary mx-3">Cancel </a>
        <button type="submit" class="btn btn-md px-5 btn-warning">Update </button>
    </div>
</form>