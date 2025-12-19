<?php
include 'connection.php';

// Ambil data dari tabel mahasiswa (database uas)
$data = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .navbar {
      background: linear-gradient(to right, #fff176, #ffeb3b, #fdd835);
    }

    .btn-tambah {
      background: linear-gradient(135deg, #6a5acd, #8a2be2);
      border: none;
      color: #ffffff;
      padding: 10px 24px;
      font-size: 15px;
      font-weight: 600;
      border-radius: 14px;
      box-shadow: 0 8px 20px rgba(138, 43, 226, 0.45);
      transition: all 0.3s ease;
    }

    .btn-tambah:hover {
      background: linear-gradient(135deg, #5a4fcf, #7b1fa2);
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(123, 31, 162, 0.6);
    }
    .table thead th {
      background: linear-gradient(90deg, #1e3c72, #2a5298);
      color: #ffffff;
      text-align: center;
      border: none;
      font-weight: 600;
    }
    .table tbody td {
      vertical-align: middle;
      border-color: #e3e8f0;
    }
    .table-striped tbody tr:nth-of-type(odd) {
      background-color: #f4f7ff;
    }
    .table tbody tr:hover {
      background-color: #e8efff;
      transition: 0.2s ease-in-out;
    }
    .table {
      border-radius: 10px;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg py-0 bg-body-tertiary bg-warning">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <img src="Lg.PNG" class="img-fluid" alt="Politeknik Negeri Medan" style="height: 50px;">

          <button class="navbar-toggler position-absolute end-0 me-3"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" href="index.php">Home</a>
          <a class="nav-link" href="tentang.php">Tentang</a>
          <a class="nav-link" href="dt.php">Data Mahasiwa</a>
        </div>
      </div>
    </div>
  </nav>

  <h1 class="mb-3 mt-4" style="font-family: 'Poppins', 'Segoe UI', sans-serif; text-align: center;">Data Mahasiswa</h1>
  <div class="container mt-4">
    <!-- BUTTON TAMBAH -->
    <button class="btn btn-primary mb-3 btn-tambah" data-bs-toggle="collapse" data-bs-target="#formTambah">
      Tambah Mahasiswa
    </button>

    <!-- FORM TAMBAH DATA -->
    <div class="collapse mb-4" id="formTambah">
      <div class="card card-body">
        <!-- ACTION KE FILE PHP PROSES -->
        <form class="add" action="dtt.php" method="post">
          <div class="modal-body">

            <div class="mb-3">
              <label>NIM</label>
              <input type="int" class="form-control" name="nim" id="nim" aria-describedby="nim" required>
            </div>

            <div class="mb-3">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" required>
            </div>

            <div class="mb-3">
              <label>Prodi</label>
              <input type="text" class="form-control" name="prodi" id="prodi" aria-describedby="prodi" required>
            </div>

            <div class="mb-3">
              <label>Kelas</label>
              <input type="varchar" class="form-control" name="kelas" id="kelas" aria-describedby="kelas" required>
            </div>

            <div class="mb-3">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>

          </div>

          <button type="submit" class="btn btn-success">Simpan</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
      </div>
    </div>

    <!-- TABEL DATA -->
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Prodi</th>
          <th>Kelas</th>
          <th>Jenis Kelamin</th>
          <th>Ubah Data</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $sql = "SELECT * FROM mahasiswa ORDER BY nim DESC";
        $result = $conn->query($sql);

        // CEK QUERY
        if (!$result) {
          die("Query error: " . $conn->error);
        }

        if ($result->num_rows > 0) {
          $no = 1;
          while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
              <td><?= $no ?></td>
              <td><?= $row['nim'] ?></td>
              <td><?= $row['nama'] ?></td>
              <td><?= $row['prodi'] ?></td>
              <td><?= $row['kelas'] ?></td>
              <td><?= $row['jenis_kelamin'] ?></td>
              <td>
                <a href="edit.php?nim=<?= $row['nim'] ?>"
                  class="btn btn-warning btn-sm"
                  onclick="return confirm('Apakah Anda Yakin Akan Mengubah?')">
                  Edit
                </a>

                <a href="hapus.php?nim=<?= $row['nim'] ?>"
                  class="btn btn-danger btn-sm"
                  onclick="return confirm('Apakah Anda Yakin Akan Menghapus?')">
                  Hapus
                </a>
              </td>
            </tr>
        <?php
            $no++;
          }
        } else {
          echo "<tr><td colspan='7' class='text-center'>Data kosong</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>

    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>