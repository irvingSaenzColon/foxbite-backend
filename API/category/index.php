<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, PATCH, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../model/Course.php');
include_once('../../dao/CategoryDAO.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
  $dotenv->safeLoad();
 

$router = new Router(new Request);

$router->get('/category', function() {
    $cateoryDAO = new CategoryDAO();
    $response = $cateoryDAO->selectAll();

    $curenCategoryData = [];

    foreach($response['body'] as $categoryData){
      $categoryData['category_cover'] = base64_decode($categoryData['category_cover']);
      array_push($curenCategoryData, $categoryData);
    }

    $response['body'] = $curenCategoryData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/category/?', function($request) {
  $idPattern = '/[0-9]+$/';
  preg_match($idPattern, $request->requestUri, $idMatch);

  $cateoryDAO = new CategoryDAO();
  $category = new Category(intval($idMatch[0]), null, null, null, null, null);

  $response = $cateoryDAO->selectCategory($category->getId());

  $response['body']['category_cover'] = base64_decode($response['body']['category_cover']);

  http_response_code($response['status']);
  return json_encode( $response );
});

$router->get('/category/user/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  http_response_code(200);
  return json_encode( $idMatch[1] );
});

$router->get('/category/course/?', function($request) {
    $idPattern = '/[0-9]+$/';
  
    preg_match($idPattern, $request->requestUri, $idMatch);

    $course = new Course($idMatch[0], null, null, null, null, null, null, null, null, null, null);

    $categoryDAO = new CategoryDAO();
    $response = $categoryDAO->selectCategoriesFromCourse($course);

  
    http_response_code($response['status']);
    return json_encode($response);
});

$router->get('/category/info', function($request) {

  $categoryDAO = new CategoryDAO();
  $response = $categoryDAO->selectCategoriesInfo();

  $curenCategoryData = [];

  foreach($response['body'] as $categoryData){
    $categoryData['cover'] = base64_decode($categoryData['cover']);
    array_push($curenCategoryData, $categoryData);
  }

  $response['body'] = $curenCategoryData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->post('/category', function($request) {

  $body = $request->getBody();

  list($type, $data) = explode(';', $body['categoryCover']);
  preg_match("/\/(.*?);/", $body['categoryCover'], $matches);
  $coverImage = base64_encode($data);

  $cateoryDAO = new CategoryDAO();

  $category = new Category(0, $body['categoryTitle'], $body['categoryDescription'], $coverImage, $matches[1], $body['categoryCreatedBy']);
  $cateoryDAO->insertCategory($category);

  $response = $cateoryDAO->selectLastCategoryCreatedBy($category->getCreatedBy());

  $response['body']['category_cover'] = base64_decode($response['body']['category_cover']);
  
  http_response_code($response['status']);
  return json_encode($response);
});

$router->put('/category', function($request) {
  $body = $request->getBody();

  
  return json_encode('');
});

$router->patch('/category', function($request) {
  $body = $request->getBody();
  list($type, $data) = explode(';', $body['categoryCover']);
  preg_match("/\/(.*?);/", $body['categoryCover'], $matches);
  $coverImage = base64_encode($data);

  $categoryDAO = new CategoryDAO();

  $category = new Category($body['categoryId'], $body['categoryTitle'], $body['categoryDescription'], $coverImage, $matches[1], $body['categoryCreatedBy']);

  $categoryDAO->updateCategory($category, $body['option']);

  $response = $categoryDAO->selectCategory($category->getId());

  $response['body']['category_cover'] = base64_decode($response['body']['category_cover']);

  http_response_code(200);
  return json_encode($response);
});

$router->delete('/category/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $categoryDAO = new CategoryDAO();
  $category = new Category($idMatch[0], null, null, null, null, null);
  
  $categoryDAO->deleteCategory($category);

  http_response_code(200);
  return json_encode($idMatch[0]);
});

$router->delete('/category', function($request) {
  return json_encode('eliminando jeje');
});

$router->options('/category/?', function($request) {
  http_response_code(200);
});

$router->options('/category', function($request) {
  http_response_code(200);
});