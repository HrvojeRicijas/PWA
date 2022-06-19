<!DOCTYPE html>

<?php
session_start();
?>
<body>
    <div class="wholeHeader">
        <div class="headerLogo">
            <img src="/pwa/img/sternLogo.png" alt="stern logo" class="headerImage">
        </div>
        <div class="headerText">
            <h1>stern</h1>
            <nav>  
                <span><a href="/pwa/index.html">Home</a></span>
                <span><a href="/pwa/category.php?category=politik">Politik</a></span>
                <span><a href="/pwa/category.php?category=gesundheit">Gesundheit</a></span>
                <span><a href="/pwa/admin.php">Administracija</a></span>
                <?php if (isset($_SESSION['access'])){echo '<span><a href="/pwa/archive.php">Archive</a></span>';} ?>
            </nav>
        </div>
    </div>
</body>
</html>