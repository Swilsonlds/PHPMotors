<?php
// Build the select list
$classificationList = '<label for="classificationsAndIds">Vehicle Classification</label><br>';
$classificationList .= '<select id="classificationsAndIds" name="classificationId">';
foreach ($classificationsAndIds as $classification) {
    $classificationList .= "<option value=$classification[classificationId]";
    if(isset($classificationId)){
        if($classification['classificationId'] == $classificationId){
            $classificationList .= ' selected ';
        }
    }

    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | PHP Motors</title>
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
            <h1>Add Vehicle</h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <?php echo $classificationList; ?><br>
                <label for="make">Make:</label><br>
                <input type="text" id="make" name="invMake" required
                <?php if(isset($invMake)){echo "value='$invMake'";}  ?>><br>

                <label for="model">Model:</label><br>
                <input type="text" id="model" name="invModel" required
                <?php if(isset($invModel)){echo "value='$invModel'";}  ?>><br>

                <label for="description">Description:</label><br>
                <input type="text" id="description" name="invDescription" required
                <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?>><br>

                <label for="imgPath">Image Path:</label><br>
                <input type="text" value="../images/no-image.png" id="imgPath" name="invImage" required
                <?php if(isset($invImage)){echo "value='$invImage'";}  ?>><br>

                <label for="thumbPath">Thumbnail Path:</label><br>
                <input type="text" value="../images/no-image.png" id="thumbPath" name="invThumbnail" required
                <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>><br>

                <label for="price">Price:</label><br>
                <span class="pass-span">Must be a positive number with no more than 2 decimal places</span><br>
                <input type="number" id="price" name="invPrice" min=0 step="0.01" required
                <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>><br>

                <label for="stock">Inventory Stock:</label><br>
                <span class="pass-span">Must be a positive whole number</span><br>
                <input type="number" id="stock" name="invStock" min=0 step=1 required
                <?php if(isset($invStock)){echo "value='$invStock'";}  ?>><br>

                <label for="color">Inventory Color:</label><br>
                <input type="text" id="color" name="invColor" required
                <?php if(isset($invColor)){echo "value='$invColor'";}  ?>><br>

                <input type="submit" value="Add Vehicle" class="form-submit">
                <input type="hidden" name="action" value="addNewVehicle">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>