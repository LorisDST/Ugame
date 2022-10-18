
<?php
    session_start();
    if(!isset($_SESSION['token'])){
      header('Location: /?page=register');
    }
?>

<style>
  body{
    background-color: gray;
  }
  .scroll-bg{
    margin: -10px;
    padding: -30px;
    
  }
  ::-webkit-scrollbar-corner{
    background-color:rgba(255, 255, 255, 0);
  }
  .att{
    text-align: center;
    color:white;
    border : 5px solid black;
    border-radius: 5px;
    padding:0px;
    background-color: orange;
  }
  .msg{
    background-color: blue;
    text-align: center;
    color:white;
    padding:0px;
    border : 5px solid black;
    border-radius: 5px;
  }
  input[type=text] {
  width: 100%;
  padding: 0px;
  margin: 0px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  padding: 0px;
  margin: 0px ;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
  #a{
    padding:5px
  }
  #b{
    padding: 5px;
  }
  #c{
    padding: 5px;
  }
  ::-webkit-scrollbar {
  width: 10px;
  }
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px; 
    border-radius: 5px;
  }
  ::-webkit-scrollbar-thumb {
    background: grey; 
    border-radius: 10px;
    border:0.5px solid black;
  }
  .scroll-div2{
      height: 150px;
      overflow: scroll;
      overflow-y: scroll;
      background-color:purple;
      border:3px solid black;

  }
  .scroll-div1{
      height: 150px;
      overflow: scroll;
      overflow-y: scroll;
      background-color:yellow;
      border:3px solid black;
  }
  .scroll-object1{
      color: black;
      font-family: cursive;
      font-size: 11px;
      padding: 3px;
      

  }
  .scroll-object2{
      color: white;
      font-family: cursive;
      font-size: 11px;
      padding: 3px;
      
  }
  #info{
     text-align: left;
     z-index: 1;
     border: 1px solid black;
     width: 1500px;
     height: 100px;
     position: fixed;
     left: calc((100% - 1500px) / 2);
     top: 55px;
     background-color: white;
  }
  #screen-left{
    position: absolute;
    top: 165px;
    left: calc((100% - 1850px) / 2);
    position: fixed;
    background-color: linear-gradient(purple,blue);
    border-radius: 1rem;
    border: 5px solid blue;
    width: 200px;
    
  }
  #screen{
    position: absolute;
    top: 165px;
    left: calc((100% - 1500px) / 2);
    background-color: white;
    border: 5px solid black;
    width: 1500px;
    height: 1500px;
  }
  #screen-right{
    position: absolute;
    top: 165px;
    right: calc((100% - 1870px) / 2);
    position: fixed;
    border: 5px solid green;
    width: 185px;

  }
  .player_dot{
    position: absolute;
    border-radius: 1px;
    box-shadow:
      0px 0px 10px black,
      0px 0px 10px black,
      0px 0px 10px black,
      0px 0px 10px black,
      0px 0px 10px black
    ;
    width: 3px;
    height: 3px;
  }
</style>







<!--  --------------------------------------------------------------------  -->

<div id="info">
<?php
  /*$req = $bdd->prepare('SELECT pseudo,x_coord,y_coord,color,energie,industrie FROM players,players_stats WHERE players.id=players_stats.player_id');
  $req->execute(array($_SESSION['id']));
  $data = $req->fetch();
  $pse=$data["pseudo"];
  $x_co=$data["x_coord"];
  $y_co=$data["y_coord"];
  $indu=$data["industrie"];
  $ener=$data["energie"];*/?>
  <div >
    <?php
      #echo "pseudo :",$pse,"<br>   X : ", $x_co ," , Y : ", $y_co ,"<br>  industrie : ", $indu ," <br>  energie : ", $ener;
    ?>
  </div>
</div>
<script>
  var infodiv = document.getElementById("info");
  function setInfo(name, x, y, energie,industrie)
  {
    infodiv.innerHTML = name + "<br />X: " + x + "; Y: " + y +"<br/> energie:"+energie+"<br/> industrie: "+industrie;
  }
