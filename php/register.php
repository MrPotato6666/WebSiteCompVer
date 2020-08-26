<?php
/*
 * name:        PDO Register
 * author:      Jay Blanchard
 * date:        April 2015
 */


include 'pdo_connect.php';

if(!empty($_POST)) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $upassword = $_POST['upassword'];

    $query = 'INSERT INTO `users` (`fname`, `lname`, `uname`, `password`) VALUES (?,?,?,?)';
    $params = array($fname, $lname, $uname, $upassword);
    $results = dataQuery($query, $params);

    // for testing only
    echo 1 == $results ? 'Thanks for registering, ' . $fname : 'There has been a problem processing your request, please try again later.';
}

?>
