<form action="<?= route('storeOfficer') ?>" method="post">
    @csrf
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name">
    </div>
    <div>
        <label for="nik">NIK</label>
        <input type="number" name="nik">
    </div>
    <div>
        <label for="dob">Tanggal Lahir</label>
        <input type="date" name="dob">
    </div>
    <div>
        <label for="gender">Jenis Kelamin</label>
        <input type="radio" name="gender" value="Laki-laki"> Laki-laki
        <input type="radio" name="gender" value="Perempuan"> Perempuan
    </div>
    <div>
        <label for="address">Alamat</label>
        <input type="text" name="address">
    </div>
    <div>
        <label for="phone">No HP</label>
        <input type="text" name="phone">
    </div>
    <div>
        <label for="position">Jabatan</label>
        <input type="text" name="position">
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">Add</button>
</form>