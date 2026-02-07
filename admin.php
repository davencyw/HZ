<?php
session_start();

// Simple admin password - change this!
define('ADMIN_PASSWORD', 'hochzeit2026');

// Handle login/logout
if (isset($_POST['password'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $loginError = 'Falsches Passwort';
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    header('Location: admin.php');
    exit;
}

$isLoggedIn = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

$currentPage = 'admin';
$pageTitle = 'Admin';

// Get RSVP data if logged in
$rsvps = [];
$stats = ['total' => 0, 'yes' => 0, 'no' => 0, 'maybe' => 0, 'guests' => 0];

if ($isLoggedIn) {
    require_once 'config.php';
    
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM rsvp ORDER BY created_at DESC");
            $rsvps = $stmt->fetchAll();
            
            foreach ($rsvps as $rsvp) {
                $stats['total']++;
                $stats[$rsvp['attending']]++;
                if ($rsvp['attending'] === 'yes') {
                    $stats['guests'] += $rsvp['guests'];
                }
            }
        } catch (PDOException $e) {
            $dbError = 'Datenbankfehler: ' . $e->getMessage();
        }
    } else {
        $dbError = 'Keine Datenbankverbindung';
    }
}

include 'includes/header.php';
?>

<style>
    .admin-login {
        max-width: 400px;
        margin: var(--spacing-xl) auto;
        padding: var(--spacing-lg);
        background: var(--color-white);
        border: 1px solid var(--color-gold-light);
    }
    
    .admin-login h2 {
        text-align: center;
        margin-bottom: var(--spacing-md);
    }
    
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: var(--spacing-sm);
        margin-bottom: var(--spacing-md);
    }
    
    .admin-logout {
        font-size: 0.85rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: var(--spacing-sm);
        margin-bottom: var(--spacing-lg);
    }
    
    .stat-card {
        background: var(--color-white);
        padding: var(--spacing-md);
        border: 1px solid var(--color-gold-light);
        text-align: center;
    }
    
    .stat-card .number {
        font-family: var(--font-serif);
        font-size: 2.5rem;
        color: var(--color-sage);
        line-height: 1;
    }
    
    .stat-card .label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--color-text-light);
        margin-top: var(--spacing-xs);
    }
    
    .rsvp-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--color-white);
        font-size: 0.9rem;
    }
    
    .rsvp-table th,
    .rsvp-table td {
        padding: var(--spacing-sm);
        text-align: left;
        border-bottom: 1px solid var(--color-gold-light);
    }
    
    .rsvp-table th {
        background: var(--color-cream);
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
    }
    
    .rsvp-table tr:hover {
        background: rgba(139, 157, 119, 0.05);
    }
    
    .status-yes { color: var(--color-sage-dark); font-weight: 500; }
    .status-no { color: #a04040; }
    .status-maybe { color: var(--color-gold); }
    
    .table-container {
        overflow-x: auto;
    }
    
    .no-data {
        text-align: center;
        padding: var(--spacing-lg);
        color: var(--color-text-light);
    }
    
    @media (max-width: 768px) {
        .rsvp-table {
            font-size: 0.8rem;
        }
        
        .rsvp-table th,
        .rsvp-table td {
            padding: var(--spacing-xs);
        }
    }
</style>

<div class="page-header">
    <h1>Admin</h1>
</div>

<section class="section">
    <?php if (!$isLoggedIn): ?>
        <form class="admin-login" method="POST">
            <h2>Anmelden</h2>
            <?php if (isset($loginError)): ?>
                <div class="message message-error"><?php echo htmlspecialchars($loginError); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-submit">
                <button type="submit" class="btn btn-primary">Anmelden</button>
            </div>
        </form>
    <?php else: ?>
        <div class="admin-header">
            <h2>RSVP Übersicht</h2>
            <a href="admin.php?logout=1" class="admin-logout">Abmelden</a>
        </div>
        
        <?php if (isset($dbError)): ?>
            <div class="message message-error"><?php echo htmlspecialchars($dbError); ?></div>
        <?php else: ?>
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="number"><?php echo $stats['total']; ?></div>
                    <div class="label">Antworten</div>
                </div>
                <div class="stat-card">
                    <div class="number"><?php echo $stats['yes']; ?></div>
                    <div class="label">Zusagen</div>
                </div>
                <div class="stat-card">
                    <div class="number"><?php echo $stats['guests']; ?></div>
                    <div class="label">Gäste total</div>
                </div>
                <div class="stat-card">
                    <div class="number"><?php echo $stats['no']; ?></div>
                    <div class="label">Absagen</div>
                </div>
                <div class="stat-card">
                    <div class="number"><?php echo $stats['maybe']; ?></div>
                    <div class="label">Unsicher</div>
                </div>
            </div>
            
            <?php if (empty($rsvps)): ?>
                <div class="no-data">Noch keine RSVP-Antworten vorhanden.</div>
            <?php else: ?>
                <div class="table-container">
                    <table class="rsvp-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Personen</th>
                                <th>Status</th>
                                <th>Ernährung</th>
                                <th>Nachricht</th>
                                <th>Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rsvps as $rsvp): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($rsvp['name']); ?></td>
                                    <td><?php echo htmlspecialchars($rsvp['email']); ?></td>
                                    <td><?php echo $rsvp['guests']; ?></td>
                                    <td class="status-<?php echo $rsvp['attending']; ?>">
                                        <?php 
                                        $statusLabels = ['yes' => 'Ja', 'no' => 'Nein', 'maybe' => 'Vielleicht'];
                                        echo $statusLabels[$rsvp['attending']];
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($rsvp['dietary_requirements'] ?: '-'); ?></td>
                                    <td><?php echo htmlspecialchars($rsvp['message'] ?: '-'); ?></td>
                                    <td><?php echo date('d.m.Y H:i', strtotime($rsvp['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>
