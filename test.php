<?php

$ftp_server = 'localhost';
$ftp_user_name="test";
$ftp_user_pass="";
$rep = "C:\\Users\\Nicolas\\Documents\\papier\\banque\\relever\\2018\\";
$dir = opendir($rep);


// Création de la connexion
$conn_id = ftp_connect("$ftp_server");

// Authentification avec nom de compte et mot de passe
$login_result = ftp_login($conn_id, "$ftp_user_name", "$ftp_user_pass");

    // Vérification de la connexion
    if ((!$conn_id) || (!$login_result)) {
            echo "La connexion FTP a échoué!";
            echo "Tentative de connexion à $ftp_server avec $ftp_user_name";
            die;
        } else {
            echo "Connecté à $ftp_server, avec $ftp_user_name";
        }

        // Listage du contenu du répertoire + Upload des fichiers 
    while($f=readdir($dir)) { 
       if(is_file($rep.$f)) {
        echo 'ok'; 
       $source_file= $rep . $f;
    $destination_file="/test/".$f;
    $upload = ftp_put($conn_id, "$destination_file", "$source_file", FTP_BINARY);
        }else {
            $source_file= $rep . $f;
    $destination_file="/test/".$f;
            $upload = ftp_mkdir($conn_id, $source_file);
        }
    }

    // Vérification de téléchargement
    if (!$upload) {
            echo "Le téléchargement Ftp a échoué!";
        } else {
            echo "Téléchargement de $source_file sur $ftp_server en $destination_file";
        }

// Fermeture de la connexion FTP.
ftp_quit($conn_id);

?>