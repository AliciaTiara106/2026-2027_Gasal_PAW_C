<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<h1 style='color:red;'>TES: Form Berhasil Dikirim! Username: " . $_POST['username'] . "</h1>";
    die(); 
}
?>
<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
    <h2 style="text-align: center; margin-bottom: 20px;">Login Sistem</h2>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div style="color: #ef4444; background: #fee2e2; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center;">
            <?= $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="?url=/prosesLogin" method="POST">
        <label>Username
            <input type="text" name="username" required autofocus>
        </label>
        <label>Password
            <input type="password" name="password" required>
        </label>
        <button type="submit" style="width: 100%; padding: 10px; font-size: 1rem; margin-top: 10px;">Masuk</button>
    </form>
</div>