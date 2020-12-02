<?php
session_start();
include('php/config.php');
include('php/header.php');
?>
<div class="sidenav">
   <div class="login-main-text">
      <h1>Workplace Login</h1>
      <p>Connectez-vous pour accéder a votre espace membre.</p>
   </div>
</div>
<div class="main">
   <div class="col-md-6 col-sm-12">
      <div class="login-form">
         <form method="POST" action="">
            <div class="form-group">
               <label>Nom d'utilisateur</label>
               <input type="text" class="form-control" placeholder="Email" name="email">
               <label>Mot de passe</label>
               <input type="password" class="form-control" placeholder="Password" name="password">
            </div>
            <input type="submit" class="btn btn-blue" name="submit" value="Connexion">
         </form>
      </div>
   </div>
</div>
</div>
<?php
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $req = $conn->prepare("SELECT * FROM revendeurs WHERE email=? AND password=? LIMIT 1");
  $req->execute(array($email, $password));
  $tab = $req->fetchAll();
  if(count($tab)>0) {
    $id = $tab[0]['id'];
    $offer = $tab[0]['offer'];
    $_SESSION["id"]=$id;
    $_SESSION["offer"]=$offer;
    if ($_SESSION["offer"] === 'admin'){
      header('Location: admin.php');
    } else {
      header('Location: users.php');
    }
  } else {
    echo('<div class=" error-msg alert alert-danger" role="alert">Email ou Mot de pass incorrect.</div>');
  }
}
include('php/footer.php');
?>