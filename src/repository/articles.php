<?php 
declare(strict_types=1);
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
require_once(__DIR__ . '/../../vendor/autoload.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Content-type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$url = parse_url($_SERVER['REQUEST_URI']);

$servername = "localhost";
$username = "developer";
$password = "secret123";
$dbname = "vuedb"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if($method == 'GET' && !isset($url['query'])) 
{
  $sql = "select * from articles";
}
if($method == 'GET' && isset($url['query']))
{
  $id = $_GET['id'];
  $sql = "select * from articles".($id?" where id=$id":''); 
}
if($method == 'DELETE' && isset($url['query']))
{
  if(ValidateUser()){
    if(isset($_GET['id'])){
      $id = $_GET['id'];
      $sql = "delete from articles where id=".($id); 
    } else {
      http_response_code(400); 
      die("No id for aticle given!"); 
    }
  }
}

if($method == 'POST')
{
  if(ValidateUser()) {

    if(empty($_POST["title"])) {      
      http_response_code(400); 
      die("No empty fields allowed!"); 
    }
    if(empty($_POST["writer"])) { 
      http_response_code(400);
      die("No empty fields allowed!"); 
    }
    if(empty($_POST["innerText"])) { 
      http_response_code(400);
      die("No empty fields allowed!"); 
    }
    if(empty($_POST["fullText"])) { 
      http_response_code(400);
      die("No empty fields allowed!"); 
    }

    $title = $_POST["title"];
    $writer = $_POST["writer"];
    $innerText = $_POST["innerText"];
    $fullText = $_POST["fullText"];
    
    $sql = "insert into articles (title, date, writer, innerText) values ('$title', now(), '$writer', '$innerText')";
  }
}

// run SQL statement
$result = mysqli_query($conn, $sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
}

if ($method == 'GET' && isset($url['query'])) {
    for ($i=0 ; $i < mysqli_num_rows($result); $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
   } 
  elseif ($method == 'GET' && !isset($url['query']))
  {      
    echo '{ "articles": ';
    echo '[';
    for ($i=0 ; $i < mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    echo ']';
    echo ' }';
  }
  elseif ($method == 'DELETE')
  {
    echo 'Deletion complete';
    return;
  }
  elseif ($method == 'PUT')
  {
    echo json_encode($result);
  }
  elseif ($method == 'POST') {
    echo json_encode($result);
  } else {
    echo mysqli_affected_rows($conn);
  }

$conn->close();


function ValidateUser()
{
  if (!array_key_exists('HTTP_AUTHORIZATION', $_SERVER)) {
    header('WWW-Authenticate: "localhost:8080/"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Not allowed';
    exit;
 }

  // read from header JWT
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
    $arr = explode(" ", $authHeader);
    if(isset($arr[1]))
        $jwt = $arr[1];
    
    if(empty($jwt)) { 
      header('HTTP/1.0 401 Unauthorized'); 
      echo "Only authorized people can do this. Please login.";
      exit;
    }
    
  if($jwt) {
    try {
      $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
      $decoded = JWT::decode($jwt, new Key($secretKey, 'HS512'));
      // username is now found
      // echo $decoded->data->username;
    }
    catch(\Firebase\JWT\ExpiredException $e)
    {
      header('WWW-Authenticate: "localhost:8080/"');
      header('HTTP/1.0 401 Unauthorized');
      echo 'Token expired. Please login again.';
      exit;
    } 
    catch (Exception $e)
    {
      header('WWW-Authenticate: "localhost:8080/"');
      header('HTTP/1.0 401 Unauthorized');
      echo 'Not allowed';
      exit;
    }
  }
  
  return true;
}

function console_log($data){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

?>