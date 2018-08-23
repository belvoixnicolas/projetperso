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
        var erreur;

        if (local != 'none') {
            //console.log(inputLocal[2].target.files[0].name);
            console.log(document.querySelector('input[name=fichier]'));
        }else {
            console.log('distant')
        }
        // verif champ important //
        if (document.querySelector(' input[name=titre]').value != '') {
            //document.querySelector('#projet').submit();
            alert('ok');
        }
    }
    // verif //
});