<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../model/CourseProgress.php');
include_once('../../dao/CourseProgressDAO.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
  $dotenv->safeLoad();

$router = new Router(new Request);

$router->get('/progress/?', function($request) {

    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $courseProgress = new CourseProgress(null, null, null, null, null, null, $idMatch[0]);

    $courseProgressDao = new CourseProgressDAO();

    return json_encode('Hola, estoy obteniendo el progreso del curso de un usuario');
//   http_response_code($response['status']);
//   return json_encode($response);
});


$router->post('/progress', function($request) {
    $body = $request->getBody();
    $courseProgress = new CourseProgress(null, 0, null, '', intval($body['courseId']), intval($body['chapterId']), intval($body['userId']));

    $courseProgressDAO = new CourseProgressDAO();
    $response = $courseProgressDAO->insert($courseProgress);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/progress/last', function($request) {
    $body = $request->getBody();
    $courseProgress = new CourseProgress(null, 0, null, '', intval($body['courseId']), intval($body['chapterId']), intval($body['userId']));

    $courseProgressDAO = new CourseProgressDAO();
    $response = $courseProgressDAO->selectLastChapterSeen($courseProgress);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->put('/progress', function($request) {
    $body = $request->getBody();
    $courseProgress = new CourseProgress(null, 1, null, "", intval($body['courseId']), intval($body['chapterId']), intval($body['userId']));

    $courseProgressDAO = new CourseProgressDAO();
    $response = $courseProgressDAO->updateDiplomaFinished($courseProgress);

    if($response['body']['result'] === '1')
        $response['body'] = true;
    else
        $response['body'] = false;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/progress/user', function($request) {
    $body = $request->getBody();

    $courseProgress = new CourseProgress(null, null, null, null, null, null, $body['userId']);
    
    $courseProgressDao = new CourseProgressDAO();
    $response = $courseProgressDao->selectUserProgress($courseProgress, $body['visible'], $body['category'], $body['dateInit'], $body['dateEnd'], $body['finished']);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->put('/progress/detail', function($request) {
    $body = $request->getBody();
    $courseProgress = new CourseProgress(null, 1, null, $body['time'], intval($body['courseId']), intval($body['chapterId']), intval($body['userId']));

    $courseProgressDAO = new CourseProgressDAO();
    $response = $courseProgressDAO->updateDetail($courseProgress);

    // if($response['body']['result'] === '1')
    //     $response['body'] = true;
    // else
    //     $response['body'] = false;

    http_response_code($response['status']);
    return json_encode($response);
});

$router->options('/progress/?', function($request) {
    http_response_code(200);
});
  
$router->options('/progress', function($request) {
http_response_code(200);
});

$router->options('/progress/detail', function($request) {
    http_response_code(200);
});