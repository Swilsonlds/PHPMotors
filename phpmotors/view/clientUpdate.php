<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account | PHP Motors</title>
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
            <h1>Manage Account Info</h1>
            <h2 class=left-indent>Update Account</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            ?>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label for="firstname">First Name:</label><br>
                <input type="text" id="firstname" name="clientFirstname" required
                <?php 
                $firstname = $_SESSION['clientData']['clientFirstname'];
                if(isset($_SESSION['clientData'])){echo "value='$firstname'";}  ?>
                ><br>

                <label for="lastname">Last Name:</label><br>
                <input type="text" id="lastname" name="clientLastname" required
                <?php 
                $lastname = $_SESSION['clientData']['clientLastname'];
                if(isset($_SESSION['clientData'])){echo "value='$lastname'";}  ?>><br>

                <label for="email">Email Address:</label><br>
                <input type="email" id="email" name="clientEmail" required
                <?php 
                $email = $_SESSION['clientData']['clientEmail'];
                if(isset($_SESSION['clientData'])){echo "value='$email'";}  ?>><br>

                <!-- <label for="password">Password:</label><br>
                <span class="pass-span">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type="password" id="password" name="clientPassword" required 
                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br> -->

                <input type="submit" value="Update Info" class="form-submit">
                <input type="hidden" name="action" value="updateAccountInfo">
            </form>

            <h2 class=left-indent>Update Password</h2>
            <form action="/phpmotors/accounts/index.php" method="post">
                <label for="password">Password:</label><br>
                <span class="pass-span">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
                <input type="text" id="password" name="clientPassword" required 
                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

                <input type="submit" value="Update Password" class="form-submit">
                <input type="hidden" name="action" value="updatePassword">
            </form>


        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>