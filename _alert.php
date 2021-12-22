<?php if (isset($_SESSION['msg'])) {  ?>
    <?php if ($_SESSION['msg'] !== null) {  ?>
        <div class="<?php echo "alert alert-{$_SESSION["color"]} alert-dismissible fade show text-center text-uppercase" ?> " role="alert" style="position: absolute; width: 100%;" id="alert">
            <strong><?php echo $_SESSION['msg'] ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php } ?>
<?php } ?>
<?php unset($_SESSION["msg"]) ?>