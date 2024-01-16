<?php
$reviewId = filter_input(INPUT_GET, 'reviewId');
$reviewTextArray = getReviewByReviewId($reviewId);
$reviewText = $reviewTextArray['reviewText'];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Review | PHP Motors</title>
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
        <h1>Update Review</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/reviews/index.php" method="post">
                <textarea name="reviewText" required><?php echo $reviewText;?></textarea>
                <input type="submit" value="Update Review" class="form-submit delete-button">
                <input type="hidden" name="action" value="mod">
                <input type="hidden" name="reviewId" value="<?php echo $reviewId?>">
                <!-- <input type="hidden" name="reviewText" value="<?php echo $reviewText?>"> -->
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>