<?php
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

$classifications = getClassifications();
$classificationsAndIds = getClassificationsAndIds();
$classificationList = buildClassificationList($classificationsAndIds);
$navList = createNavList($classifications);

// Reviews controller
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'delete':
        include '../view/review-delete.php';
    break;

    case 'modify':
        include '../view/review-update.php';
    break;

    
    case 'addReview':
        $reviewText = filter_input(INPUT_POST, 'reviewText');
        $clientId = filter_input(INPUT_POST, 'clientId');
        $invId = filter_input(INPUT_POST, 'invId');

        if(empty($reviewText)){
            $_SESSION['message1'] = '<p class=\'registration-error\'>Please provide information for all empty form fields.</p>';
            header('Location: ../vehicles?action=carInfo&invId='.$invId);
            exit;
        }

        $addReviewOutcome = createReview($reviewText, $invId, $clientId);

        if($addReviewOutcome == 1){
            header('Location: ../vehicles?action=carInfo&invId='.$invId);
            $_SESSION['message1'] = "<p class=vehicle-added>Review successfully added</p>";
            exit;
        } else {
            header('Location: ../vehicles?action=carInfo&invId='.$invId);
            $_SESSION['message1'] = '<p class=\'registration-error\'>We were unable to add the review. Sorry.</p>';
            exit;
        }
    break;

    case 'mod':
        $reviewId = filter_input(INPUT_POST, 'reviewId');
        $reviewText = filter_input(INPUT_POST, 'reviewText');

        if(empty($reviewText)){
            $_SESSION['message'] = '<p class=\'registration-error\'>Please provide information for all empty form fields.</p>';
            header('Location: ../reviews/?action=modify&reviewId='.$reviewId);
            exit;
        }

        $return = updateReview($reviewId, $reviewText);

        if ($return) {
            $message = "<p class=vehicle-added>Review was	successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $message = "<p class='registration-error'>Review was not
        updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        }	

    break;

    case 'del':
        $reviewId = filter_input(INPUT_POST, 'reviewId');
        
        $return = deleteReview($reviewId);
        if ($return) {
            $message = "<p class=vehicle-added>Review was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        } else {
            $message = "<p class='registration-error'>Review was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');
            exit;
        }	
        $_SESSION['message'] = "<p class=vehicle-added>Review Successfully deleted</p>";
        header('Location: ../accounts/?action=admin');

    break;

    default:
        include '../view/vehicle-detail.php';
    break;
}

?>