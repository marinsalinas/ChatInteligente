<?php
include 'con.php';


$result1= mysql_query("SELECT * FROM logs ORDER by id DESC");

while($r = mysql_fetch_array($result1)){


    echo $r['username']. ": ". $r['msg']."<br>";

}


/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 24/05/15
 * Time: 23:39
 */ 