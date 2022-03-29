<?php
declare(strict_types=1);

use Firebase\JWT\JWT;

require_once(__DIR__ . '/../../vendor/autoload.php');
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

$hasValidCredentials = false;
$secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';

$method = $_SERVER['REQUEST_METHOD'];
// $request = explode('/', trim($_SERVER['PATH_INFO'],'/login'));
$url = parse_url($_SERVER['REQUEST_URI']);

$servername = "localhost";
$usernameDB = "developer";
$password = "secret123";
$dbname = "vuedb"; 

$conn = new mysqli($servername, $usernameDB, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
if(empty($username)){ 
  http_response_code(400);
  die("No username set."); 
}

$pass = $_POST['pass'];
if(empty($pass)){ 
  http_response_code(400);
  die("No password set."); 
}

if($method == 'POST')
{
  $encryptedPass = sha1($pass);
  $sql = "select id, username, password from users where username=('$username') and password=('$encryptedPass')";
  $result = mysqli_query($conn, $sql);

  // die if SQL statement failed
  if (!$result) {
    http_response_code(404);
    die(mysqli_error($conn));
  }

  $rows = mysqli_num_rows($result);
  
  if($rows > 0)
  { 
    $hasValidCredentials = true;
  } else { 
    $hasValidCredentials = false;
    http_response_code(400);
    die("No user found."); 
  }
}
    // TODO test result with encryption

if ($hasValidCredentials) { 
  $issuedAt   = new DateTimeImmutable();
  $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
  $serverName = "your.domain.name";
  $username   = $_POST['username'];                                           // Retrieved from filtered POST data

  $data = [
      'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
      'iss'  => $serverName,                       // Issuer
      'nbf'  => $issuedAt->getTimestamp(),         // Not before
      'exp'  => $expire,                           // Expire
      'userName' => $username,                     // User name
  ];

  // Encode the array to a JWT string.
  echo JWT::encode(
    $data,
    $secretKey,
    'HS512'
  );

  $conn->close();
}


function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}

?>