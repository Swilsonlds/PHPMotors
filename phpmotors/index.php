<?php
// This is the main controller

// Create or access a session
session_start();

// Gain access to other files
require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';

$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = createNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_SESSION['clientData'])){
    // $cookieFirstname = filter_input(INPUT_COOKIE,'$_SESSION["clientData"]["clientFirstname"]', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}

switch ($action){
case 'template':
    include 'view/template.php';
    break;

default:
    include 'view/home.php';
}

unset($_SESSION['message']);
?>