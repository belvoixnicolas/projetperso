<?php 
$i = 1;
$table = '';
foreach ($sources as $cache) {
    $table .= '\'' . $cache . '\'';

    if (count($sources) > $i) {
        $table .= ', ';
    }
    $i++;
}
?>

var sources = [<?php echo $table; ?>];
var image = document.querySelectorAll('main img');

for (i = 0; i < image.length; i++) {
    image[i].src += sources[i];
}