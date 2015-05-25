<?php

include 'con.php';


$uname = $_REQUEST['uname'];
$msg = $_REQUEST['msg'];


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

mysql_query("INSERT INTO logs(`username`,`msg`) VALUES ('$uname','".bad_wordcensor($msg)."')");

$result1= mysql_query("SELECT * FROM logs ORDER by id DESC");


while($r = mysql_fetch_array($result1)){


    echo $r['username']. ": ". $r['msg']."<br>";

}




/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 24/05/15
 * Time: 23:11
 */ 