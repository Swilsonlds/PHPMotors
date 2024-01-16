<?php 
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Management | PHP Motors</title>
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
            <h1>Image Management</h1>

            <h2 class=left-indent>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
            echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
            <label>Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset class=fieldset-image>
                    <label>Is this the main image for the vehicle?</label>
                    <label for="priYes" class="pImage">Yes</label>
                    <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                    <label for="priNo" class="pImage">No</label>
                    <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                </fieldset>
            <h2>Upload Image:</h2>
            <input class=block-class type="file" name="file1">
            <input type="submit" class="regbtn" value="Upload">
            <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2 class=left-indent>Existing Images</h2>
            <p class="notice left-indent">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>