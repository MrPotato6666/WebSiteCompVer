<?php
/*
 * name:        PDO Login
 * author:      Jay Blanchard
 * date:        April 2015
 */

include 'pdo_connect.php';

if(!empty($_POST)) {
    $query = "SELECT `password` FROM `users` WHERE `uname` = ?";
    $params = array($_POST['uname']);
    $results = dataQuery($query, $params);
}

$hash = $results[0]['password']; // first and only row if username exists;

echo if($_POST['upassword'] == $hash) ? 'You are logged in.' : 'We are unable to log you in.';

?>



