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
                <input type="submit" class="btn btn-info float-right mt-3" value="Deconnexion">
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
        <button class="btn btn-info float-right" @click="newPost=true">
            <i class="fas fa-plus-square"></i>&nbsp;&nbsp;New Post
        </button>
    </div>
</div>
<hr>


<?php
include('php/footer.php');
?>