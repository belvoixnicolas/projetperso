<?php
    include 'connect.php';
?>
<!DOCTYPE HTML>
  <html lang="fr">
    <head>
      <title>Portfolio</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta charset="ISO-8859-1" />
      <meta name="theme-color" content="red">
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
      <link rel="stylesheet" type="text/css" href="css/portfolio.css" />
    </head>
    <body>
        <header>
            <h1>Portfolio</h1>
            <p>
                Cette page présente mon travaille effectuer au qu'elle je suis le plus fier.<br/>
                Vous pouvez naviguer dans c'est différente pages et regarder le code pour juger mon niveaux.<br/>
                Bonne visite !
            </p>
            <div class="scroller">
                <div class="mouse">
                    <div class="ball"></div>
                </div>
            </div>
        </header>
        <main>
            <menu>
                <button id="bouton_projet"><i class="fas fa-list-ul"></i>Mes projets</button>
                <button id="bouton_tips"><i class="far fa-star"></i>Mes tips</button>
            </menu>
            <article id="projet">
                <?php foreach ($dbh -> query('SELECT * FROM projet') as $projet) { ?>
                <section>
                    <img src="img/<?php echo $projet[3]; ?>">

                    <div>
                        <h2><?php echo $projet[1]; ?></h2>
                        <a href="<?php echo $projet[2]; ?>" target="_blanck">
                            <i class="fas fa-search"></i>
                            <span>Voir le site</span>
                        </a>
                    </div>
                </section>
                <?php } ?>
            </article>
            <article id="tips">
                <?php foreach ($dbh -> query('SELECT * FROM tips') as $tips) { ?>
                <a href="tips.php?id=<?php echo $tips[0] ?>">
                    <section class="<?php echo $tips[4]; ?>">
                        <h2><?php echo $tips[1]; ?></h2>
                        <p>
                            <?php echo $tips[3]; ?>
                        </p>
                    </section>
                </a>
                <?php } ?>
            </article>
        </main>
    </body>
    <script src="js/portfolio_base.js"></script>
  </html>