</script>
<div id="screen-left" class="container">
  <div class="col">
    <div class="row">
      <div class="bg-danger">
      <u><b>Industrie</b></u><br>
        possédé:
        <?php
          $token = $_SESSION['token'];
          $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
          $req->execute();
          $id = $req->fetch()['id'];

          $req = $bdd->prepare("SELECT niv_ind FROM players_stats WHERE player_id='$id'");
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();
          
          $req = $bdd->prepare("SELECT * FROM players_stats where player_id='$id'");
          $req->execute();
          $line = $req->fetch();
          $lvl_ind= $line["niv_ind"];
          echo $lvl_ind;
        
          $prix = 200*$lvl_ind;
          $prix2 = 10*$lvl_ind;

          echo "<br>","Coût:","<br>";
          echo "- ",$prix, " d'industrie","<br>";
          echo "- ",$prix2," d'énergie";
            ?>
      
      <form action="./action.php" method="POST">
        <input type="submit" name="button1"
                class="button" value="Lvl UP" />
      </form>
      
</div>
<div class="bg-primary">
      <u><b>Central</b></u><br>
        possédé:
        <?php
          $token = $_SESSION['token'];
          $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
          $req->execute();
          $id = $req->fetch()['id'];

          $req = $bdd->prepare("SELECT niv_cent FROM players_stats WHERE player_id='$id'");
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();

          $req = $bdd->prepare("SELECT * FROM players_stats where player_id='$id'");
          $req->execute();
          $line = $req->fetch();
          $lvl_cent= $line["niv_cent"];
          echo $lvl_cent;

          $prix = 200*$lvl_cent;
          $prix2 = 10*$lvl_cent;

          echo "<br>","Coût:","<br>";
          echo "- ",$prix, " d'industrie","<br>";
          echo "- ",$prix2," d'énergie";
          ?>

      <form action="./action.php" method="POST">
        <input type="submit" name="button2"
                class="button" value="Lvl UP" />
      </form>
      
</div>
<div class="bg-info">
      <u><b>Canon</b></u><br>
        possédé:
        <?php
          $token = $_SESSION['token'];
          $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
          $req->execute();
          $id = $req->fetch()['id'];

          $req = $bdd->prepare("SELECT canon FROM players_stats WHERE player_id='$id'");
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();

          $req = $bdd->prepare("SELECT * FROM players_stats where player_id='$id'");
          $req->execute();
          $line = $req->fetch();
          $nbr_canon= $line["canon"];
          echo $nbr_canon;

          $prix = 15*$nbr_canon;
          $prix2 = 2*$nbr_canon;

          echo "<br>","Coût:","<br>";
          echo "- ",$prix, " d'industrie","<br>";
          echo "- ",$prix2," d'énergie";
          ?>
        
      <form action="./action.php" method="POST">
        <input type="submit" name="button3"
                class="button" value="Build" />
      </form>
      
</div>

<!--
    <div class="row">
      <button class="bg-info"  method="post">
        <u><b>Centrale</b></u><br>
        possédé:
        <?php
          $req = $bdd->prepare('SELECT centrale FROM players,players_stats WHERE players.id=players_stats.player_id');
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();?>
          <p>
            <?php 
              echo($test["centrale"]);
            ?>
          </p>
        Coût:<br>
        - 200 d'industrie<br>
        - 20 d'énergie
      </button>
    </div>
    <div class="row">
      <button class="bg-primary" method="post">
        <u><b>Canon</b></u><br>
        possédé:
        <?php
          $req = $bdd->prepare('SELECT canon FROM players,players_stats WHERE players.id=players_stats.player_id');
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();?>
          <p>
            <?php 
              echo($test["canon"]);
            ?>
          </p>
        Coût:<br>
        - 15 d'industrie<br>
        - 2 d'énergie
      </button>
      <button class="bg-primary" method="post">
        <u><b>troupe offensive</b></u><br>
        possédé:<?php
          $req = $bdd->prepare('SELECT troupe_offensive FROM players,players_stats WHERE players.id=players_stats.player_id');
          $req->execute(array($_SESSION['id'])); 
          $test = $req->fetch();?>
          <p>
            <?php 
              echo($test["troupe_offensive"]);
            ?>
          </p>
        Coût:<br>
        - 10 d'industrie<br>
      </button>
      <button class="bg-primary" method="post">
        <u><b>troupe logistique</b></u><br>
        possédé:
        <?php
          #$req = $bdd->prepare('SELECT troupe_logistique FROM players,players_stats WHERE players.id=players_stats.player_id');
          #$req->execute(array($_SESSION['id'])); 
          #$test = $req->fetch();?>
          <p>
            <?php 
            #  echo($test["troupe_logistique"]);
            #?>
          </p>
        Coût:<br>
        - 10 d'industrie<br>
      </button>-->
    </div>
  </div>
