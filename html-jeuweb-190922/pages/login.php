<?php
if(isset($_SESSION['token'])){
  header('Location: /?page=profile');
}
$msg = "Inconnue.";
if(isset($_GET['res'])){
  switch($_GET['res']){
      case '1':
          $msg = "Les identifiants sont incorrectes.";
          break;
      case '2':
          $msg = "L'email n'est pas valide.";
          break;
      case '3':
          $msg = "Cet utilisateur n'est pas enregistré.";
          break;
      case '4':
          $msg = "Le formulaire n'est pas rempli.";
          break;
        break;
  }
}
?>

<form class="gradient-custom" style="margin-top: 100px;" action="?page=login_traitement" method="post">
  <div class="container py-5 h-90">
    <div class="row d-flex justify-content-center align-items-left h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="pb-5">
              <h2 class="fw-bold mb-2">Connexion</h2>
              <p class="text-white-50 mb-4">Entrez vos informations de connexion<br>pour pouvoir jouer !</p>
              <?php
                if(isset($_GET['res'])){
                  if($_GET['res']==0){
                    echo('<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Enregistré !</strong> Vous pouvez vous connecter.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                  }else{
                    echo('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Erreur:</strong> '.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                  }
                }
              ?>
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typeEmailX">Email</label>
                <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" required>
              </div>
              <div class="form-outline form-white mb-4">
                <label class="form-label" for="typePasswordX">Mot de passe</label>
                <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" required>
              </div>
              <button class="btn btn-outline-light btn-lg px-5" type="submit">Se connecter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>


<form class="gradient-custom" style="margin-top: 100px;" action="?page=register_traitement" method="post">
  <div class="container py-5 h-90">
    <div class="row d-flex justify-content-center align-items-right h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="pb-5">
              <h2 class="fw-bold mb-2">Inscription</h2>
              <p class="text-white-50 mb-3">Entrez vos informations d'inscription</p>
              <?php
                if(isset($_GET['res'])){
                  echo('<div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Erreur:</strong> '.$msg.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                }
              ?>
              <div class="form-outline form-white mb-4">
                <label class="form-label" name="pseudo">Pseudo</label>
                <input type="pseudo" id="typePseudoX" class="form-control form-control-lg" name="pseudo" required>
              </div>
              <div class="form-outline form-white mb-4">
                <label class="form-label" name="email">Email</label>
                <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" required>
              </div>
              <div class="form-outline form-white mb-4">
                <label class="form-label" name="password">Mot de passe</label>
                <input type="password" class="form-control form-control-lg" name="password" required>
              </div>
              <div class="form-outline form-white mb-4">
                <label class="form-label" name="password_retype">Confirmation du mot de passe</label>
                <input type="password" class="form-control form-control-lg" name="password_retype" required>
              </div>
              <div class="form-outline form-white mb-4">
                <label class="form-label" name="password_retype">Couleur du joueur</label>
                <input type="color" class="form-control form-control-lg" name="color" value="#<?php echo substr(md5(rand()), 0, 6); ?>" required>
              </div>
              <button class="btn btn-outline-light btn-lg px-5" type="submit">S'inscrire</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
