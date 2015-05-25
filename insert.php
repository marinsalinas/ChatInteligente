<?php



$uname = $_REQUEST['uname'];
$msg = $_REQUEST['msg'];

include 'con.php';



mysql_query("INSERT INTO logs(`username`,`msg`) VALUES ('$uname','$msg')");


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