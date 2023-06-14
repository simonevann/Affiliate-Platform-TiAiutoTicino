<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

get('/admin', 'views/admin.php');
post('/admin', 'views/admin.php');

get('/admin/$page', 'views/admin.php');
post('/admin/$page', 'views/admin.php');

get('/admin/$page/$id', 'views/admin.php');
post('/admin/$page/$id', 'views/admin.php');

get('/api', 'views/api.php');

//getting all the info of the endpioint
get('/api/$endpoint', 'views/api.php');

//getting or posting info in a endpioint for a particular id
get('/api/$endpoint/$id', 'views/api.php');
post('/api/$endpoint/$id', 'views/api.php');

get('/api/$endpoint/$id/$attr1', 'views/api.php');
post('/api/$endpoint/$id/$attr1', 'views/api.php');

get('/', 'views/index.php');
get('/$id', 'views/index.php');


// Dynamic GET. Example with 1 variable
// The $id will be available in user.php
get('/user/$id', 'views/user');

// Dynamic GET. Example with 2 variables
// The $name will be available in full_name.php
// The $last_name will be available in full_name.php
// In the browser point to: localhost/user/X/Y
get('/user/$name/$last_name', 'views/full_name.php');

// Dynamic GET. Example with 2 variables with static
// In the URL -> http://localhost/product/shoes/color/blue
// The $type will be available in product.php
// The $color will be available in product.php
get('/product/$type/color/$color', 'product.php');

// A route with a callback
get('/callback', function(){
  echo 'Callback executed';
});

// A route with a callback passing a variable
// To run this route, in the browser type:
// http://localhost/user/A
get('/callback/$name', function($name){
  echo "Callback executed. The name is $name";
});

// A route with a callback passing 2 variables
// To run this route, in the browser type:
// http://localhost/callback/A/B
get('/callback/$name/$last_name', function($name, $last_name){
  echo "Callback executed. The full name is $name $last_name";
});

// ##################################################
// ##################################################
// ##################################################
// any can be used for GETs or POSTs

// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');
