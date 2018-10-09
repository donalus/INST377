<?php
include_once('organization.php');
$orgs = Organization::fetchAll();
echo json_encode($orgs);
?>
