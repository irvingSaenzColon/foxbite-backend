<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json; charset=utf-8');

require '../../vendor/autoload.php';

include_once('../../model/Request.php');
include_once('../../model/Router.php');
include_once('../../dao/ChatDAO.php');
include_once('../../model/Chat.php');

$dotenv = Dotenv\Dotenv::createImmutable('../../');
  $dotenv->safeLoad();
 

$router = new Router(new Request);

$router->get('/chat/?', function($request) {
    $idPattern = '/[0-9]+$/';

    preg_match($idPattern, $request->requestUri, $idMatch);

    $chat = new Chat($idMatch[0], null, null, null);

    $chatDao = new ChatDAO();
    $response = $chatDao->selectChat($chat);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/chat/user', function($request) {
    $response = [];
    $body = $request->getBody();
    $option = $body['option'];
    $chatsData = [];
    $chat = new Chat($body['id'], $body['sender'], $body['receiver'], $body['content']);

    $chatDao = new ChatDAO();
    if($option === 'SA'){
        $response = $chatDao->selectAll($chat);

        foreach($response['body'] as $chatData){
          $chatData['receiver_image'] = base64_decode($chatData['receiver_image']);
          $chatData['sender_image'] = base64_decode($chatData['sender_image']);
          array_push($chatsData, $chatData);
        }
      
        $response['body'] = $chatsData;
    }
    else if($option === 'IM')
        $response = $chatDao->insertMessageChat($chat);

    http_response_code($response['status']);
    return json_encode($response);
});

$router->post('/chat', function($request) {
    $body = $request->getBody();
    $response = [];

    $chat = new Chat(null, intval($body['sender']), intval($body['receiver']), null);
    $chatDAO = new ChatDAO();
    $response = $chatDAO->insertChat($chat);

    http_response_code($response['status']);
    return json_encode($response);
  });
