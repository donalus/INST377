<?php
class Organization implements JsonSerializable {
  public $profile_id;
  public $region;
  public $country;
  public $country_income_level;
  public $organization_name;
  public $organization_type;
  public $sectors;
  public $description;
  public $city;
  public $state_or_region;
  public $founding_year;
  public $size;
  public $type_of_data_used;

  private $from_map = array(
    'profileID' => 'profile_id',
    'Region' => 'region',
    'Country' => 'country',
    'Country Income Level' => 'country_income_level',
    'Organization Name' => 'organization_name',
    'Organization Type' => 'organization_type',
    'Sectors' => 'sectors',
    'Description' => 'description',
    'City' => 'city',
    'State/Region' => 'state_or_region',
    'Founding Year' => 'founding_year',
    'Size' => 'size',
    'Type of Data Used' => 'type_of_data_used');

  private $to_map = array();

  function __construct(array $org_array) {
    foreach($this->from_map as $key => $val) {
      $this->to_map[$val] = $key;
    }
    foreach ($org_array as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  public function jsonSerialize() {
    $json_assoc = array();
    foreach($this->from_map as $key => $val) {
      $json_assoc[$key] =  $this->$val;
    }
    return $json_assoc;
  }

  static function fetchOne() {
    include_once('data.php');
    $org = fakeDbQuery(0, 1);
    return new Organization($org);
  }

  static function fetchAll() {
    include_once('data.php');
    $orgs_data = fakeDbQuery();
    $orgs = array();
    foreach ($orgs_data as $o) {
      $org_obj = new Organization($o);

      $orgs[] = $org_obj;
    }
    return $orgs;
  }
}
 ?>
