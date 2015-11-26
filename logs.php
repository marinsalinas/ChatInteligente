

<?php
include 'conn.php';


$result1= mysql_query("SELECT * FROM logs ORDER by id  DESC ");

while($r = mysql_fetch_array($result1)){

    $ini = substr($r['username'],0,1);


    echo '<br><li class="left clearfix"><span class="chat-img pull-left">
                            <img src='.$r['image'].' alt="User Avatar" class="img-circle" />
                        </span>
    <div class="chat-body clearfix">
        <div class="header">
            <strong class="primary-font"> '.$r['username'].'</strong> <small class="pull-right text-muted">
              </small>
        </div>';
    echo "<p>". $r['msg']."</p>";

    echo " </div>
</li>";
}


/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 24/05/15
 * Time: 23:39
 */ 