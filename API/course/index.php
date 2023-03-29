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

$router->get('/course', function() {
  
  http_response_code(200);
  return json_encode('Haciendo get de cursos');
});

$router->get('/course/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  http_response_code(200);
  return json_encode('obteniendo un curso');
});

$router->post('/user', function($request) {

  $body = $request->getBody();

  
  return json_encode('Haciendo post de esta fregadera');
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