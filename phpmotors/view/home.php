<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
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
            <h1>Welcome to PHP Motors!</h1>
            <div class=car-box>
                <img src="http://localhost/phpmotors/images/delorean.jpg" alt="Picture of delorean" class=car-picture>
                <button class=little-button>Own Today!</button>
                <div class="button-box">
                    <h2>DMC Delorean</h2>
                    <p>3 Cup Holders</p>
                    <p>Superman Doors</p>
                    <P>Fuzzy Dice!</P>
                    <button>Own Today!</button>
                </div>
            </div>
            <div class=reviews-and-upgrades>
                <section class=customer-reviews>
                    <h2>DMC Delorean Reviews</h2>
                    <ul>
                        <li>"Super duper fast!" (4/5)</li>
                        <li>"A true blast from the past; I bought 2!" (5/5)</li>
                        <li>"Not bad. It was missing some of the features from the movie." (3/5)</li>
                        <li>"Tried to make it fly... Didn't work" (1/5)</li>
                        <li>"It's a car" (3/5)</li>
                    </ul>
                </section>
                <section class=upgrade-wrapper>
                    <h2>Delorean Upgrades</h2>
                    <div class=delorean-upgrades>
                        <div class=upgrade>
                            <div class=upgrade-box>
                                <img src="http://localhost/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumber sticker upgrade">
                            </div>
                            <a href="">Bumper Stickers</a>
                        </div>
                        <div class=upgrade>
                            <div class=upgrade-box>
                                <img src="http://localhost/phpmotors/images/upgrades/flux-cap.png" alt="Flux capacitor upgrade">
                            </div>
                            <a href="">Flux Capacitor</a>
                        </div>
                        <div class=upgrade>
                            <div class=upgrade-box>
                                <img src="http://localhost/phpmotors/images/upgrades/flame.jpg" alt="Flame decals upgrade">
                            </div>
                            <a href="">Flame Decals</a>
                        </div>
                        <div class=upgrade>
                            <div class=upgrade-box>
                                <img src="http://localhost/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub cap upgrade">
                            </div>
                            <a href="">Hub Caps</a>
                        </div>
                    </div>
                </section>
            </div>
        </main>
        <footer>
            <?php require $_SERVER['DOCUMENT_ROOT']. '/phpmotors/common/footer.php';?>
        </footer>
    </div>
</body>
</html>

<?php unset($_SESSION['message']); ?>