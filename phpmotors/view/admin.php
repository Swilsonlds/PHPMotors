<?php
if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors/index.php');}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>
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
        <main>
            <h1><?php echo $_SESSION['clientData']['clientFirstname'],' ', $_SESSION['clientData']['clientLastname'] ;?></h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <ul>
                <li>First Name = <?php echo $_SESSION['clientData']['clientFirstname']?></li>
                <li>Last Name = <?php echo $_SESSION['clientData']['clientLastname']?></li>
                <li>Email Address = <?php echo $_SESSION['clientData']['clientEmail']?></li>
            </ul>
                <?php 
                    if (($_SESSION['clientData']['clientLevel'])>1){
                        createVehicleController();
                    }
                    
                    createUserController();
                ?>
                <h1>Your Reviews</h1>
                <?php
                    if (isset($_SESSION['clientReviewList'])){
                        echo $_SESSION['clientReviewList'];
                    }
                    else {
                        echo '<p>It looks like you haven\' written any reviews yet...</p>';
                    }
                ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>