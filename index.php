<?php
$currentPage = 'home';
$pageTitle = 'Willkommen';
include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <p class="hero-subtitle">Wir heiraten</p>
        <h1>David & Sarah</h1>
        <div class="hero-ornament">
            <span></span>
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span></span>
        </div>
        <p class="hero-date">Samstag, 15. August 2026</p>
        <a href="rsvp.php" class="btn btn-primary">Zusagen</a>
    </div>
</section>

<section class="section section-centered">
    <h2>Feiert mit uns</h2>
    <p>
        Wir freuen uns sehr, euch zu unserer Hochzeitsfeier einzuladen. 
        Es wäre uns eine grosse Ehre, diesen besonderen Tag mit euch zu teilen.
    </p>
    <p>
        Bitte teilt uns bis zum <strong>15. Juni 2026</strong> mit, ob ihr dabei sein könnt.
    </p>
</section>

<?php include 'includes/footer.php'; ?>
