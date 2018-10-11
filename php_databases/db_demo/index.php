<!DOCTYPE html>
<html>
<head><title>Organization Demo</title></head>
<body>
<?php
require_once('database.php');

$conn = new mysqli($hostname, $username, $password, $database);
if ($conn->connect_errno) {
  die('ERROR NO DATABSE');
}

include_once('organization.php');

$limit = 5;
$total_count = Organization::fetchTotalCount($conn);
$total_pages = ceil( $total_count / $limit);

$page = 1;
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $page = $_GET['page'];
  if ($page < 1) {
    $page = 1;
  }
  if ($page > $total_pages) {
    $page = $total_pages;
  }
}
$offset = (($page - 1) * $limit);
$orgs_array = Organization::fetchMany($conn, $offset, $limit);
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
  echo <<<HEREDOC
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
HEREDOC;
}
$conn->close();
$prev_page = 1;
if ($page > 1) {
  $prev_page = $page - 1;
}
$next_page = $page + 1;
if ($next_page > $total_pages) {
  $next_page = $total_pages;
}
echo <<<HEREDOC
<tr>
  <td colspan="5"><a href="index.php?page=$prev_page">Previous</a></td>
  <td></td>
  <td colspan="5"><a href="index.php?page=$next_page">Next</a></td>
</tr>
HEREDOC;
 ?>
</table>
</body>
</html>
