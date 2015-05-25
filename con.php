<?php

$con = mysql_connect('localhost','root','kirby94');
mysql_select_db('google+',$con);

/*

$pal = 'que onda mamamon chinga tu madre cabron ass';

$separacion = preg_split("/[\s,]+/",$pal);

print_r($separacion);


foreach($separacion as $sp){

    $sql = mysql_query("SELECT bad_word FROM bad_words WHERE SOUNDEX (bad_word) = SOUNDEX('$sp')");

    if(mysql_num_rows($sql)>0){
        echo true;

        echo $sp;
    }

}*/



