<?php
require_once('database.php');

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_errno) {
  die('ERROR NO DATABSE');
}

include_once('organization.php');
$orgs = Organization::fetchAll($conn);
echo json_encode($orgs);

$conn->close();
?>
