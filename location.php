<?php
$currentPage = 'location';
$pageTitle = 'Ort';
include 'includes/header.php';
?>

<div class="page-header">
    <h1>Ort & Anfahrt</h1>
</div>

<section class="section">
    <div class="location-info">
        <div class="location-card">
            <h3>Trauung</h3>
            <p>Dorfkirche Musterstadt</p>
            <p>Kirchgasse 1</p>
            <p>8000 Zürich</p>
        </div>
        
        <div class="location-card">
            <h3>Feier</h3>
            <p>Schloss Musterberg</p>
            <p>Schlossweg 10</p>
            <p>8000 Zürich</p>
        </div>
        
        <div class="location-card">
            <h3>Übernachtung</h3>
            <p>Hotel Sonnenhof</p>
            <p>Hauptstrasse 25</p>
            <p>8000 Zürich</p>
            <p><small>Stichwort "Hochzeit David & Sarah"</small></p>
        </div>
    </div>
    
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86253.56049706024!2d8.465546450000001!3d47.37688945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47900b9749bea219%3A0xe66e8df1e71fdc03!2sZ%C3%BCrich!5e0!3m2!1sde!2sch!4v1704067200000!5m2!1sde!2sch" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</section>

<section class="section section-centered">
    <h2>Anreise</h2>
    <p><strong>Mit dem Auto:</strong> Parkplätze stehen beim Schloss zur Verfügung.</p>
    <p><strong>Mit dem ÖV:</strong> Ab Hauptbahnhof Zürich mit der S-Bahn bis Musterstadt, dann 10 Minuten Fussweg.</p>
</section>

<?php include 'includes/footer.php'; ?>
