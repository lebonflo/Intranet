<?php
session_start();
include('php/config.php');
include('php/header.php');
?>
<div id="overlay">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete a post...</h5>
                <button type="button" class="close">
                <a href="admin.php"><span aria-hidden="true">&times;</span></a>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="container text-center">
                    <p>Voulez-vous vraiment supprimer ce Post ?</p>
                </div>
                <div class="modal-footer">
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-danger" name="submitDeletePost">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['submitDeletePost'])) {
    $queryDelete = $conn->query("DELETE FROM revendeurs_post WHERE id='".$_GET["id"]."'");
    $deletePost = $queryDelete->fetch();
    header('Location: admin.php');
}

include('php/footer.php');
?>