<?php
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=guerra;charset=utf8' ,'phpmyadmin', 'GAMER2003loris');
	}catch(Exception $e){
		die('Erreur: Contactez un administrateur du site. La base de donnée n\'est pas connectée.');
		//die('Erreur: '.$e->getMessage());
	}
?>