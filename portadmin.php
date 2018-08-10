<?php 
    include 'connect.php';

    if (isset($_POST['titre']) && isset($_POST['descript']) && isset($_POST['text'])){
        echo 'ok';
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
            <form class="tips" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <fieldset>
                    <input type="text" name="titre" placeholder="Titre" required>
                    <textarea name="descript" placeholder="Description" required></textarea>
                    <select name="type" required>
                        <option value="html">HTML</option>
                        <option value="css">CSS</option>
                        <option value="javascript">Javascript</option>
                        <option value="php">PHP</option>
                    </select>
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
    <script src="js/form.js"></script>
  </html>