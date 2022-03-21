<?php 
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
// $request = explode('/', trim($_SERVER['PATH_INFO'],'/contacts'));
$url = parse_url($_SERVER['REQUEST_URI']);

$servername = "localhost";
$username = "developer";
$password = "secret123";
$dbname = "vuedb"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//$input = json_decode(file_get_contents('php://input'),true);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($method == 'GET' && !isset($url['query'])) 
{
  $sql = "select * from contacts";
}
if($method == 'GET' && isset($url['query']))
{
  $id = $_GET['id'];
  $sql = "select * from contacts".($id?" where id=$id":''); 
}
if($method == 'POST')
{
  $name = $_POST["name"];
  $email = $_POST["email"];
  $country = $_POST["country"];
  $city = $_POST["city"];
  $job = $_POST["job"];
  $sql = "insert into contacts (name, email, city, country, job) values ('$name', '$email', '$city', '$country', '$job')";
}


// run SQL statement
$result = mysqli_query($conn, $sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
}

if ($method == 'GET' && isset($url['query'])) {
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
   } 
  elseif ($method == 'GET' && !isset($url['query']))
  {      
    echo '{ "contacts": ';
    echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    echo ']';
    echo ' }';
  }
  elseif ($method == 'POST') {
    echo json_encode($result);
  } else {
    echo mysqli_affected_rows($conn);
  }

$conn->close();

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

?>