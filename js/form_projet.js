jQuery(document).ready(function() {
    // init page //
    $('#info, #distant, #local').hide();
    $('#boutton_submit').click(function() {
        verif();
    });
    // init page //

    // action choix //
    $('#boutton_local').click(function () {
        $('#localisation').animate({opacity: '0', marginTop: '20px'}, 'slow', function() {
            $(this).hide();
            $('#local').show();
            $('#info').fadeTo(0).show().animate({opacity: '1'}, 'slow');
        });
    });

    $('#boutton_distant').click(function () {
        $('#localisation').animate({opacity: '0', marginTop: '20px'}, 'slow', function() {
            $(this).hide();
            $('#distant').show();
            $('#info').fadeTo(0).show().animate({opacity: '1'}, 'slow');
        });
    });
    // action choix //

    // verif //
    function verif() {
        // verif champ important //
        var local = document.querySelector('#local').style.display;
        var distant = document.querySelector('#distant').style.display;
        var inputLocal = document.querySelectorAll('#info input');
        var erreur = 0;

        if (local != 'none') {
           // verif pour local //
           var form = 'local';
            if (inputLocal[0].value != '' && inputLocal[1].value != '') {
                <?php 
                    $i = 1;
                    $titre = '';
                    $image = '';
                    $lien = '';
                    foreach ($dbh->query('SELECT titre, image, lien FROM projet') as $row) {
                        $titre .= '\'' . $row[0] . '\',';
                        $image .= '\'' . $row[1] . '\',';
                        $lien .= '\'' . $row[2] . '\',';
                    }
                 ?>

                 var titre = [<?php echo $titre ?>];
                 var image = [<?php echo $image ?>];

                 for (i = 0; i < titre.length; i++) {
                     if (titre[i] == inputLocal[0].value) {
                         alert('Le titre est deja utiliser.');
                         erreur++;
                     }
                     if (image[i] == inputLocal[1].value) {
                        alert('L\'image est deja utiliser.');
                        erreur++;
                    }
                 }
            }else {
                alert('Il manque des champ qui n\'on pas étais remplie.');
                erreur = 1;
            }
           // verif pour local //
        }else {
            // verif pour distant //
            var form = 'distant';
            if (inputLocal[0].value != '' && inputLocal[1].value != '' && inputLocal[2].value != '') {
                var titre = [<?php echo $titre ?>];
                 var image = [<?php echo $image ?>];
                 var lien = [<?php echo $lien ?>];

                 for (i = 0; i < titre.length; i++) {
                     if (titre[i] == inputLocal[0].value) {
                         alert('Le titre est deja utiliser.');
                         erreur++;
                     }
                     if (image[i] == inputLocal[1].value) {
                        alert('L\'image est deja utiliser.');
                        erreur++;
                    }
                    if (lien[i] == inputLocal[2].value) {
                        alert('Le lien est deja utiliser.');
                        erreur++;
                    }
                 }

                 var cache = inputLocal[2].value;
                 var debut = '';
                 var vue = 0;

                 for (i = 0; i < cache.length; i++) {
                     if (cache[i] != '.' && vue == 0) {
                        debut += cache[i];
                     }else {
                         vue++;
                     }
                 }

                 var debut = String(debut);
                 if ((debut != "http:\/\/www") && (debut != "https:\/\/www")) {
                     alert('Se n\'est pas un lien.');
                     erreur++;
                 }
            }else {
                alert('Il manque des champ qui n\'on pas étais remplie.');
                erreur = 1;
            }
            // verif pour distant //
        }
        // verif champ important //
        if (erreur == 0) {
            document.querySelector('form').action += '?form=' + form;
            document.querySelector('#projet').submit();
        }
    }
    // verif //
});