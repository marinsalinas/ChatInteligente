<?php

include 'con.php';


$uname = $_REQUEST['uname'];
$msg = $_REQUEST['msg'];


function bad_wordcensor($txt)
{
    $separacion = preg_split("/[\s,]+/", $txt);

    foreach ($separacion as $sp) {

        $sql = mysql_query("SELECT bad_word FROM bad_words WHERE SOUNDEX (bad_word) = SOUNDEX('$sp')");

        if (mysql_num_rows($sql) > 0) {
            $repeat = mysql_query("SELECT * FROM  `bad_words` WHERE SOUNDEX (bad_word) = SOUNDEX('$sp')");

            if (!mysql_num_rows($repeat)) {

                mysql_query("INSERT INTO `google+`.`bad_words` (`id`, `bad_word`, `replacement`, `repeat`)
        VALUES (NULL, '$sp','[censurado]', '0');") or die (mysql_error());
            }
        }

    }


    $q = mysql_query("SELECT  `id` ,  `bad_word` ,  `replacement` ,  `repeat` FROM bad_words") or die (mysql_error());

    while ($row_bad = mysql_fetch_array($q)) {
        $pos = strpos($txt, $row_bad['bad_word']);

        if ($pos === false) {
            echo false;

        } else {

            $count = substr_count($txt, $row_bad['bad_word']) + $row_bad['repeat'];


            mysql_query("UPDATE  `google+`.`bad_words` SET  `repeat` =  '$count' WHERE  `bad_words`.`id` =" . $row_bad['id'] . ";") or die (mysql_error());
        }

        $txt = str_ireplace($row_bad['bad_word'], "[censurado]", $txt);

    }

    return $txt;

}

mysql_query("INSERT INTO logs(`username`,`msg`) VALUES ('$uname','" . bad_wordcensor($msg) . "')");

$result1 = mysql_query("SELECT * FROM logs ORDER by id DESC");


while ($r = mysql_fetch_array($result1)) {


    echo $r['username'] . ": " . $r['msg'] . "<br>";

}




/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 24/05/15
 * Time: 23:11
 */ 