</div>
<div id="screen">
  <?php 
  $req = $bdd->prepare('SELECT pseudo,x_coord,y_coord,color,industrie,energie FROM players,players_stats WHERE players.id=players_stats.player_id');
  $req->execute(array($_SESSION['id']));
  $data = $req->fetch();
  while($data != false) { ?>
    <div
       class="player_dot"
       style="top: <?=$data['y_coord'] * 3; ?>px; left: <?=$data['x_coord'] * 3; ?>px; background-color: <?=$data['color']; ?>;"
       onmouseover="setInfo('<?=$data['pseudo']; ?>', <?=$data['x_coord']; ?>, <?=$data['y_coord']; ?>,<?=$data['industrie']; ?>,<?=$data['energie']; ?>);">
    </div>
  <?php $data= $req->fetch();} ?>
</div>
<div id="screen-right" class="container">
  
<div id="a">
    <form action="./action.php" method="POST">
        <input type="TEXT" name="nbr_troupes_lo" placeholder="Troupes logistiques...">
        <br>
        <input type="SUBMIT" name="Former1" value="Former">
        <br>
    </form>
  </div>
  <div id="a">
    <form action="./action.php" method="POST">
        <input type="TEXT" name="nbr_troupes_a" placeholder="Troupes attaque...">
        <br>
        <input type="SUBMIT" name="Former2" value="Former">
        <br>
    </form>
  </div>
  <div id="b">
    <form action="./action.php" method="POST">
        <br>
        <input type="TEXT" name="x" placeholder="Coordonnée x...">
        <br>
        <input type="TEXT" name="y" placeholder="Coordonnée y...">
        <br>
        <input type="SUBMIT" name="attack" value="Attaque">
        <br>
    </form>
  </div>
  <div id="c">
    <form action="./action.php" method="POST">
        <br>
        <input type="TEXT" name="Messages" placeholder="Message...">
        <br>
        <input type="SUBMIT" name="send" value="Envoyer">
    </form>
  </div>
  <br>
  <div class="scroll-bg">
    <div class="att">Attaques en cours :</div>
      <div class="scroll-div1">
          <div class="scroll-object1">
          <?php
          $array = array();
          $req = $bdd->prepare('SELECT * FROM attack');
          $req->execute();
          while ($line = $req->fetch()){
              $array[] = $line;
          }
          $array2 = array();
          $req = $bdd->prepare('SELECT * FROM players');
          $req->execute();
          while ($line = $req->fetch()){
              $array2[] = $line;
          }
          foreach($array as $l){
            $id_attt = $l['id_attacker'];
            $id_def = $l['id_defender'];
            foreach($array2 as $li){
              if($li['id'] == $id_attt){
                $pseudo_att = $li['pseudo'];
              }
              if($li['id'] == $id_def){
                $pseudo_def = $li['pseudo'];
              }
            }
            $vic = $l['victoire'];
            if ($vic == 0){
              
              echo $pseudo_att," attaque ",$pseudo_def," en ce moment !!";
              echo "<br>";
              echo "<br>";
            }
            if ($vic == 1){
              echo $pseudo_att," est ressortis victorieux !!!";
              echo "<br>";
              echo "<br>";
            }
            if($vic == 2){
              echo $pseudo_def," s'est défendu vaillamment et a gagné !!!";
              echo "<br>";
              echo "<br>";
            }
          }
          
          ?>
          </div>
      </div>
  </div>
  <br>
  <div class="scroll-bg"> 
    <div class="msg">Messages :</div>
      <div class="scroll-div2">
          <div class="scroll-object2">
          <?php
          $array = array();
          $req = $bdd->prepare('SELECT * FROM message');

          $req->execute();
          while ( $line = $req->fetch()){
              $array[] = $line;
          }
          foreach($array as $l){
            $msg = $l['message'];
            $pseudo = $l['pseudo'];
            $time = $l['time'];
            echo $time," | ",$pseudo,": ",$msg;
            echo "<br>";
          }
          
          ?>
          </div>
      </div>
  </div>
  
  
</div>
