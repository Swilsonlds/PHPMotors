<?php
// This is the vehicles controller

// Create or access a session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

$classifications = getClassifications();
$classificationsAndIds = getClassificationsAndIds();
$classificationList = buildClassificationList($classificationsAndIds);

// Build a navigation bar using the $classifications array
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

case 'addClassification':
    include 'C:/xampp/htdocs/phpmotors/view/addClassification.php';
break;

case 'addVehicle':
    include 'C:/xampp/htdocs/phpmotors/view/addVehicle.php';
break;

case 'vehicleManagement':
    include 'C:/xampp/htdocs/phpmotors/view/vehicleManagement.php';
break;

case 'userManagement':
    include 'C:/xampp/htdocs/phpmotors/view/clientUpdate.php';
break;



// Extracts info from the form on the addClassification view and inserts it into the database
case 'addCarClassification':
    // Filter and store the data
    $carClassification = filter_input(INPUT_POST, 'classificationName');

    // Check for missing data
    if(empty($carClassification)){
        $message = '<p class=\'registration-error\'>Please provide information for all empty form fields.</p>';
        include '../view/addClassification.php';
        exit;
    }

    // Send the data to the model
    $addClassOutcome = addClassification($carClassification);

    // Check and report the result
    if($addClassOutcome === 1){
        include '../view/vehicleManagement.php';
        header("Refresh:0");
        exit;
    } else {
        $message = "<p>Sorry, but we weren't able to add the classification. Please try again.</p>";
        include '../view/addClassification.php';
        exit;
    }
break;

// Extracts info from the form on the addVehicle view and inserts it into the database
case 'addNewVehicle':
    // Filter and store the data
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));

    // Check for missing data
    if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
        $message = '<p class=registration-error >Please provide information for all empty form fields.</p>';
        include '../view/addVehicle.php';
        exit;
    }

    // Send the data to the model
    $addCarOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

    // Check and report the result
    if($addCarOutcome == 1){
        $message = "<p  class=vehicle-added >$invModel has been successfully added. </p>";
        include '../view/addVehicle.php';
        exit;
    } else {
        $message = "<p class=registration-error>Sorry, but the vehicle wasn't added. Please try again.</p>";
        include '../view/addVehicle.php';
        exit;
}
break;

/* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */ 
case 'getInventoryItems': 
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId); 
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray); 
break;

case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);  
    $invInfo = getInvItemInfo($invId);   
    if(count($invInfo)<1){
        $message = 'Sorry, no vehicle information could be found.';
    }      
    include '../view/vehicle-update.php';
    exit;
break;

case 'updateVehicle':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
    $message = '<p>Please complete all information for the new item! Double check the classification of the item.</p>';
    include '../view/vehicle-update.php';
    exit;
    }

    $updateResult = updateVehicle($invId, $classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
    if ($updateResult) {
        $_SESSION['message'] = "<p class=success>Congratulations, the $invMake $invModel was successfully updated.</p>";
        header('location: /phpmotors/vehicles/');;
        exit;
    } else {
        $_SESSION['message'] = "<p>Error. The new vehicle was not updated.</p>";
        include '../view/vehicle-update.php';;
        exit;
    }
break;

case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-delete.php';
        exit;	
break;

case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    
    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
        $message = "<p class=success>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
    } else {
        $message = "<p class='notice'>Error: $invMake $invModel was not
    deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
    }						
break;

case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
      } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
      }
    //   echo $vehicleDisplay;
    //   exit;
      include '../view/classification.php';
break;

case 'carInfo':
    
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['invId'] = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $invReviews = getReviewByInventoryItem($invId);
    $reviewList = buildReviewList($invReviews);
    $vehicles = getInvItemInfo($invId);
    if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
      } else {
        $vehicleInfo = buildVehicleInfo($vehicles);
      }
    //   echo $vehicleDisplay;
    //   exit;
      include '../view/vehicle-detail.php';
break;


default:
    $classificationList = buildClassificationList($classificationsAndIds);
    include '../view/vehicleManagement.php';
break;


}



unset($_SESSION['message']);

?>