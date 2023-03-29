<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/UserDAO.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
  $dotenv->safeLoad();
 

$router = new Router(new Request);

$router->get('/user', function() {
  

  $userDAO = new UserDAO();

  $response = $userDAO->selectAll();

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/user/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $userDAO = new UserDAO();

  $response = $userDAO->selectUser($idMatch[0]);
  
  $response['body']['user_profile'] = base64_decode($response['body']['user_profile']);
  http_response_code($response['status']);
  return json_encode($response);
});

$router->post('/user', function($request) {

  $body = $request->getBody();
  $userDAO = new UserDAO();
  $response  = [];

  if($body['option'] === 'I'){
    list($type, $data) = explode(';', $body['userProfile']);
    preg_match("/\/(.*?);/", $body['userProfile'], $matches);
    $profileImage = base64_encode($data);

    $user = new User(0, $body['userName'], $body['userLastnameP'], $body['userLastnameM'], $body['userAccountType'], $body['userEmail'], $body['userPassword'], $body['userNickname'], '', $body['userGender'], $body['userBirthdate'], $profileImage, $matches[1]);

    
    $response  = $userDAO->insertUser($user);
  }
  else{
    $user = new User(0, null, null, null, null, $body['userEmail'], $body['userPassword'], null, null, null, null, null, null);
    $response = $userDAO->selectAuthUser($user->getEmail());

    if($response['body'] != false){
      $credentials = $response['body'];
      if($credentials['user_email'] != $user->getEmail() || $credentials['user_password'] != $user->getPassword()){
        $response['body'] = false;
      }
    }
  }

  http_response_code($response['status']);
  return json_encode($response);
});

$router->put('/user', function($request) {
  $body = $request->getBody();

  
  return json_encode('');
});

$router->patch('/user/', function($request) {

  http_response_code(200);
  return json_encode('Hola, amigo, estas llamando el metodo patch');
});

$router->delete('/user/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  return json_encode('');

  http_response_code(200);
  return json_encode($idMatch[0]);
});

$router->delete('/user', function($request) {
  return json_encode('');
});

$router->options('/user/?', function($request) {
  http_response_code(200);
});

$router->options('/user', function($request) {
  http_response_code(200);
});