<?php
// This is the accounts controller

// Create or access a session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

$classifications = getClassifications();
$navList = createNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_SESSION['clientData'])){
    $cookieFirstname = filter_input(INPUT_COOKIE,'$_SESSION["clientData"]["clientFirstname"]', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}

switch ($action){
case 'login':
    include 'C:/xampp/htdocs/phpmotors/view/login.php';
break;

case 'registration':
    include 'C:/xampp/htdocs/phpmotors/view/registration.php';
break;

case 'admin':
    $_SESSION['reviewArray']= getReviewById($_SESSION['clientData']['clientId']);
    $_SESSION['clientReviewList']= buildReviewListClient($_SESSION['reviewArray']);
    include 'C:/xampp/htdocs/phpmotors/view/admin.php';
break;

case 'Logout':
    session_unset();
    session_destroy();
    include 'C:/xampp/htdocs/phpmotors/index.php';
break;

case 'register':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
   
    // Checking for existing email address
    $existingEmail = checkExistingEmail($clientEmail);

    if($existingEmail){
        $_SESSION['message'] = '<p class=registration-error>That email address already exists. Would you like to login instead?</p>';
        include '../view/login.php';
        exit;
    }

    // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $_SESSION['message'] = '<p class=registration-error >Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit;
    }
    
    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
    
    // Check and report the result
    if($regOutcome === 1){
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        // $message = "<p Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        $_SESSION['message'] = "<p class=vehicle-added >Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        // header('Location: /phpmotors/accounts/?action=login');
        exit;
        
    } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
}
break;

case 'Login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if(empty($clientEmail) || empty($checkPassword)){
        $_SESSION['message'] = '<p class=registration-error >Please provide information for all empty form fields.</p>';
        include '../view/login.php';
        exit;
    }

    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
        $_SESSION['message'] = '<p class="registration-error">Please check your password and try again.</p>';
        // include '../view/login.php';
        include "../view/admin.php";
        header('Refresh:0');
    exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    $_SESSION['reviewArray']= getReviewById($_SESSION['clientData']['clientId']);
    $_SESSION['clientReviewList']= buildReviewListClient($_SESSION['reviewArray']);
    // Send them to the admin view
    include '../view/admin.php';
    exit;
break;

case 'updateAccountInfo':
    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));

    $clientEmail = checkEmail($clientEmail);
   
    // Checking for existing email address
    $existingEmail = checkExistingEmail($clientEmail);

    // if($existingEmail){
    //     $_SESSION['message'] = '<p class=registration-error>That email address already exists. Would you like to login instead?</p>';
    //     include '../view/login.php';
    //     exit;
    // }

    // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
        $_SESSION['message'] = '<p class=registration-error >Please provide information for all empty form fields.</p>';
        include '../view/clientUpdate.php';
        exit;
    }
    
    if (isset($_SESSION['clientData'])){
        $clientId = $_SESSION['clientData']['clientId'];
    }
    // Hash the checked password
    $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
    
    // Check and report the result
    if($regOutcome ==1){
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $clientData = getClient($clientEmail);
        $_SESSION['clientData'] = $clientData;
        // $message = "<p Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        $_SESSION['message'] = "<p class=vehicle-added >$clientFirstname, your account has been modified</p>";
        include '../view/admin.php';
        // header('Location: /phpmotors/accounts/?action=login');
        exit;
        
    } else {
        $message = "<p>Sorry $clientFirstname, we were unable to modify your account</p>";
        include '../view/clientUpdate.php';
        exit;
}
break;

case 'updatePassword':
    // Filter and store the data
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $checkPassword = checkPassword($clientPassword);
   
    // Check for missing data
    if(empty($checkPassword)){
        $_SESSION['message'] = '<p class=registration-error >Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit;
    }

    if (isset($_SESSION['clientData'])){
        $clientId = $_SESSION['clientData']['clientId'];
    }
    
    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $regOutcome = updatePassword($hashedPassword, $clientId);
    
    // Check and report the result
    if($regOutcome == 1){
        $_SESSION['message'] = "<p class=vehicle-added >Your password has been successfully changed</p>";
        include '../view/admin.php';
        exit;
        
    } else {
        $message = "<p>Sorry $clientFirstname, but we were unable to change your password</p>";
        include '../view/clientUpdate.php';
        exit;
}
break;

default:
    include '../view/admin.php';
break;
}

unset($_SESSION['message']);

?>