<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Hochzeit</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">D & S</a>
            <ul class="nav-links">
                <li><a href="index.php" <?php echo $currentPage === 'home' ? 'class="active"' : ''; ?>>Home</a></li>
                <li><a href="details.php" <?php echo $currentPage === 'details' ? 'class="active"' : ''; ?>>Details</a></li>
                <li><a href="location.php" <?php echo $currentPage === 'location' ? 'class="active"' : ''; ?>>Ort</a></li>
                <li><a href="rsvp.php" <?php echo $currentPage === 'rsvp' ? 'class="active"' : ''; ?>>RSVP</a></li>
            </ul>
            <button class="nav-toggle" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>
    <main>
