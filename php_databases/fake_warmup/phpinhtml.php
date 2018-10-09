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
?>
<tr>
  <td><?php echo $o->organization_name?></td>
  <td><?php echo $o->organization_type?></td>
  <td><?php echo $o->founding_year?></td>
  <td><?php echo $o->size?></td>
  <td><?php echo $o->sectors?></td>
  <td><?php echo $o->description?></td>
  <td><?php echo $o->city?></td>
  <td><?php echo $o->state_or_region?></td>
  <td><?php echo $o->country?></td>
  <td><?php echo $o->region?></td>
  <td><?php echo $o->country_income_level?></td>
</tr>
<?php
}
 ?>
</table>
</body>
</html>
