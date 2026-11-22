<h2>Tambah Pelanggan</h2>
<form method="post" action="?url=/api/pelanggan/add">
    <label>ID Pelanggan :
        <input type="text" name="id" placeholder="Contoh: FLG0001" required>
    </label>
    <label>Nama :
        <input type="text" name="nama" required>
    </label>
    <label>Jenis Kelamin :
        <select name="jenis_kelamin" required>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </label>
    <label>Telepon :
        <input type="text" name="telp">
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="3"></textarea>
    </label>
    <button type="submit">Tambahkan</button>
</form>