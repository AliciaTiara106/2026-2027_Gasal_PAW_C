<h2>Tambah User</h2>
<form method="post" action="?url=/api/user/add">
    <label>Username :
        <input type="text" name="username" required>
    </label>
    <label>Password :
        <input type="password" name="password" required>
    </label>
    <label>Nama Lengkap :
        <input type="text" name="nama" required>
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="2"></textarea>
    </label>
    <label>No. HP :
        <input type="text" name="hp">
    </label>
    <label>Level :
        <select name="level">
            <option value="1">Owner (Level 1)</option>
            <option value="2">Kasir (Level 2)</option>
        </select>
    </label>
    <button type="submit">Tambahkan</button>
</form>