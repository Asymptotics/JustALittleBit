<?php

$connexion = mysql_connect('localhost','justalittlebit','tardis');
if (!$connexion) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('justalittlebit') ) {
    die ('Can\'t use justalittlebit : ' . mysql_error());
}
?>
