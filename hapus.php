<?php
include 'connection.php';

if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan");
}

$nim = $_GET['nim'];

$stmt = $conn->prepare("DELETE FROM mahasiswa WHERE nim = ?");
$stmt->bind_param("s", $nim);

if ($stmt->execute()) {
    header("Location: dt.php");
    exit;
} else {
    echo "Gagal menghapus data";
}

$stmt->close();
$conn->close();
?>
