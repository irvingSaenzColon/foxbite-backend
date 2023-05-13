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
include_once('../../dao/CommentDAO.php');
include_once('../../model/Chapter.php');
include_once('../../model/Comment.php');
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

  $linkData = $chapterDao->selectLinksFromChapter($chapter);

  $response['body']['links'] = $linkData['body'];

  http_response_code($response['status']);
  return json_encode($response);
});

$router->post('/chapter', function($request) {
    $response = [];
    $body = $_POST;
    $fileHandler = new FileHandler();
    $files = json_decode($body['documents'][0]);
    $links = json_decode($body['links'][0]);
    $videoData = isset($_FILES['video']) ? $_FILES['video'] : null;
    $option = $body['option'];

    $chapter = new Chapter(intval($body['chapterId']), $body['courseId'], $body['userId'], $body['title'], $body['description'], $body['cost'], array(
        "video_path" => "",
        "video_format" => ""
    ), null, null);

    $chapterDao = new ChapterDAO();
   if($option == 'I'){

    $chapterDao->insertChapter($chapter);

    $response = $chapterDao->selectLastChaperCreatedBy($chapter);

    $chapter->setId($response['body']['chapter_id']);

    $videoServerData = $fileHandler->storeVideoInServer($videoData);

    if($videoServerData !== null){
      $chapter->setVideoPath(array(
          "video_path" => "http://localhost:8080/files/videos/".$videoServerData['name'],
          "video_format" => $videoServerData['extension'],
          "vider_server_name" => $videoServerData['serverName']
      ) );
        $response = $chapterDao->insertVideoChapter($chapter);
    }

    foreach ($files as $file) {
      $fileData = $fileHandler->storeFileInServer("./files/documents/", $file->base64);
      $chapter->setDocumentsPath(
        array("path" => $fileData['serverPath'], 
        "format" => $fileData['extension'], 
        "name" => $file->name,
      "serverName" => $fileData['serverName']));

      $response = $chapterDao->insertResourceChapter($chapter);
    }

    foreach($links as $link){
      $chapter->setLinks(array(
        "id" => 0,
        "name" => $link->name,
        "content" => $link->link
      ));

      $chapterDao->insertLinkChapter($chapter);
    }

    $response = $chapterDao->selectLastChaperCreatedBy($chapter);
   }
   else{
    $chapterDao->updateChapter($chapter);
    $links_deleted = json_decode( $body['linksDeleted'][0] );
    $filesDeleted = json_decode( $body['documentsDeleted'][0] );

    // Dealing with update video
    if(!empty($videoData)){
      $videoInChapter = $chapterDao->selectVideoFromChapter($chapter)['body'];

      if(!empty($videoInChapter)){
        $realPath = 'files/videos/'.$videoInChapter['server_name'];
        unlink($realPath);
      }

      $videoServerData = $fileHandler->storeVideoInServer($videoData);
      
      $chapter->setVideoPath(array(
        "id" => $videoInChapter['id'],
        "video_path" => "http://localhost:8080/files/videos/".$videoServerData['name'],
        "video_format" => $videoServerData['extension'],
        "vider_server_name" => $videoServerData['serverName']
    ) );
      $response = $chapterDao->updateVideoFromChapter($chapter);
    }

    //Dealing with links, if somethig is stored right here it will be delete
    foreach($links_deleted as $link_deleted){
      $chapter->setLinks((array( "id" => $link_deleted->key )));
      $chapterDao->deleteChapterLink($chapter);
    }

    //if new links where setted in array then insert them, it deals with changes in each link even though it says insert
    foreach($links as $link){
      $chapter->setLinks(array(
        "id" => $link->key,
        "name" => $link->name,
        "content" => $link->link
      ));

      $chapterDao->insertLinkChapter($chapter);
    }

    // Dealing with files
    //First we delete files that are stored in this array, deleted from server and then deleted from db
    foreach($filesDeleted as $file_deleted){
      $realPath = 'files/documents/'.$file_deleted->serverName;
      unlink($realPath);
      $chapter->setDocumentsPath((array( "id" => $file_deleted->key )));
      $chapterDao->deleteChapterResource($chapter);
    }

    // Dealing with new files and files that are already there
    foreach($files as $file){
      $chapter->setDocumentsPath(array("id" => $file->key));
      $exists = $chapterDao->selectResourceFromChapter($chapter);
      
      if( empty($exists['body']) ){
        $fileData = $fileHandler->storeFileInServer("./files/documents/", $file->base64);
        $chapter->setDocumentsPath(
          array(
          "path" => $fileData['serverPath'],
          "format" => $fileData['extension'], 
          "name" => $file->name,
          "serverName" => $fileData['serverName']));

        $response = $chapterDao->insertResourceChapter($chapter);
      }
    }

    $response = $chapterDao->selectChapter($chapter);
   }

    http_response_code($response['status']);
    return json_encode($response);

});

$router->post('/chapter/comment', function($request) {
  $response = [];
  $body = $request->getBody();

  $commentDao = new CommentDAO();
  $comment = new Comment( 0, $body['id'], $body['userId'], $body['comment'], $body['type']);

  $response = $commentDao->insertComment($comment)['body'];

  if(!$response){
    $response = $commentDao->selectLastCommentByUser($comment);
    $response['body']['profile_picture'] = base64_decode($response['body']['profile_picture']);
  }

  http_response_code($response['status']);
  return json_encode($response);

});

$router->get('/chapter/comments/?', function($request) {
  $response = [];
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $commentDao = new CommentDAO();
  $comment = new Comment( 0, $idMatch[0], 0, "", "");

  $response = $commentDao->selectAll($comment);

  $currentCommentData = [];

  foreach($response['body'] as $commentData){
    $commentData['profile_picture'] = base64_decode($commentData['profile_picture']);
    array_push($currentCommentData, $commentData);
  }

  $response['body'] = $currentCommentData;

  http_response_code($response['status']);
  return json_encode($response);

});


$router->delete('/chapter/?', function($request) {
  $idPattern = '/[0-9]+$/';

  preg_match($idPattern, $request->requestUri, $idMatch);

  $response = [];
  $chapterDao = new ChapterDAO();
  $chapter = new Chapter($idMatch[0], null, null, null, null, null, null, null, null);

  $realPath = 'files/';
  $chapterVideo = $chapterDao->selectVideoFromChapter($chapter)['body'];
  if(!empty($chapterVideo)){
    $realPath = $realPath.'videos/'.$chapterVideo['server_name'];
    unlink($realPath);
  }

  $chapterFiles = $chapterDao->selectResourcesFromChapter($chapter)['body'];

  
  if(!empty($chapterFiles)){
    $realPath= $realPath.'documents/';
    foreach($chapterFiles as $chapterFile){
      $realPath = $realPath.$chapterFile['server_name'];
      unlink($realPath);
    }
  }

  $response = $chapterDao->deleteChapter($chapter);

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