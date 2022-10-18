<?php
if(!isset($_SESSION['token'])){
  header('Location: /?page=login');
}
$req = $bdd->prepare('SELECT pseudo,email,registration_date FROM players WHERE id = ?');
$req->execute(array($_SESSION['id']));
$data = $req->fetch();

?>

<div class="container d-flex justify-content-center align-items-center" style="margin-top: 110px;">   
 <div class="card px-4">

  <div class="mt-3 text-center">

    <h4 class="mb-0"><?=$data['pseudo']?></h4>
    <span class="text-muted d-block mb-2"><?= $data['email'];?></span>
    <span class="d-block mb-3"><u>Date d'inscription:</u> <?= $data['registration_date'];?></span>                
  </div>               
 </div>
</div>
<div class="text-center mt-3">
	<a class="btn btn-danger" href="/?page=disconnect" role="button">Déconnexion</a>
</div>