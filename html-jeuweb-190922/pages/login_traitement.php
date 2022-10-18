<?php
if(isset($_SESSION['token'])){
  header('Location: /?page=profile');
}
if(!empty($_POST['email']) && !empty($_POST['password'])){

    $email = htmlspecialchars(strtolower($_POST['email'])); 
    $password = htmlspecialchars($_POST['password']);
    
    $check = $bdd->prepare('SELECT id,token,password FROM players WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();

    if($row < 1){ header('Location: /?page=register&res=3'); die();}
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ header('Location: /?page=register&res=2'); die();}
    if(!password_verify($password, $data['password'])){ header('Location: /?page=register&res=1'); die();}
    $_SESSION['token'] = $data['token'];
    $_SESSION['id'] = $data['id'];
    header('Location: /');
    die();           
    
}else{ header('Location: /?page=register&res=4'); die();}

?>