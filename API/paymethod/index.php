<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/PaymethodDAO.php');
include_once('../../model/Paymethod.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->safeLoad();

$router = new Router(new Request);

$router->get('/paymethod', function($request) {
    return json_encode("Hola, amigo");
});

$router->get('/paymethod/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $paymethod = new Paymethod($idMatch[0], null, null, null, null, null, null, null);
    
    $paymethodDAO = new PaymethodDAO();
    $response = $paymethodDAO->selectPaymethod($paymethod);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->get('/paymethod/user/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $paymethod = new Paymethod(null, null, null, null, null, null, null, $idMatch[0]);
    
    $paymethodDAO = new PaymethodDAO();
    $response = $paymethodDAO->selectAll($paymethod);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/paymethod', function($request) {
    $body = $request->getBody();

    $paymethod = new Paymethod($body['id'], $body['number'], $body['expires'], $body['zipcode'], $body['type'], $body['owner'], $body['bank'], $body['belongs']);
    
    $paymethodDAO = new PaymethodDAO();
    $response = $paymethodDAO->insertPaymethod($paymethod);

    if($response['body']['result'] !== '0')
        $response = $paymethodDAO->selectLastPaymethod($paymethod);
    else
        $response['body'] = false;

    http_response_code($response['status']);
    return json_encode($response);
});


$router->patch('/paymethod', function($request) {
    $body = $request->getBody();
    $response = [];

    $paymethod = new Paymethod(intval($body['id']), $body['number'], $body['expires'], $body['zipcode'], $body['type'], $body['owner'], $body['bank'], intval($body['belongs']));
    
    $paymethodDAO = new PaymethodDAO();
    $response = $paymethodDAO->updatePaymethod($paymethod);

    if($response['body']['result'] !== '0')
        $response['body'] = true;
    else
        $response['body'] = false;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->delete('/paymethod/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $paymethod = new Paymethod($idMatch[0], null, null, null, null, null, null, null);
    
    $paymethodDAO = new PaymethodDAO();
    $response = $paymethodDAO->deletePaymethod($paymethod);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->options('/paymethod/?', function($request) {
    http_response_code(200);
});

$router->options('/paymethod', function($request) {
    http_response_code(200);
});