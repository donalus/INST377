<?php
/**
 * Class Organization: Used to logically bundle all operations related to
 * organization data.
 * Implements JsonSerializable so that we can define how we want the object
 * to be serialized when json_encode is called. JsonSerializable requires that
 * we define the method jsonSerialize.
 */
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

  // used to translate our property names to the key names in the JSON file
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
    'Type of Data Used' => '
    ');

  private $to_map = array();

  /* constructor defines how an object is created. if we get an array
   * containing the properties of an organization, then we assign those
   * values to the appropriate properties
   */
  function __construct(array $org_array) {
    // flipping the from_map values
    foreach($this->from_map as $key => $val) {
      $this->to_map[$val] = $key;
    }

    // assigning property values
    foreach ($org_array as $key => $value) {
      if (property_exists($this, $key)) {
        $this->$key = $value;
      }
    }
  }

  /* called by json_encode to allow us to control how our object is converted
   * into a json string. we are using it here to convert our internal property
   * names into the human readable key names used in the JSON file.
   */
  public function jsonSerialize() {
    $json_assoc = array();
    foreach($this->from_map as $key => $val) {
      $json_assoc[$key] =  $this->$val;
    }
    return $json_assoc;
  }

  /* get an organization by id. static because we want to create a new
   * instance with the data in the database and it doesn't make sense
   * to create an empty object and then load the data into it...
   */
  static function fetchOne(mysqli $conn, $profile_id) {
    $stmt = $conn->prepare("SELECT * FROM organizations WHERE profile_id = ?");
    $stmt->bind_param("i", $profile_id);
    $stmt->execute();
    if ($result = $stmt->get_result() && $result->num_rows == 0) {
      $org = $result->fetch_assoc();
      return new Organization($org);
    } else {
      return false;
    }
  }

  /* get all organizations from db (redundant with fetchMany now)
   * static because it doesn't make sense to create an instance of the class
   * in order to return many objects
   */
  static function fetchAll(mysqli $conn) {
    $orgs = array();
    $sql = 'SELECT * FROM organizations';
    if ($result = $conn->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        // create a new object from our row data
        $org_obj = new Organization($row);
        // append the created org to the $orgs array
        $orgs[] = $org_obj;
      }
    }
    return $orgs;
  }

  /* get multiple organizations
   * offset is where to start
   * limit is the number of results to return
   * default parameters get all records
   */
  static function fetchMany(mysqli $conn, $offset = 0, $limit = -1) {
    $stmt = $conn->prepare("SELECT * FROM organizations LIMIT ?, ?");
    $stmt->bind_param("ii", $offset,  $limit);
    $stmt->execute();
    if ($result = $stmt->get_result()) {
      $orgs = array();
      while ($row = $result->fetch_assoc()) {
        // create a new object from our row data
        $org_obj = new Organization($row);
        // append the created org to the $orgs array
        $orgs[] = $org_obj;
      }
      return $orgs;
    }
  }

  // get the total number of organizations
  static function fetchTotalCount(mysqli $conn) {
    $sql = 'SELECT COUNT(*) FROM organizations';
    // this query should always return something, but if there is a server issue...
    if ($result = $conn->query($sql)) {
      // fetch_array with a numerically indexed array is actually handy here...
      $row = $result->fetch_array(MYSQLI_NUM);
      return $row[0];
    } else {
      return 0;
    }
  }

  // TODO #1: Implement a function to save an new organization
  // return number of rows inserted

  // TODO #2: Implement a function to delete an organization.
  // return number of rows deleted

  // TODO #3: Implement a function to save changes to an existing organization
  // return number of rows updated
}
 ?>
