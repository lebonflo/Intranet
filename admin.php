<?php
session_start();
include('php/config.php');
include('php/header.php');
?>

<!-- NAVBAR -->
<div class="container-fluid">
    <div class="row" style="background-color: #0074c9;">
        <div class="col-lg-12">
            <p class="float-left text-light dp-4 pt-3" style="font-size: 25px;">Workplace</p>
            <form action="php/logout.php">
                <button class="btn btn-blue float-right mt-3">
                <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Déconexion
                </button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-lg-6">
            <h3>Time Line</h3>
        </div>
    <div class="col-lg-6">
        <button class="btn btn-blue float-right" @click="newPost=true">
            <i class="fas fa-plus-square"></i>&nbsp;&nbsp;New Post
        </button>
    </div>
</div>
<hr>

<!-- MODAL NEW POST -->
<div id="overlay" v-if="newPost">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a post...</h5>
                <button type="button" class="close" @click="newPost=false">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="" method="POST">
                    <div class="container text-center">
                        <textarea id="textarea" name="contentNewPost"></textarea>
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
                    <select class="form-control mt-3" name="offerNewPost">
                        <option value="gold">Gold</option>
                        <option value="platinium">Platinium</option>
                    </select>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" name="submitNewPost">Post !</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['submitNewPost'])) {
    $query = $conn->query("INSERT INTO revendeurs_post (content, offer) VALUES ('".$_POST["contentNewPost"]."','".$_POST["offerNewPost"]."')");
    $post = $query->fetch();
}

?>

<!-- POSTS -->
<?php
    $query1 = "SELECT * FROM revendeurs_post ORDER BY id DESC";
    foreach ($conn->query($query1) as $results) {
        $idPost = $results[0];
        $query2 = "SELECT * FROM revendeurs_commentaires WHERE id_post='$idPost' ORDER BY id DESC";
        echo '
            <div class="row" id="' . $idPost . '">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <img src="https://lptent.com/fr/wp-content/uploads/sites/2/2019/05/favicon.png"
                                alt="Lptent icone" style="max-height: 20px;">
                            LPTENT FRANCE
                            <button class="btn btn-light float-right">
                                <a href="http://localhost/intranet-php-vue/updatePost.php?id=' . $results[0] . '"><i class="fas fa-edit"></i></a>
                            </button>
                            <button class="btn btn-light float-right">
                                <a href="http://localhost/intranet-php-vue/deletePost.php?id=' . $results[0] . '"><i class="fas fa-trash-alt"></i></a>
                            </button>
                        </div>
                        <div class="card-body">
                            <p>' . $results[1] . '</p>
                        </div>
                        <div class="card-footer">
                            <p class="float-left">' . date('d/m/Y', strtotime($results[3])) . '</p>
                            <button class="btn btn-light float-right" @click="showComment=true">
                                <a href="#' . $idPost . '"><i class="fas fa-comment"></i>&nbsp;Comment</a>
                            </button>
                            <button class="btn btn-light float-right">
                                <i class="fas fa-thumbs-up"></i>&nbsp;Like
                            </button>
                            <p>-' . $idPost . '</p>
                        </div>
                    </div>
                </div>
                </div>
        ';
        echo '                            
            <button type="button" class="close float-right" v-if="showComment" @click="showComment=false">
                <span aria-hidden="true">&times;</span>
            </button>            
        ';
        foreach ($conn->query($query2) as $results) {
            echo '
                <div class="media mt-3" v-if="showComment">
                    <div class="col">
                        <div class="row">
                            <img src="https://eu.ui-avatars.com/api/?background=random&name=' . $results[3] . '&rounded=true" class="mr-3" style="max-height: 64px;">
                            <div class="col-12 media-body">
                                <h5 class="mt-0">' . $results[3] . '</h5>
                                <p>' . $results[1] . '</p>
                                ';
                                if ($results[2] == $_SESSION['id']) {
                                    echo '
                                        <button class="btn btn-light float-right">
                                            <i class="fas fa-edit"></i>
                                        </button>                                    
                                    ';
                                }
                                echo '
                                <button class="btn btn-light float-right">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        echo '
            <form action="POST">
                <div class="form-group mb-5">
                <textarea class="form-control textarea-control" rows="1" placeholder="Comment..."></textarea>
                </div>
            </form>
        ';
    }
include('php/footer.php');
?>