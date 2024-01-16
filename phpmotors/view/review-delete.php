<?php
$reviewId = filter_input(INPUT_GET, 'reviewId');
$reviewTextArray = getReviewByReviewId($reviewId);
$reviewText = $reviewTextArray['reviewText'];

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Review | PHP Motors</title>
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
            <h1>Delete Review</h1>
            <form action="/phpmotors/reviews/index.php" method="post">
                <textarea readonly><?php echo $reviewText;?></textarea>
                <input type="submit" value="Delete Review" class="form-submit delete-button">
                <input type="hidden" name="action" value="del">
                <input type="hidden" name="reviewId" value="<?php echo $reviewId?>">
            </form>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>