<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error | PHP Motors</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/large.css">
</head>
<body>
    <div class=wrapper>
        <header>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/header.php';?>
        </header>
        <nav>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/navbar.php';?>
        </nav>
        <main>
            <h1>Server Error</h1>
            <p class=sorry>Sorry, our server seems to be experiencing some technical difficulties.</p>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>