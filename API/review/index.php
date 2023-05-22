<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../model/Review.php');
include_once('../../dao/ReviewDAO.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->safeLoad();

$router = new Router(new Request);

$router->get('/review/?', function($request) {

    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);
    $review = new Review($idMatch[0], null, null, null, null);

    $reviewDao = new ReviewDAO();
    $reviewDao->select($review);

    return json_encode('Hola, estoy obteniendo una reseña especifica');
//   http_response_code($response['status']);
//   return json_encode($response);
});

$router->get('/review', function($request) {

    return json_encode('Hola, estoy obteniendo todas las reseñas');
//   http_response_code($response['status']);
//   return json_encode($response);
});

$router->get('/review/course/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);
    $review = new Review(null, null, null,$idMatch[0], null);

    $reviewDao = new ReviewDAO();
    $response = $reviewDao->selectAll($review);

    $reviewData = [];

    foreach($response['body'] as $reviewElement){
        $reviewElement['image'] = base64_decode($reviewElement['image']);
        array_push($reviewData, $reviewElement);
    }

  $response['body'] = $reviewData;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/review/user', function($request) {
    $body = $request->getBody();

    $review = new Review($body['id'], $body['comment'], $body['score'], $body['belongs'], $body['by']);

    $reviewDao = new ReviewDAO();
    $response = $reviewDao->selectUserReview($review);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/review', function($request) {
    $body = $request->getBody();

    $review = new Review($body['id'], $body['comment'], $body['score'], $body['belongs'], $body['by']);

    $reviewDao = new ReviewDAO();
    $response = $reviewDao->insert($review);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->put('/review', function($request) {
    $body = $request->getBody();
    return json_encode('Hola, estoy obteniendo subiendo una reseña');
//   http_response_code($response['status']);
//   return json_encode($response);
});


$router->delete('/review', function($request) {
    $body = $request->getBody();
    return json_encode('Hola, estoy obteniendo subiendo una reseña');
//   http_response_code($response['status']);
//   return json_encode($response);
});