<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/CourseDAO.php');
include_once('../../model/Category.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
  $dotenv->safeLoad();
 

$router = new Router(new Request);

$router->get('/course', function() {
  $courseDAO = new CourseDAO();

  $response = $courseDAO->selectAll();

  $currentCourseData = [];

  foreach($response['body'] as $courseData){
    $courseData['course_cover'] = base64_decode($courseData['course_cover']);
    array_push($currentCourseData, $courseData);
  }

  $response['body'] = $currentCourseData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/course/?', function($request) { 
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

 $courseDAO = new CourseDAO();

  $response = $courseDAO->selectCourse($idMatch[0]);

  $response['body']['course_cover'] = base64_decode($response['body']['course_cover']);

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/course/user/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $courseDAO = new CourseDAO();
  $course = new Course(-1, null, null, null, null, null, null, null, null, null, $idMatch[0]);

  $response = $courseDAO->selectCourseFromUser($course);

  $currentCourseData = [];

  foreach($response['body'] as $courseData){
    $courseData['course_cover'] = base64_decode($courseData['course_cover']);
    array_push($currentCourseData, $courseData);
  }

  $response['body'] = $currentCourseData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/course/latest', function($request) {

  $courseDAO = new CourseDAO();

  $response = $courseDAO->selectLatestCourses();

  $currentCourseData = [];

  foreach($response['body'] as $courseData){
    $courseData['cover'] = base64_decode($courseData['cover']);
    array_push($currentCourseData, $courseData);
  }

  $response['body'] = $currentCourseData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->get('/course/best', function($request) {

  $courseDAO = new CourseDAO();

  $response = $courseDAO->selectBestCourses();

  $currentCourseData = [];

  foreach($response['body'] as $courseData){
    $courseData['cover'] = base64_decode($courseData['cover']);
    array_push($currentCourseData, $courseData);
  }

  $response['body'] = $currentCourseData;

  http_response_code($response['status']);
  return json_encode($response);
});

$router->post('/course', function($request) {

  $body = $request->getBody();
  $categories = $body['categories'];
  $response = [];

  $body['status'] = $body['status'] === 'active' ? 1 : 0;
  list($type, $data) = explode(';', $body['cover']);
  preg_match("/\/(.*?);/", $body['cover'], $matches);
  $coverImage = base64_encode($data);

  $course = new Course(0, $body['title'], $body['description'], floatval($body['price']), 0, $coverImage, $matches[1], $body['status'], null, null, $body['createdBy'] );
  
  $courseDAO = new CourseDAO();

  $response = $courseDAO->selectCourseTitleByUser($course);
  if(!empty($response['body'])){
    $response['status'] = 400;
    http_response_code(400);
    return json_encode($response);
  }

  $courseDAO->insertCourse($course);

  $response = $courseDAO->selectLastCourseCreatedBy($course);
  $response['body']['course_cover'] = base64_decode($response['body']['course_cover']);

  $course->setId($response['body']['course_id']);

  foreach($categories as $category_id){
    $category = new Category($category_id, null, null, null, null, null);
    $courseDAO->bindCategoryWithCourse( 0 ,$course, $category, 'I');
  }

  http_response_code($response['status']);
  return json_encode($response);

});

$router->post('/course/advanced', function($request) {

  $body = $request->getBody();
  
  $courseDAO = new CourseDAO();
  $currentCourseData = [];

  $response = $courseDAO->selectCourseAdvanced($body['title'], $body['category'], $body['teacher'], $body['beginDate'], $body['endDate']);

  foreach($response['body'] as $courseData){
    $courseData['cover'] = base64_decode($courseData['cover']);
    array_push($currentCourseData, $courseData);
  }

  $response['body'] = $currentCourseData;

  http_response_code($response['status']);
  return json_encode($response);

});

$router->patch('/course', function($request) {

  $body = $request->getBody();
  $categories = $body['categories'];
  $categories_deleted = $body['categoriesDeleted'];

  $body['status'] = $body['status'] === 'active' ? 1 : 0;
  list($type, $data) = explode(';', $body['cover']);
  preg_match("/\/(.*?);/", $body['cover'], $matches);
  $coverImage = base64_encode($data);

  $course = new Course($body['id'], $body['title'], $body['description'], floatval($body['price']), 0, $coverImage, $matches[1], $body['status'], null, null, $body['createdBy'] );

  $courseDAO = new CourseDAO();

  $response = $courseDAO->selectCourseTitleByUser($course);
  if(!empty($response['body'])){
    if($response['body']['course_id'] !== $course->getId()){
      $response['status'] = 400;
      http_response_code(400);
      return json_encode($response);
    }
  }

  $courseDAO->updateCourse($course);

  foreach($categories_deleted as $category_id){
    $category = new Category($category_id, null, null, null, null, null);
    $courseDAO->bindCategoryWithCourse( 0 ,$course, $category, 'C');
  }

  foreach($categories as $category_id){
    $category = new Category($category_id, null, null, null, null, null);
    $courseDAO->bindCategoryWithCourse( 0 ,$course, $category, 'I');
  }

  $response = $courseDAO->selectCourse($course->getId());
  $response['body']['course_cover'] = base64_decode($response['body']['course_cover']);

  http_response_code($response['status']);
  return json_encode($response);
});

$router->delete('/course/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $course = new Course($idMatch[0], null, null, null, 0, null, null, null, null, null, null );

  $courseDAO = new CourseDAO();

  $realPath = '';
  $courseFiles = $courseDAO->selectCourseFiles($course)['body'];
  
  $realPath = '';
  if(!empty($courseFiles)){
    foreach($courseFiles as $chapterFile){
      $realPath= 'files/documents/'.$chapterFile['server_name'];
      if(file_exists($realPath))
        unlink($realPath);
    }
  }

  $courseVideos = $courseDAO->selectCourseVideos($course)['body'];
  $realPath = '';
  if(!empty($courseVideos)){
    foreach($courseVideos as $chapterVideo){
      $realPath = 'files/videos/'.$chapterVideo['server_name'];
      if(file_exists($realPath))
        unlink($realPath);
    }
  }

  $response = $courseDAO->deleteCourse($course);
  

  http_response_code($response['status']);
  return json_encode($response);
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