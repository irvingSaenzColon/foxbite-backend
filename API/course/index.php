<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/CourseDAO.php');

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
  return json_encode( $idMatch[1] );
});

$router->get('/course/user/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  http_response_code(200);
  return json_encode( $idMatch[1] );
});

$router->post('/course', function($request) {

  $body = $request->getBody();
  $courseDAO = new CourseDAO();
  $body['status'] = $body['status'] === 'active' ? true : false;
  list($type, $data) = explode(';', $body['cover']);
  preg_match("/\/(.*?);/", $body['cover'], $matches);
  $coverImage = base64_encode($data);

  $course = new Course(0, $body['title'], $body['description'], $body['price'], 0, $coverImage, $matches[1], $body['status'], null, null, $body['createdBy'] );
  $response = $courseDAO->insertCourse($course);

  http_response_code($response['status']);
  return json_encode($response);
});

$router->put('/course', function($request) {
  $body = $request->getBody();

  
  return json_encode('');
});

$router->patch('/course', function($request) {

  http_response_code(200);
  return json_encode('Hola, amigo, estas llamando el metodo patch');
});

$router->delete('/course/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  return json_encode('');

  http_response_code(200);
  return json_encode($idMatch[0]);
});

$router->delete('/course', function($request) {
  return json_encode('');
});

$router->options('/course/?', function($request) {
  http_response_code(200);
});

$router->options('/course', function($request) {
  http_response_code(200);
});