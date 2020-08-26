<?php
/*
 * name:        PDO Connect & Query
 * author:      Jay Blanchard
 * date:        April 2015
 */


error_reporting(E_ALL);
ini_set('display_errors', 1);

define('USER', 'root');
define('PASS', '');
define('query', "SELECT * FROM `testtable`");
//echo '<pre>'; print_r($results); echo '</pre>';

function dataQuery($query) {
    // establish database connection
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=testingdb', USER, PASS);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo $e->getMessage();
        $errorCode = $e->getCode();
    }

    // run query
    try {
        $queryResults = $dbh->prepare($query);
        $queryResults->execute();
        if($queryResults != null) {
            $results = $queryResults->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
        $queryResults = null; // first of the two steps to properly close
        $dbh = null; // second step tp close the connection
    }
    catch(PDOException $e) {
        $errorMsg = $e->getMessage();
        echo $errorMsg;
    }
}

function html_table($data = array())
{
    $rows = array();
    foreach ($data as $row) {
        $cells = array();
        foreach ($row as $cell) {
            $cells[] = "<td>{$cell}</td>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";
    }
    $table = "<tr><th>Barcode</th><th>Product</th><th>Product Description</th><th>Quality</th><th>Price</th></tr>".implode('', $rows);
    return $table;
}

?>
