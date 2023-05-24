<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/BuyDAO.php');
include_once('../../model/Buy.php');
include_once('../../model/CourseProgress.php');
include_once('../../dao/CartDAO.php');
include_once('../../dao/CourseProgressDAO.php');
include_once('../../dao/ChapterDAO.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->safeLoad();

$router = new Router(new Request);

$router->get('/buy/?', function($request) {
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


$router->post('/buy', function($request) {
    $body = $request->getBody();
    $response = [];

    $courseProgressDAO = new CourseProgressDAO();

    $cart = new Cart($body['cartId'], null, null, null, null, null, null);

    $cartDAO = new CartDAO();
    $cartData = $cartDAO->selectCartHeaderBuy($cart);
    $cartData = $cartData['body'] ;

    $cartItems = $cartDAO->selectCartItemsBuy($cart);
    $cartItems = $cartItems['body'];

    $buy = new Buy($body['id'], $body['detailId'], $body['paymethodId'], $body['owner'], $body['courseId'], $body['chapterId'], floatval($cartData['cart_total']), $body['detailCost']);
    
    $buyDAO = new BuyDAO();
    $response = $buyDAO->insert($buy);

    $lastInsertedBuy = $buyDAO->selectLastInserted($buy);
    $lastInsertedBuy = $lastInsertedBuy['body'];

    $buy->setId( $lastInsertedBuy['buy_id'] );

    foreach ($cartItems as $cartItem) {
        $buyItem = new Buy($buy->getId(), null, null, null, $cartItem['cart_detail_course'], $cartItem['cart_detail_chapter'], null, floatval($cartItem['cart_detail_cost']));

        $courseProgress = new CourseProgress(null, 0, null, '', $cartItem['cart_detail_course'], $cartItem['cart_detail_chapter'], intval($body['owner']));

        $courseProgressDAO->insert($courseProgress);

        $buyDAO->insertDetail($buyItem);
    }

    $response = $cartDAO->clearDetail($cart);


    http_response_code($response['status']);
    return json_encode($response);
    
});

$router->post('/buy/verify', function($request) {
    $body = $request->getBody();
    $resonse = [];
    $option = $body['option'];

    $buy = new Buy(null, null, null, $body['owner'], $body['courseId'], null, null, null);
    
    $buyDAO = new BuyDAO();
    if($option === 'CV')
        $response = $buyDAO->selectVerifyBuy($buy);
    else 
        $response = $buyDAO->selectVerifyBuyChapters($buy);

    http_response_code($response['status']);
    return json_encode($response);
    
});

$router->post('/buy/general', function($request) {
    $body = $request->getBody();
    $response = [];
    $userId = intval($body['userId']);
    $category = $body['category'];
    $status = $body['status'];
    $initDate = $body['initDate'];
    $endDate = $body['endDate'];
    
    $buyDAO = new BuyDAO();
    $generalSells = $buyDAO->selectGeneralSells($userId, $category, $status, $initDate, $endDate);
    $totalRevenue = $buyDAO->selectTotalRevenue($userId, $initDate, $endDate);

    $response['body']['sells'] = $generalSells['body'];
    $response['body']['total'] = $totalRevenue['body']['total_revenue'];
    $response['status'] = 200;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/buy/specific', function($request) {
    $body = $request->getBody();
    $response = [];
    $courseId = intval($body['courseId']);
    $userId = intval($body['userId']);
    
    $buyDAO = new BuyDAO();
    $sells = $buyDAO->selectSpecificSells($courseId);
    $totalRevenue = $buyDAO->selectTotalRevenueCourse($userId ,$courseId);

    $response['body']['sells'] = $sells['body'];
    $response['body']['total'] = $totalRevenue['body']['total_revenue'];
    $response['status'] = 200;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->options('/cart/?', function($request) {
    http_response_code(200);
});

$router->options('/cart', function($request) {
    http_response_code(200);
});