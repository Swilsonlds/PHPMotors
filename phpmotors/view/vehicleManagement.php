<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/index.php');}

if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
    }

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    }
       
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>
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
            <?php echo $navList;?>
        </nav>
        <main class=vehicle-management-main>
            <h1>Vehicle Management</h1>
            <ul>
                <li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a></li>
                <li><a href="/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a></li>
            </ul>
            <div class=left-indent>
                <?php
                    if (isset($message)) { 
                    echo $message; 
                    } 
                    if (isset($classificationList)) { 
                    echo '<h2>Vehicles By Classification</h2>'; 
                    echo '<p>Choose a classification to see those vehicles</p>'; 
                    echo $classificationList; 
                    }
                ?>
                <noscript>
                <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>
            </div>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html>

<?php unset($_SESSION['message']); ?>