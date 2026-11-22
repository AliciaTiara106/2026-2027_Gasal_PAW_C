<h2>Tambah Supplier</h2>
<form method="post" action="?url=/api/supplier/add">
    <label>Nama Supplier :
        <input type="text" name="nama" required>
    </label>
    <label>Telepon :
        <input type="text" name="telp">
    </label>
    <label>Alamat :
        <textarea name="alamat" rows="3"></textarea>
    </label>
    <button type="submit">Tambahkan</button>
</form>