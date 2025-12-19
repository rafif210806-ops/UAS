<?php
include 'connection.php';

// cek parameter
if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan");
}

$nim = $_GET['nim'];

// ambil data lama
$query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    die("Data tidak ditemukan");
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h4>Edit Data Mahasiswa</h4>

<form action="update.php" method="post">
    <!-- NIM dikirim ke backend -->
    <input type="hidden" name="nim" value="<?= $data['nim'] ?>">

    <div class="mb-3">
        <label>NIM</label>
        <input type="text" class="form-control" value="<?= $data['nim'] ?>" disabled>
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Prodi</label>
        <input type="text" name="prodi" class="form-control" value="<?= $data['prodi'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Kelas</label>
        <input type="text" name="kelas" class="form-control" value="<?= $data['kelas'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select" required>
            <option value="L" <?= ($data['jenis_kelamin']=='L') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= ($data['jenis_kelamin']=='P') ? 'selected' : '' ?>>Perempuan</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="dt.php" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>
