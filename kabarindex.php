<?php 
include("koneksi.php");

try {
    $sql = "SELECT judul, tanggal, deskripsi, gambar FROM kabar_desa ORDER BY tanggal DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($judul, $tanggal, $deskripsi, $gambar);
    
    $berita = [];
    while ($stmt->fetch()) {
        $berita[] = [
            'judul' => $judul,
            'tanggal' => $tanggal,
            'deskripsi' => $deskripsi,
            'gambar' => $gambar
        ];
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kabar Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/logonganjuk.png" type="image/png" /> <!-- Tambahkan baris ini untuk ikon -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .detail-container {
            display: flex;
            align-items: flex-start;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .detail-image {
            width: 200px; /* Ukuran gambar tetap */
            height: 200px; /* Ukuran gambar tetap */
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px; /* Jarak antara gambar dan deskripsi */
        }
        .detail-content {
            max-width: 600px;
        }
        .detail-title {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }
        .detail-date {
            color: #6c757d;
            font-size: 14px;
        }
        .detail-description {
            font-size: 16px;
            color: #495057;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top bg-white">
      <div class="container-fluid">
        <!-- Image and Text -->
        <a class="navbar-brand" href="index.html">
          <img
            src="assets/img/logonganjuk.png"
            alt="Logo"
            style="max-height: 70px; margin-right: 10px; margin-top: -30px"
          />
          <span class="d-inline-block" style="font-weight: 500"
            >Desa Kauman <br />Kecamatan Nganjuk</span
          >
        </a>

        <!-- Navbar Toggler -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="nav justify-content-end">
            <li class="nav-item">
              <a class="nav-link" href="#">Kabar Desa</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">Halaman Awal</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary" href="login.php">Login Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
            <main>
                <div class="container-fluid px-5">
                    <h1 class="mt-4">Kabar Desa</h1>
                    
                    <?php foreach ($berita as $data): ?>
                        <div class="detail-container">
                            <?php if ($data['gambar']): ?>
                                <img src="uploads/<?php echo htmlentities($data['gambar']); ?>" class="detail-image" alt="Gambar Kabar">
                            <?php endif; ?>
                            <div class="detail-content">
                                <h2 class="detail-title"><?php echo htmlentities($data['judul']); ?></h2>
                                <p class="detail-date"><strong>Tanggal:</strong> <?php echo htmlentities($data['tanggal']); ?></p>
                                <div class="detail-description">
                                    <strong>Deskripsi:</strong>
                                    <p><?php echo nl2br(htmlentities($data['deskripsi'])); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <a href="index.html" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript resources -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>