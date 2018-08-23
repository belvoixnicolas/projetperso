<?php 
    include 'connect.php';
    if ($_POST['titre'] != '' && $_POST['descript'] != '' && $_POST['text'] != '' && $_FILES['header'] != ''){
        
        // Verification //
        $i = 1;
        $vue = 0;

        foreach ($dbh -> query('SELECT titre FROM tips') as $titre) {
            if ($_POST['titre'] == $titre[0]) {
                $vue++;
                echo '<h2 id="erreur">Le titre est déja utiliser, merci de le changer!</h2>';
            }
        }

        if ($vue == 0) {
            foreach ($dbh -> query('SELECT header FROM tips') as $head) {
                if ($_FILES['header']['name'] == $head[0]) {
                    $vue++;
                    echo '<h2 id="erreur">Le nom le l\'image du header est déja utiliser, merci de le changer!</h2>';
                }
            }
            if ($vue == 0) {
                while (isset($_FILES[$i])) {
                    foreach ($dbh -> query('SELECT source FROM image') as $source) {
                        if ($_FILES[$i]['name'] == $source[0]) {
                            $vue++;
                            echo '<h2 id="erreur">Le nom le l\'image "' . $_FILES[$i]['name'] . '" est déja utiliser, merci de le changer!</h2>';
                        }
                    }

                    $i++;
                }
            }
        }

        if ($vue == 0) {
            // upload tips //
            if ($_FILES['header']['error'] > 0) {
                echo "Erreur lors du transfert";
             }else {
               $extensions = array('jpg' , 'jpeg' , 'gif', 'png');
               $extansions_fichier = strtolower(substr(strrchr($_FILES['header']['name'] , '.') , 1));
               if ( in_array($extansions_fichier,$extensions) ) {
                 $nom = "img/tips_head/{$_FILES['header']['name']}";
                 $resultat = move_uploaded_file($_FILES['header']['tmp_name'],$nom);
                 if ($resultat) {
                   echo "Transfert réussi";
                 }else {
                   echo 'Transfert échouer';
                 }
               }else {
                 echo'movaise extansions';
               }
             }

             $req = $dbh->prepare('INSERT INTO `tips`(`ID`, `titre`, `header`, `description`, `code`) VALUES (NULL, :titre, :header, :descript, :code)');
            $req->execute(array(
                'titre' => $_POST['titre'],
                'header' => $_FILES['header']['name'],
                'descript' => $_POST['descript'],
                'code' => $_POST['type']
            ));
            // upload tips //
            // upload image //
            $i = 1;

            while (isset($_FILES[$i])) {
                if ($_FILES[$i]['error'] > 0) {
                    echo "Erreur lors du transfert";
                 }else {
                   $extensions = array('jpg' , 'jpeg' , 'gif', 'png');
                   $extansions_fichier = strtolower(substr(strrchr($_FILES[$i]['name'] , '.') , 1));
                   if ( in_array($extansions_fichier,$extensions) ) {
                     $nom = "img/contenu/{$_FILES[$i]['name']}";
                     $resultat = move_uploaded_file($_FILES[$i]['tmp_name'],$nom);
                     if ($resultat) {
                       echo "Transfert réussi";
                     }else {
                       echo 'Transfert échouer';
                     }
                   }else {
                     echo'movaise extansions';
                   }
                }

                $req = $dbh->prepare('INSERT INTO `image`(`ID`, `source`) VALUES (NULL, :source)');
                $req->execute(array(
                    'source' => $_FILES[$i]['name']
                ));

                $sql = 'SELECT ID FROM image WHERE source = "' . $_FILES[$i]['name'] . '"';
                $req = $dbh -> query($sql);
                $idImg = $req -> fetch();

                $sql = 'SELECT id FROM tips WHERE titre = "' . $_POST['titre'] . '"';
                $req = $dbh -> query($sql);
                $idTips = $req -> fetch();

                $req = $dbh->prepare('INSERT INTO `ilustre_tips`(`ID`, `ID_image`) VALUES (:idtips, :idimg)');
                $req->execute(array(
                    'idtips' => $idTips[0],
                    'idimg' => $idImg[0]
                ));

                 $i++;
            }
            // upload image //

            // upload text //
            $sql = 'SELECT id FROM tips WHERE titre = "' . $_POST['titre'] . '"';
                $req = $dbh -> query($sql);
                $idTips = $req -> fetch();
                
            $req = $dbh->prepare('INSERT INTO `text`(`ID`, `text`, `ID_tips`) VALUES (NULL, :contenu, :idtips)');
            $req->execute(array(
                'contenu' => $_POST['text'],
                'idtips' => $idTips[0]
            ));
            // upload text //
        }
        // Verification //
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
            <form class="tips" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <fieldset>
                    <input type="text" name="titre" placeholder="Titre" required>
                    <textarea name="descript" placeholder="Description" required></textarea>
                    <select name="type" required>
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="javascript">Javascript</option>
                        <option value="php">PHP</option>
                    </select>
                    <input type="file" name="header" placeholder="header" required>
                </fieldset>
                <div class="main"></div>
                <button id="ligne" type="button">Ajout ligne</button>
                <button id="para" type="button">Ajout paragraphe</button>
                <button id="code" type="button">Ajout code</button>
                <button id="img" type="button">Ajout image</button>
                <fieldset id="fichier">

                </fieldset>
                <button id="envoyer" type="button">Envoyer</button>
            </form>
        </main>
    </body>
    <script type="text/javascript"><?php include 'js/form.js'?></script>
  </html>