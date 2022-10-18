<?php
if(isset($_SESSION['token'])){
  header('Location: /?page=profile');
}
if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']) && !empty($_POST['color'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars(strtolower($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);
    $color = htmlspecialchars($_POST['color']);
    $ip = $_SERVER['REMOTE_ADDR']; 

    $check = $bdd->prepare('SELECT id FROM players WHERE email = ? OR pseudo = ? OR ip = ?');
    $check->execute(array($email,$pseudo,$ip));
    $col = $bdd->prepare('SELECT color FROM players,players_stats WHERE players.id=players_stats.player_id');
    $col->execute(array($ip));
    $colo=$col->fetch();
    $mail = $bdd->prepare('SELECT email FROM players WHERE email=?');
    $mail->execute(array($email));
    $test=$mail->fetch();
    $count=$mail->rowCount();
    $pse = $bdd->prepare('SELECT pseudo FROM players WHERE pseudo=?');
    $pse->execute(array($pseudo));
    $on=$pse->fetch();
    $cd=$pse->rowCount();
    $data = $check->fetch();
    $row = $check->rowCount();
    
    if($count > 0){ header('Location: /?page=register&res=5');die();}
    if($cd > 0){ header('Location: /?page=register&res=8');die();}
    if(strlen($pseudo) > 100){ header('Location: /?page=register&res=4'); die();}
    if(strlen($email) > 100){ header('Location: /?page=register&res=3'); die();}
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ header('Location: /?page=register&res=2'); die();}
    if($color==$colo["color"]){ header('Location: /?page=register&res=7'); die();}
    if(!$password === $password_retype){ header('Location: /?page=register&res=1'); die();}

    $cost = ['cost' => 12];
    $password = password_hash($password, PASSWORD_BCRYPT, $cost);

    $insert = $bdd->prepare('INSERT INTO players(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
    $insert->execute(array(
        'pseudo' => $pseudo,
        'email' => $email,
        'password' => $password,
        'ip' => $ip,
        'token' => bin2hex(openssl_random_pseudo_bytes(64))
    ));

    $reqCoord = $bdd->prepare('SELECT x_coord,y_coord FROM players_stats');
    $reqCoord->execute(array($pseudo));
    $dataCoord = $reqCoord->fetch();
    $coords = array();
    while($dataCoord != false){
        array_push($coords,$dataCoord['x'].$dataCoord['y']);
        $dataCoord = $reqCoord->fetch();
    }
    $x_coord = rand(0, 500);
    $y_coord = rand(0, 500);
    while(in_array($x_coord.$y_coord, $coords)){
        $x_coord = rand(0, 500);
        $y_coord = rand(0, 500);
    }

    $req = $bdd->prepare('SELECT id FROM players WHERE pseudo = ?');
    $req->execute(array($pseudo));
    $data = $req->fetch();

    $insert = $bdd->prepare('INSERT INTO players_stats(player_id, x_coord, y_coord, color) VALUES(?, ?, ?, ?)');
    $insert->execute(array($data['id'], $x_coord, $y_coord, $color));

    header('Location: /?page=register&res=0'); 
    die(); 
} #else{ header('Location: /?page=register&res=6'); die();}          
?>