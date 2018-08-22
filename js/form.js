jQuery(document).ready(function(){
    var i = 1;
    var x = 1;

    $('#ligne').click(function() {
        $('.main').append('<div class="' + i +'"></div>');
        i++;
    });

    $('#para').click(function() {
        var ligne = document.querySelectorAll('.main div').length;
       $('.main .' + ligne).append('<p contenteditable="true">Text</p>');
    });

    $('#img').click(function() {
        var ligne = document.querySelectorAll('.main div').length;
        $('.main .' + ligne).append('<img src="img/" alt="photo">');
        $('#fichier').append('<input type="file" name="' + x + '">');
        x++;
    });

    $('#code').click(function() {
        var ligne = document.querySelectorAll('.main div').length;
       $('.main .' + ligne).append('<xmp contenteditable="true"><p>tape ton code</p></xmp>');
    });

    $('#envoyer').click(function() {
        var fichier = document.querySelector('.main').innerHTML;
        var nombreImg = document.querySelectorAll('#fichier input').length;
        
        $('.tips').append('<textarea name="text">' + fichier + '</textarea>');
        document.querySelector('.tips').submit();
    });
});