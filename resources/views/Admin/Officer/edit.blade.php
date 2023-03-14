<form action="<?= route('updateOfficer', $officer->id)?>" method="post">
    @csrf
    <div>
        <label for="name">Nama</label>
        <input type="text" name="name" value="<?= $officer->name ?>">
    </div>
    <div>
        <label for="nik">NIK</label>
        <input type="number" name="nik" value="<?= $officer->nik ?>">
    </div>
    <div>
        <label for="dob">Tanggal Lahir</label>
        <input type="date" name="dob" value="<?= $officer->date_of_birth ?>">
    </div>
    <div>
        <label for="gender">Jenis Kelamin</label>
        <input type="radio" name="gender" value="Laki-laki" @if ($officer->gender == "Laki-laki") checked @endif> Laki-laki
        <input type="radio" name="gender" value="Perempuan" @if ($officer->gender == "Perempuan") checked @endif> Perempuan
    </div>
    <div>
        <label for="address">Alamat</label>
        <input type="text" name="address" value="<?= $officer->address ?>">
    </div>
    <div>
        <label for="phone">No HP</label>
        <input type="text" name="phone" value="<?= $officer->phone ?>">
    </div>
    <div>
        <label for="position">Jabatan</label>
        <input type="text" name="position" value="<?= $officer->position ?>">
    </div>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" value="<?= $user->username ?>">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password">
    </div>
    <button type="submit">Add</button>
</form>
<form action="<?= route('deleteOfficer', $officer->id) ?>" method="POST">
    @method('delete')
    @csrf
    <button type="submit">Delete ID <?= $officer->id ?></button>
</form>