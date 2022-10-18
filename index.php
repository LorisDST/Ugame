<?php 
    session_start();
    require_once 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guerra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <style type="text/css">
      html {
        --scrollbarBG: #212529;
        --thumbBG: white;
      }
      body::-webkit-scrollbar {
        width: 11px;
      }
      body {
        scrollbar-width: thin;
        scrollbar-color: var(--thumbBG) var(--scrollbarBG);
      }
      body::-webkit-scrollbar-track {
        background: var(--scrollbarBG);
      }
      body::-webkit-scrollbar-thumb {
        background-color: var(--thumbBG) ;
        border-radius: 6px;
        border: 3px solid var(--scrollbarBG);
      }
      
    </style>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Guerra</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav mx-auto">
            <a class="nav-link" href="/">Carte</a>
          </div>
          <div class="navbar-nav">
            <?php if(isset($_SESSION['token'])){ ?>
                <a class="nav-link" href="/?page=profile">Mon compte</a>
            <?php } else{ ?>
                <a class="nav-link" href="/?page=register">Connexion</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </nav>
    <div>
        <?php
          $array = array("login","login_traitement","register","register_traitement","profile","disconnect","screen");
          $dir = 'html-jeuweb-190922/pages/';
          if(isset($_GET["page"])==0){
            require($dir . "screen.php");
          }else{
            if(in_array($_GET["page"], $array)){
             require($dir . $_GET["page"] . ".php");
            }else{
              header("Location: 404");
            }
          }
        ?>
    </div>
</body>
</html>
