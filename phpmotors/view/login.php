<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Motors</title>
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
        <main class=login-main>
            <h1>Sign in</h1>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="clientEmail" required
                <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br>
                <br>
                
                <label for="password">Password:</label><br>
                <span class="pass-span">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type="text" id="password" name="clientPassword" required
                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

                <input type="submit" value="Sign in" class="form-submit">
                <input type="hidden" name="action" value="Login">
            </form>
            <p class="no-account">Don't have an account? <a href="/phpmotors/accounts/index.php?action=registration">Sign-up</a></p>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>
