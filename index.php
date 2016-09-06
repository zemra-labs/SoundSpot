<?php
require_once 'PDO_Class.php';

//var_dump($db);
// die();

$results = $db->query('select * from film');
echo '<pre>';
$films = $results->fetchAll(PDO::FETCH_ASSOC);
echo '</pre>';

foreach ($films as $film) {
  echo '<li>' . $film['title'] . '</li>';
}

?>
