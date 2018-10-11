<!DOCTYPE html>
<html>
<head><title>Organization Demo</title></head>
<body>
<?php
include_once('organization.php');
$orgs_array = Organization::fetchAll();
?>
<h1>Organizations</h1>
<table>
  <tr>
    <th>Org Name</th>
    <th>Org Type</th>
    <th>Founding Year</th>
    <th>Size</th>
    <th>Sectors</th>
    <th>Description</th>
    <th>City</th>
    <th>State/Region</th>
    <th>Country</th>
    <th>Region</th>
    <th>Country Income Level</th>
  </tr>
<?php
foreach ($orgs_array as $o) {
  echo <<<BANANA
<tr>
  <td>$o->organization_name</td>
  <td>$o->organization_type</td>
  <td>$o->founding_year</td>
  <td>$o->size</td>
  <td>$o->sectors</td>
  <td>$o->description</td>
  <td>$o->city</td>
  <td>$o->state_or_region</td>
  <td>$o->country</td>
  <td>$o->region</td>
  <td>$o->country_income_level</td>
</tr>
BANANA;
}
 ?>
</table>
</body>
</html>
