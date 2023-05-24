<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/CartDAO.php');
include_once('../../model/Cart.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->safeLoad();

$router = new Router(new Request);

$router->get('/cart', function($request) {
    return json_encode(array("body"=>"Hola, amigo"));
});

$router->get('/cart/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $cart = new Cart(intval($idMatch[0]), null, null, null, null, null, null);
    
    $cartDAO = new CartDAO();
    $response = $cartDAO->selectAll($cart);

    $cartData = [];

    foreach($response['body'] as $cartItem){
      $cartItem['cart_cover'] = base64_decode($cartItem['cart_cover']);
      array_push($cartData, $cartItem);
    }
  
    $response['body'] = $cartData;

    http_response_code($response['status']);
    return json_encode($response);
});


$router->post('/cart', function($request) {
    $body = $request->getBody();

    $cart = new Cart($body['id'], $body['detailId'], $body['owner'], $body['courseId'], $body['chapterId'], $body['total'], $body['detailCost']);
    
    $cartDAO = new CartDAO();
    $response = $cartDAO->insertDetail($cart);

    if($response['body']['result'] === '0')
        $response['body'] = false;
    else
        $response['body'] = true;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/cart/header', function($request) {
    $body = $request->getBody();

    $cart = new Cart($body['id'], null, null, null, null, null, null);
    
    $cartDAO = new CartDAO();
    $response = $cartDAO->selectCartHeaderBuy($cart);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->delete('/cart/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch); 

    $cart = new Cart(null, $idMatch[0], null, null, null, null, null);
    
    $cartDAO = new CartDAO();
    $response = $cartDAO->deleteDetail($cart);

    

    http_response_code($response['status']);
    return json_encode($response);
});

$router->options('/cart/?', function($request) {
    http_response_code(200);
});
  
$router->options('/cart', function($request) {
    http_response_code(200);
});