<?php
$currentPage = 'rsvp';
$pageTitle = 'RSVP';

require_once 'config.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $guests = intval($_POST['guests'] ?? 1);
    $attending = $_POST['attending'] ?? '';
    $dietary = trim($_POST['dietary'] ?? '');
    $messageText = trim($_POST['message'] ?? '');
    
    // Validation
    if (empty($name) || empty($email) || empty($attending)) {
        $message = 'Bitte füllt alle Pflichtfelder aus.';
        $messageType = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Bitte gebt eine gültige E-Mail-Adresse ein.';
        $messageType = 'error';
    } elseif ($pdo === null) {
        $message = 'Datenbankverbindung fehlgeschlagen. Bitte versucht es später erneut.';
        $messageType = 'error';
    } else {
        try {
            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM rsvp WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->fetch()) {
                // Update existing entry
                $stmt = $pdo->prepare("UPDATE rsvp SET name = ?, guests = ?, attending = ?, dietary_requirements = ?, message = ? WHERE email = ?");
                $stmt->execute([$name, $guests, $attending, $dietary, $messageText, $email]);
                $message = 'Eure Antwort wurde aktualisiert. Vielen Dank!';
            } else {
                // Insert new entry
                $stmt = $pdo->prepare("INSERT INTO rsvp (name, email, guests, attending, dietary_requirements, message) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $guests, $attending, $dietary, $messageText]);
                $message = 'Vielen Dank für eure Rückmeldung!';
            }
            $messageType = 'success';
            
            // Clear form data on success
            $name = $email = $dietary = $messageText = '';
            $guests = 1;
            $attending = '';
            
        } catch (PDOException $e) {
            error_log("RSVP Error: " . $e->getMessage());
            $message = 'Ein Fehler ist aufgetreten. Bitte versucht es später erneut.';
            $messageType = 'error';
        }
    }
}

include 'includes/header.php';
?>

<div class="page-header">
    <h1>RSVP</h1>
</div>

<section class="section">
    <p style="text-align: center; margin-bottom: var(--spacing-lg);">
        Bitte teilt uns bis zum <strong>15. Juni 2026</strong> mit, ob ihr an unserer Hochzeit teilnehmen könnt.
    </p>
    
    <?php if ($message): ?>
        <div class="message message-<?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    
    <form class="rsvp-form" method="POST" action="rsvp.php">
        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name" required value="<?php echo htmlspecialchars($name ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="email">E-Mail *</label>
            <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($email ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="guests">Anzahl Personen</label>
            <select id="guests" name="guests">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php echo (isset($guests) && $guests == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label>Teilnahme *</label>
            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="attending" value="yes" <?php echo (isset($attending) && $attending === 'yes') ? 'checked' : ''; ?> required>
                    Ja, ich/wir kommen
                </label>
                <label class="radio-option">
                    <input type="radio" name="attending" value="no" <?php echo (isset($attending) && $attending === 'no') ? 'checked' : ''; ?>>
                    Leider nicht
                </label>
                <label class="radio-option">
                    <input type="radio" name="attending" value="maybe" <?php echo (isset($attending) && $attending === 'maybe') ? 'checked' : ''; ?>>
                    Noch unsicher
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="dietary">Allergien / Ernährungswünsche</label>
            <input type="text" id="dietary" name="dietary" placeholder="z.B. vegetarisch, glutenfrei..." value="<?php echo htmlspecialchars($dietary ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="message">Nachricht an das Brautpaar</label>
            <textarea id="message" name="message" placeholder="Wir freuen uns über eure Worte..."><?php echo htmlspecialchars($messageText ?? ''); ?></textarea>
        </div>
        
        <div class="form-submit">
            <button type="submit" class="btn btn-primary">Absenden</button>
        </div>
    </form>
</section>

<?php include 'includes/footer.php'; ?>
