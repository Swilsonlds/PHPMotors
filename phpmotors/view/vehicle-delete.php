<?php
// Build the select list
// $classificationList = '<label for="classificationsAndIds">Vehicle Classification</label><br>';
// $classificationList .= '<select id="classificationsAndIds" name="classificationId">';
// foreach ($classificationsAndIds as $classification) {
//     $classificationList .= "<option value=$classification[classificationId]";
//     if(isset($classificationId)){
//         if($classification['classificationId'] == $classificationId){
//             $classificationList .= ' selected ';
//         }
//     }
//     elseif(isset($invInfo['classificationId'])){
//         if($classification['classificationId'] === $invInfo['classificationId']){
//          $classificationList .= ' selected ';
//         }
//     }

//     $classificationList .= ">$classification[classificationName]</option>";
// }
// $classificationList .= '</select>';
if($_SESSION['clientData']['clientLevel'] < 2){
    header('location: /phpmotors/');
    exit;
   }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
    <link rel="stylesheet" href="http://localhost/phpmotors/css/style.css">
    <link rel="stylesheet" href="http://localhost/phpmotors/css/large.css">
</head>
<body>
    <div class=wrapper>
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php';?>
        </header>
        <nav>
            <!-- <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/navbar.php';?> -->
            <?php echo $navList; ?>
        </nav>
        <main class=add-vehicle-main>
            <h1><?php if(isset($invInfo['invMake'])){ 
            echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">

                <label for="make">Make:</label><br>
                <input type="text" id="make" readonly name="invMake" required
                <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>><br>

                <label for="model">Model:</label><br>
                <input type="text" id="model" readonly name="invModel" required
                <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>><br>

                <label for="description">Description:</label><br>
                <input type="text" id="description" readonly name="invDescription" required
                <?php if(isset($invDescription)){echo "value='$invDescription'";}elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }  ?>><br>

                <input type="submit" value="Delete Vehicle" class="form-submit">
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="
                <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                elseif(isset($invId)){ echo $invId; } ?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>