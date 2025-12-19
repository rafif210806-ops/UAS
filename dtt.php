<?php
include 'connection.php';

$nim   = $_POST['nim'];
$nama  = $_POST['nama'];
$prodi = $_POST['prodi'];
$kelas = $_POST['kelas'];
$jk    = $_POST['jenis_kelamin'];

$query = mysqli_query($conn, "INSERT INTO mahasiswa
  (nim, nama, prodi, kelas, jenis_kelamin)
  VALUES
  ('$nim', '$nama', '$prodi', '$kelas', '$jk')");

if ($query) {
  header("Location: dt.php");
} else {
  echo "Data gagal disimpan";
}

