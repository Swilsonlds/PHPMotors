<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Details | PHP Motors</title>
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
            <?php if(isset($message)){
             echo $message; }
            ?>
            <?php if(isset($vehicleInfo)){
            echo $vehicleInfo;
            }?>
            <hr>
            <h2 class=left-indent>Customer Reviews</h2>
            <?php
            if (isset($_SESSION['message1'])) {
                echo $_SESSION['message1'];
            }
            ?>
            <?php if(!isset($_SESSION['loggedin'])){
            echo '<p class="left-indent">You must be logged in to leave reviews.</p>
                <a class="left-indent review-login-link" href="/phpmotors/accounts/index.php?action=login">Click here to login.</a>';
            }?>
            <?php if(isset($_SESSION['loggedin'])){
            echo '<form action="/phpmotors/reviews/index.php" method="post">
                    <label for="review">Leave a Review:</label><br>
                    <textarea id="review" name="reviewText" required></textarea>
                    <?php if(isset($reviewText)){echo "value=$reviewText";}  ?><br>

                    <input type="submit" value="Add Review" class="form-submit">
                    <input type="hidden" name="clientId" value='.$_SESSION["clientData"]["clientId"].'>
                    <input type="hidden" name="invId" value='.$invId.'>
                    <input type="hidden" name="action" value="addReview">

                    </form>';
            }?>
            <?php  
                echo $reviewList;
            ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>
<?php unset($_SESSION['message1']); ?>