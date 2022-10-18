<?php
require_once('database.php');
$array = array();
$req = $bdd->prepare('SELECT * FROM attack');
$req->execute();
while ( $line = $req->fetch()){
    $array[] = $line;
}
foreach($array as $l){
    $count = 12;
    if($l['x_attack'] != $l['x_def'] OR $l['y_attack'] != $l['y_def']){
        if($l['x_attack'] < $l['x_def']){
            while($count == 0 OR $l['x_attack'] < $l['x_def']){
                $l['x_attack'] = $l['x_attack']+1;
                $count = $count-1;
            }
        }
        else if($l['x_attack'] > $l['x_def']){
            while($count == 0 OR $l['x_attack'] > $l['x_def']){
                $l['x_attack'] = $l['x_attack']-1;
                $count = $count-1;
            }
        }
        if ($count != 0){
            if($l['y_attack'] < $l['y_def']){
                while ($count == 0 OR $l['y_attack'] < $l['y_def']){
                    $l['y_attack'] = $l['y_attack']+1;
                    $count = $count-1;
                }
            }
            if($l['y_attack'] > $l['y_def']){
                while ($count == 0 OR $l['y_attack'] > $l['y_def']){
                    $l['y_attack'] = $l['y_attack']-1;
                    $count = $count-1;
                }
            }
        }
        $x_att_new =$l['x_attack'];
        $y_att_new =$l['y_attack'];
        $id_at = $l['id'];

        $req = $bdd->prepare("UPDATE attack SET x_attack='$x_att_new',y_attack='$y_att_new' WHERE id='$id_at'");
        $req->execute();

    }

}
foreach($array as $li){
    if($li['x_attack'] == $li['x_def'] AND $li['y_attack'] == $li['y_def']){
        $canon = $li['nbr_canon']*7;
        $puissance = $li['nbr_troupes_attack']*rand(1,5);
        $vol = $li['nbr_troupes_logi']*50;
        $id_att = $li['id_attacker'];
        $id_def = $li['id_defender'];
        $id_a = $li['id'];
        if($canon > $puissance){

            $req = $bdd->prepare("UPDATE players_stats SET troupe_logistique=0, troupe_offensive=0 WHERE player_id='$id_att' AND id='$id_a'");
            $req->execute();
            $req = $bdd->prepare("UPDATE attack SET victoire=2 ");
            $req->execute();
            
        }
        if($canon < $puissance){

            $req = $bdd->prepare("UPDATE players_stats SET canon=0 WHERE player_id='$id_def' AND id='$id_a'");
            $req->execute();
            $req = $bdd->prepare("UPDATE attack SET victoire=1 WHERE id='$id_a'");
            $req->execute();
            
        }

    }
}



print_r($array);

?>