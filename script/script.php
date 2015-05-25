<?php
include '../php/con.php';


function bad_wordcensor($txt)
{
    $q = mysql_query("SELECT  `id` ,  `bad_word` ,  `replacement` ,  `repeat` FROM bad_words") or die (mysql_error());

    while ($row_bad = mysql_fetch_array($q)) {
        $pos = strpos($txt, $row_bad['bad_word']);

        if ($pos === false) {
            echo false;

        } else {

            $count= substr_count($txt,$row_bad['bad_word']) + $row_bad['repeat'];



            mysql_query("UPDATE  `google+`.`bad_words` SET  `repeat` =  '$count' WHERE  `bad_words`.`id` =".$row_bad['id'].";") or die (mysql_error());
        }

        $txt = str_ireplace($row_bad['bad_word'], "[censurado]", $txt);

    }

    return $txt;

}

/*$cad= bad_wordcensor($_POST["comments"]);



$pos=strpos($cad,"[censurado");

if($pos===false){
    echo false;

}else{
    echo true;
}*/

echo "<br>".bad_wordcensor($_POST["comments"]);

/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 18/05/15
 * Time: 10:29
 */ 