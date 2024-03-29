<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Content-type: application/json');

error_reporting(E_ALL);
ini_set("display_errors", 1);

require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Custom 404 Handler
$router->set404( function() {
	header('HTTP/1.1 404 Not Found');
	echo '404, route not found!';
});

// Static route: / (homepage)
$router->get('/', function() {
	echo '<h1>bramus/router</h1><p>Try these routes:<p><ul><li>/hello/<em>name</em></li><li>/blog</li><li>/blog/<em>year</em></li><li>/blog/<em>year</em>/<em>month</em></li><li>/blog/<em>year</em>/<em>month</em>/<em>day</em></li></ul>';
});

// Dynamic route: /hello/name
$router->get('/hello/(\w+)', function($name) {
	// echo 'Hello ' . htmlentities($name);
	// header("Content-Type: image/jpeg");
	$path = __DIR__ . '/uploads' . '/_DSC2798.jpg';
	
	$data = base64_encode(file_get_contents($path));
	// Format the image SRC:  data:{mime};base64,{data};
	$src = 'data: '.mime_content_type($path).';base64,'.$data;

	echo $src;
	// Echo out a sample image
	// echo '<img src="' . $src . '">';
});

$router->get('/public/uploads/(\w+)', function($pictureName) {
	// header("Content-Type: image/jpeg,image/png");
	$path = __DIR__ . '/uploads' . '/' . $pictureName;
	$data = base64_encode(file_get_contents($path));
	// Format the image SRC:  data:{mime};base64,{data};
	$src = 'data: '.mime_content_type($path).';base64,'.$data;

	echo $src;
});

$router->setNamespace('Controllers');

// $router->get('/', header('www.google.com'));
// routes for the articles endpoint
$router->get('/test', 'ProductController@getTest');
$router->get('/products(/\d+)?(/\d+)?', 'ProductController@getAll');
$router->get('/products/get/(\d+)', 'ProductController@getOne');
$router->post('/products/create', 'ProductController@post');
$router->put('/products/update/(\d+)', 'ProductController@update');
$router->delete('/products/delete/(\d+)', 'ProductController@delete');
$router->delete('/products/delete/(\d+)', 'ProductController@delete');

$router->post('/products/picture', 'ProductController@uploadImg');
$router->post('/products/picture/get', 'ProductController@readFile');

$router->get('/category/(\d+)', 'CategoryController@getOne');
$router->get('/category/all(/\d+)?(/\d+)?', 'CategoryController@getAll');

$router->get('/users/test', 'UserController@getTest'); 
$router->get('/users/(\d+)', 'UserController@getOne'); 
$router->post('/users/login', 'UserController@login');

$router->post('/users/create/(\d+)', 'UserController@insert');
$router->delete('/users/(\d+)', 'UserController@delete');

$router->get('/articles/all(/\d+)?(/\d+)?', 'ArticleController@getAll');
$router->get('/articles/get', 'ArticleController@get');
$router->post('/articles/create', 'ArticleController@insert');
$router->get('/articles/(\d+)/get', 'ArticleController@getOne');
$router->put('/articles/(\d+)/update', 'ArticleController@update');
$router->delete('/articles/(\d+)/delete', 'ArticleController@delete');

// Run it!
$router->run();
?>