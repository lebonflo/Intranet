<?php
session_start();
include('php/config.php');
include('php/header.php');

$queryValue = $conn->query("SELECT * FROM revendeurs_post WHERE id='".$_GET["id"]."'");
$defaultValue = $queryValue->fetch();
?>
<!-- MODAL EDIT POST -->
<div id="overlay">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit a post...</h5>
                <button type="button" class="close">
                    <a href="admin.php"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="" method="POST">
                    <div class="container text-center">
                        <textarea id="textarea" name="contentEditPost">
                        <?php
                        echo($defaultValue[1]);
                        ?>
                        </textarea>
                    </div>
                    <script type="application/javascript">
                    tinymce.init({
                        selector: '#textarea',
                        statusbar: false,
                        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                        toolbar_mode: 'floating',
                        height: 400
                        });
                    </script>
                    <input class="form-control mt-3 mb-3" type="text" value="
                    <?php
                    echo($defaultValue[2]);
                    ?>">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="submitEditPost">Post !</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

if (isset($_POST['submitEditPost'])) {
    $queryEdit = $conn->query("UPDATE revendeurs_post SET content='".$_POST["contentEditPost"]."', offer='".$_POST["offerEditPost"]."' WHERE id='".$_GET["id"]."'");
    $editPost = $queryEdit->fetch();
    header('Location: admin.php');
}

include('php/footer.php');
?>