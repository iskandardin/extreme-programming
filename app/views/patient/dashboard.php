<?php
$page_title = 'Dashboard Pasien';
require_once APP_PATH . '/views/layout/header.php';

// Check user is logged in and is patient
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header('Location: ' . SITE_URL . '?page=auth&action=login');
    exit;
}

// Get patient data
$patient = new Patient();
$patient_data = $patient->getByUserId($_SESSION['user_id']);
?>

<h1>Dashboard Pasien</h1>
<p>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong>!</p>

<!-- Statistics Dashboard -->
<div class="dashboard">
    <div class="stat-card primary">
        <h3>5</h3>
        <p>Kunjungan Medis</p>
    </div>
    <div class="stat-card success">
        <h3>3</h3>
        <p>Resep Aktif</p>
    </div>
    <div class="stat-card warning">
        <h3>1</h3>
        <p>Reminder</p>
    </div>
    <div class="stat-card danger">
        <h3>0</h3>
        <p>Alert Darurat</p>
    </div>
</div>

<!-- Patient Info -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Pribadi</h3>
            </div>
            <div class="card-body">
                <?php if ($patient_data): ?>
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($patient_data['full_name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($patient_data['email']); ?></p>
                    <p><strong>Telepon:</strong> <?php echo htmlspecialchars($patient_data['phone']); ?></p>
                    <p><strong>Golongan Darah:</strong> <?php echo $patient_data['blood_type'] ?? '-'; ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?php echo $patient_data['gender'] === 'male' ? 'Laki-laki' : 'Perempuan'; ?></p>
                    <a href="<?php echo SITE_URL; ?>?page=patient&action=profile" class="btn btn-secondary btn-sm">Edit Profil</a>
                <?php else: ?>
                    <p>Data pasien tidak ditemukan</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Monitoring Kesehatan Terbaru</h3>
            </div>
            <div class="card-body">
                <p><strong>Tekanan Darah:</strong> 120/80 mmHg</p>
                <p><strong>Detak Jantung:</strong> 75 bpm</p>
                <p><strong>Suhu Tubuh:</strong> 36.8°C</p>
                <p><strong>Berat Badan:</strong> 70 kg</p>
                <a href="<?php echo SITE_URL; ?>?page=health&action=add" class="btn btn-primary btn-sm">Input Data</a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Menu Cepat</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo SITE_URL; ?>?page=health&action=list" class="btn btn-secondary btn-block">📊 Riwayat Kesehatan</a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo SITE_URL; ?>?page=appointment&action=list" class="btn btn-secondary btn-block">📅 Jadwal Kunjungan</a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo SITE_URL; ?>?page=patient&action=prescriptions" class="btn btn-secondary btn-block">💊 Resep Obat</a>
            </div>
            <div class="col-md-3">
                <a href="<?php echo SITE_URL; ?>?page=patient&action=profile" class="btn btn-secondary btn-block">👤 Profil Saya</a>
            </div>
        </div>
    </div>
</div>

<?php require_once APP_PATH . '/views/layout/footer.php'; ?>
