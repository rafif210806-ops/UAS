<?php
include 'connection.php';

// cek apakah data dikirim
if (!isset($_POST['nim'])) {
    die("Akses tidak valid");
}

$nim   = $_POST['nim'];
$nama  = $_POST['nama'];
$prodi = $_POST['prodi'];
$kelas = $_POST['kelas'];
$jk    = $_POST['jenis_kelamin'];

// query update
$sql = "UPDATE mahasiswa SET 
            nama = '$nama',
            prodi = '$prodi',
            kelas = '$kelas',
            jenis_kelamin = '$jk'
        WHERE nim = '$nim'";

if ($conn->query($sql)) {
    header("Location: dt.php");
    exit;
} else {
    echo "Gagal update data: " . $conn->error;
}

$conn->close();
?>
