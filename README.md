# Ugame


Bonjour voici notre jeu "Guerra" fait pour le projet Ugames.

Pour faire fonctionner ce jeu veuillez suivre les étapes ci-dessous :

1) Veuillez placer tout les fichiers présent dans ce repository avec la même architecture dans votre dossier "/var/www/html".
2) Ensuite, veuillez importer la Base de Donées grâce au fichier 'guerra (1).sql' dans votre phpmyadmin.
3) Veuillez changer les champs 'IDENTIFIANT' et 'MDP' dans le fichier 'database.php' afin d'y ajouter vos identifiants phpmyadmin afin que le code puisse accéder à la nouvelle BDD importé précédemment.
4) Installez Cron si celui-ci n'est pas sur votre machine puis créez une crontab grâce à la fonction 'sudo crontab -e' et collez le code suivants dans cette dernière et sauvegardez (sans les guillemets):
"
* * * * * /usr/bin/php /var/www/html/cron.php
* * * * * /usr/bin/php /var/www/html/cron_atk.php 
"
5) Ouvrez un navigateur et aller sur votre 'localhost' vous pourrez donc vous créer un compte et commencer à jouer !!!
6) Pour jouer nous vous avons laisser un bot pacifique afin que vous puissiez tester de l'attaquer.
7) Pour attaquer vous pourrez former des troupes puis attaquer certaines coordonnées grâce aux emplacements prévus à cet effet sur la droite.
8) Vous pouvez aussi en passant la souris sur les points sur la carte voir les informations concernants le joueur en question (notre ami le bot aussi).
9) Sur la partie de gauche vous pourrez améliorer votre niveau d'industrie, de centrale et produire des canons pour vous défendre.

10) Amusez-vous bien !!

Merci de votre lecture et encore une fois bon jeu !! 

VOISIN Vincent
VEDOVATI Jules
DOS SANTOS TRANCHANT Loris
