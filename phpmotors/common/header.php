<img src="http://localhost/phpmotors/images/site/logo.png" alt="Logo">

<?php if(isset($_SESSION['clientData']['clientFirstname'])){
 $firstname = $_SESSION['clientData']['clientFirstname'];
 echo "<span class=welcome-message><a href='/phpmotors/accounts/index.php?action=admin'>Welcome $firstname</a></span>";
} ?>

<?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== TRUE){
    echo '<a class="myAccount" href="/phpmotors/accounts/index.php?action=Logout">Logout</a>';
}

else {
    echo '<a class="myAccount" href="/phpmotors/accounts/index.php?action=login">My Account</a>';
}
?> 