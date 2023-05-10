<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/ChapterDAO.php');
include_once('../../model/Chapter.php');
include_once('../../model/FileHandler.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
$dotenv->safeLoad();
 
$router = new Router(new Request);


$router->get('/chapter/course/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $response = [];

    $chapter = new Chapter(null, $idMatch[0], null, null, null, null, null, null, null);
    $chapterDao = new ChapterDAO();

    $response = $chapterDao->selectAll($chapter);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->get('/chapter/?', function($request) { 
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $response = [];
  $chapter = new Chapter($idMatch[0], null, null, null, null, null, null, null, null);

  $chapterDao = new ChapterDAO();
  $response = $chapterDao->selectChapter($chapter);

  $chapter->setId($response['body']['id']);

  $videoData =  $chapterDao->selectVideoFromChapter($chapter);

  $response['body']['video'] = array("path" => $videoData['body']['video_path'], "id" => $videoData['body']['id'] );

  $resourcesData = $chapterDao->selectResourcesFromChapter($chapter);

  $response['body']['resource'] = $resourcesData['body'];

  http_response_code($response['status']);
  return json_encode($response);
});

$router->post('/chapter', function($request) {
    $response = [];
    $body = $_POST;
    $fileHandler = new FileHandler();
    $files = json_decode($_POST['documents'][0]);

    //$links = $body['links'];
    $videoData = $_FILES['video'];

    $chapter = new Chapter(null, $body['courseId'], $body['userId'], $body['title'], $body['description'], $body['cost'], array(
        "video_path" => "",
        "video_format" => ""
    ), null, null);

    $chapterDao = new ChapterDAO();
    $response = $chapterDao->insertChapter($chapter);

    $response = $chapterDao->selectLastChaperCreatedBy($chapter);

    $chapter->setId($response['body']['chapter_id']);

    $videoServerData = $fileHandler->storeVideoInServer($videoData);

    if($videoServerData !== null){
      $chapter->setVideoPath(array(
          "video_path" => "http://localhost:8080/files/videos/".$videoServerData['name'],
          "video_format" => $videoServerData['extension']
      ) );
        $response = $chapterDao->insertVideoChapter($chapter);
    }

    foreach ($files as $file) {
      $fileData = $fileHandler->storeFileInServer("./files/documents/", $file);
      $chapter->setDocumentsPath(array("path" => $fileData['serverPath'], "format" => $fileData['extension']));
      $response = $chapterDao->insertResourceChapter($chapter);
    }

    http_response_code($response['status']);
    return json_encode($response);

});

$router->delete('/chapter/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $response = [];
  http_response_code($response['status']);
  return json_encode($response);
});

$router->delete('/chapter', function($request) {
  return json_encode('');
});

$router->options('/chapter/?', function($request) {
  http_response_code(200);
});

$router->options('/chapter', function($request) {
  http_response_code(200);
});