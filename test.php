<?php
header('Access-Control-Allow-Origin: *');

include_once './dao/UserDAO.php';
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
 

$userDAO = new UserDAO();

$response = $userDAO->selectUser(0);

echo json_encode($response);
