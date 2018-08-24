<?php
include 'connect.php';

if ($_GET['form'] == 'local') {
    if (isset($_POST['titre']) && isset($_FILES['image'])) {
        // Verif //
        $erreur = 0;

        foreach ($dbh->query('SELECT titre, image FROM projet') as $verif) {
            if ($_POST['titre'] == $verif[0] || $_FILES['image']['name'] == $verif[1]) {
                echo '<h2 id="erreur">ERREUR!</h2>'
                $erreur++;
            }
        }

        if ($_FILES['image']['error'] > 0) {
            echo "Erreur lors du transfert";
            $erreur++;
         }else {
           $extensions = array('jpg' , 'jpeg' , 'gif', 'png');
           $extansions_fichier = strtolower(substr(strrchr($_FILES['image']['name'] , '.') , 1));
           if ( in_array($extansions_fichier,$extensions) ) {
             $nom = "img/projet/{$_FILES['image']['name']}";
             $resultat = move_uploaded_file($_FILES['image']['tmp_name'],$nom);
             if ($resultat) {
               echo "Transfert réussi";
               $erreur++;
             }else {
               echo 'Transfert échouer';
               $erreur++;
             }
           }else {
             echo'movaise extansions';
             $erreur++;
           }
         }

        if ($erreur == 0) {
            $req = $dbh->prepare('INSERT INTO `projet`(`ID`, `titre`, `lien`, `image`) VALUES (NULL, :titre, :lien, :image)');
            $req->execute(array(
                'titre' => $_POST['titre'],
                'lien' =>  'local/' . $_POST['titre'],
                'image' => $_FILES['image']['name']
            ));
        }
        // Verif //
    }
}elseif ($_GET['form'] == 'distant') {
    echo '<p>Rien pour l\'instant</p>';
}
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
      <title>Portfolio</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="ISO-8859-1" />
      <meta name="theme-color" content="blue">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
      <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
      <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
      <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
      <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
      <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
      <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
      <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
      <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
      <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
      <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
      <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
      <link rel="manifest" href="img/favicon/manifest.json">
      <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
      <link rel="stylesheet" type="text/css" href="css/" />
    </head>
    <body>
        <main>
            <form id="projet" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <fieldset id="localisation">
                    <input type="button" id="boutton_local" value="Projet en local">
                    <input type="button" id="boutton_distant" value="Projet distant">
                </fieldset>
                <fieldset id="info">
                    <input type="text" name="titre" placeholder="Titre">
                    <input type="file" name="image">
                    <fieldset id="distant">
                        <input type="url" name="lien" placeholder="Lien du projet">
                    </fieldset>
                    <fieldset id="local">
                        <!-- <input type="file" name="fichier" webkitdirectory mozdirectory msdirectory odirectory directory multiple="multiple"> -->
                        <input type="file" name="sql">
                    </fieldset>
                    <input type="button" id="boutton_submit" value="Envoyer">
                </fieldset>
            </form>
        </main>
    </body>
    <script><?php include 'js/form_projet.js'; ?></script>
  </html>
