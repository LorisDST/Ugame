
<?php
require_once('database.php');

$array = array();
$req = $bdd->prepare('SELECT * FROM players_stats');

$req->execute();
while ( $line = $req->fetch()){
    $array[] = $line;
}
foreach($array as $l){
    $niv1 = $l['niv_ind'];
    $niv2 = $l['niv_cent'];
    $nbr1 = $l['crea_indu'];
    $nbr2 = $l['centrale'];
    $ind = $l['industrie'] + 300*2**$niv1;
    $cent = $l['energie'] + 1200*2**$niv2;
    $id=$l['player_id'];

    $req = $bdd->prepare(" UPDATE players_stats SET industrie='$ind', energie='$cent' WHERE player_id='$id' ");
    $req->execute();
}
print_r($array);

?>