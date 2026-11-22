<h2>Halaman Beranda</h2>
<p style="margin-top: 0.5rem; color: #475569;">
    Selamat datang, <strong><?= $_SESSION['nama']; ?></strong>! <br>
    Anda login sebagai: <strong><?= ($_SESSION['level'] == 1) ? 'Owner (Level 1)' : 'Kasir (Level 2)'; ?></strong>
</p>