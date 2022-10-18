<?php

session_start();
if(!isset($_SESSION['token'])){
  header('Location: /?page=register');
}

require_once('database.php');

  if(isset($_POST['Former1']))
  {
      if(isset($_POST['nbr_troupes_lo']))
      {   
          if(!empty($_POST['nbr_troupes_lo']) )
          {
          $logistic=htmlspecialchars($_POST['nbr_troupes_lo']);
          
          $token = $_SESSION['token'];
          $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
          $req->execute();
          $id = $req->fetch()['id'];

          $array = array();
          $req = $bdd->prepare("SELECT * FROM players_stats WHERE player_id='$id'");/**/
          $req->execute();
          $l=$req->fetch();
          while ( $line = $req->fetch()){
            $array[] = $line;
            }
          
          foreach($array as $l){
            $troop = $l['troupe_logistique'];
            $troop2= $troop + $logistic;
            $ind = $l['industrie'] - 10;
            $idl= $l['player_id'];
            $req = $bdd->prepare(" UPDATE players_stats SET troupe_logistique='$troop2',industrie='$ind' WHERE player_id='$idl' ");

            $req->execute();
           }
          }
      }
  }
  if(isset($_POST['Former2']))
  {
      if(isset($_POST['nbr_troupes_a']))
      {
          if(!empty($_POST['nbr_troupes_a']) )
          {
          $attack=htmlspecialchars($_POST['nbr_troupes_a']);
          $array = array();
          $req = $bdd->prepare('SELECT * FROM players_stats');
          $req->execute();
          while ( $line = $req->fetch()){
            $array[] = $line;
            }
          foreach($array as $l){
            $troop = $l['troupe_offensive'];
            $troop2= $troop + $attack;
            $ind = $l['industrie'] - 10;
            $id=$l['player_id'];
            $req = $bdd->prepare(" UPDATE players_stats SET troupe_offensive='$troop2',industrie='$ind' WHERE player_id='$id' ");
            $req->execute();
            }
          }
          
          
      }
  }
  if(isset($_POST['attack']))
  {
    if(isset($_POST['x']) and isset($_POST['y']))
    {
      if(!empty($_POST['x']) and !empty($_POST['y']))
      {
        $x=htmlspecialchars($_POST['x']);
        $y=htmlspecialchars($_POST['y']);
        $array = array();
        $req = $bdd->prepare('SELECT * FROM players_stats');
        $req->execute();
        while ( $line = $req->fetch()){
          $array[] = $line;
          }
        $token = $_SESSION['token'];
        $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
        $req->execute();
        $id = $req->fetch()['id'];
        foreach($array as $l){
          if($l['x_coord'] = $x AND $l['y_coord']=$y){
            $def = $l['player_id'];
            $nb_canon = $l['canon'];
          }
          
        }
        foreach($array as $li){
          if($id == $li['player_id']){
            $tr_lo = $li['troupe_logistique'];
            $tr_att = $li['troupe_offensive'];
            $x_att = $li['x_coord'];
            $y_att = $li['y_coord'];
          } 
        }
        
        $req = $bdd->prepare("INSERT INTO attack (id_attacker, id_defender, nbr_canon, nbr_troupes_logi, nbr_troupes_attack, x_attack, y_attack, x_def, y_def) VALUES ('$id','$def','$nb_canon','$tr_lo','$tr_att','$x_att','$y_att','$x','$y') ");
        $req->execute();
      }
    }
    
  }
  if(isset($_POST['send']))
  {
      if(isset($_POST['Messages']))
      {
          if(!empty($_POST['Messages']) )
          {
          $msg=htmlspecialchars($_POST['Messages']);
          $token = $_SESSION['token'];
          $req = $bdd->prepare("SELECT pseudo FROM players WHERE token= '$token'");
          $req->execute();
          $pseudo = $req->fetch()['pseudo'];
          $req = $bdd->prepare("INSERT INTO message (pseudo,message) VALUES ('$pseudo','$msg')");
          $req->execute();
          }
      }
  }
  if(isset($_POST['button1']))
      {
        
        $token = $_SESSION['token'];
        $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
        $req->execute();
        $id = $req->fetch()['id'];

        $req = $bdd->prepare("SELECT niv_ind FROM players_stats WHERE player_id='$id'");
        $req->execute();
        $niv = $req->fetch();

        $req = $bdd->prepare("UPDATE players_stats SET niv_ind=niv_ind+ 1, industrie=industrie-200, energie=energie-10 WHERE player_id='$id'");
        $req->execute(array($_SESSION['id']));
        
      }
  if(isset($_POST['button2']))
  {
    $token = $_SESSION['token'];
    $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
    $req->execute();
    $id = $req->fetch()['id'];

    $req = $bdd->prepare("SELECT niv_ind FROM players_stats WHERE player_id='$id'");
    $req->execute();
    $niv = $req->fetch();

    
    $req = $bdd->prepare("UPDATE players_stats SET niv_cent=niv_cent+ 1, industrie=industrie-200, energie=energie-10 WHERE player_id='$id'");
    $req->execute(array($_SESSION['id']));
  }
  if(isset($_POST['button3']))
  {
    $token = $_SESSION['token'];
    $req = $bdd->prepare("SELECT id FROM players WHERE token= '$token'");
    $req->execute();
    $id = $req->fetch()['id'];

    $req = $bdd->prepare("UPDATE players_stats SET canon=canon+ 1, industrie=industrie-15, energie=energie-2 WHERE player_id='$id'");
    $req->execute(array($_SESSION['id']));
  }
header('location:/',false);
?>

<!-- CODE CRON :
* * * * * /usr/bin/php /var/www/html/cron.php
* * * * * /usr/bin/php /var/www/html/cron_atk.php
-->



