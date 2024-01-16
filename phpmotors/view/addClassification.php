<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Classification | PHP Motors</title>
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
            <h1>Add Car Classification</h1>
            <?php
                if (isset($message)) {
                echo $message;
                }
            ?>
            <form action="/phpmotors/vehicles/index.php" method="post">
                <label for="classification">Classification Name:</label><br>
                <span class="pass-span">Classification name must be shorter than 30 characters</span><br>
                <input type="text" id="classification" name="classificationName" maxlength="30" required><br>
                <input type="submit" value="Add Classification" class="form-submit">
                <input type="hidden" name="action" value="addCarClassification">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>