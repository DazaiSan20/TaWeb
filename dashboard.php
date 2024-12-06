<?php
include 'utility/sesionlogin.php';
// include("koneksi.php");

$sql = "SELECT
    status,
    COUNT(*) as total
FROM
    laporan
WHERE
    status IN ('Proses', 'Selesai','Masuk','Tolak')
GROUP BY
    status;";

$result = $conn->query($sql);

// Deklarasikan variabel $surat_selesai
$surat_selesai = 0;
$surat_masuk = 0;
$surat_tolak = 0;

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Fetch hasil query sebagai array asosiatif
    while ($row = $result->fetch_assoc()) {
        if ($row['status'] == 'Proses') {
            $surat_proses = $row['total'];
        } elseif ($row['status'] == 'Selesai') {
            $surat_selesai = $row['total'];
        } elseif ($row['status'] == 'Masuk') {
            $surat_masuk = $row['total'];
        } elseif ($row['status'] == 'Tolak') {
            $surat_tolak = $row['total'];
        }
    }
} else {
    // Handle jika query tidak berhasil dieksekusi
    echo "Error: " . $conn->error;
}

?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="icon" href="assets/img/logonganjuk.png" type="image/png" /> <!-- Tambahkan baris ini untuk ikon -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
    .tampilan {
        color: black;
        text-decoration: none;
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include('navbar/upbar.php') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include("navbar/lefbar.php"); ?>
        </div>

        <!-- isi konten -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-5">
                    <h1 class="" style="margin-top: 50px;">Dashboard</h1>
                    <div class="container-fluid" style="margin-bottom: 30px; margin-top: 30px;">
                        <div class="row gx-5">
                            <div class="col-sm-4">
                                <div class="p-3 border bg-light d-flex align-items-center justify-content-center">
                                    <a class="tampilan" href="suratmasuk.php?user=<?php echo htmlentities($user) ?>">
                                        <span class="name">Surat Masuk : </span>
                                        <span class="">
                                            <?php echo htmlentities($surat_masuk); ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 border bg-light d-flex align-items-center justify-content-center">
                                    <a class="tampilan" href="laporan.php?user=<?php echo htmlentities($user) ?>">
                                        <span class="name">Surat Selesai : </span>
                                        <span class="">
                                            <?php echo htmlentities($surat_selesai); ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 border bg-light d-flex align-items-center justify-content-center">
                                    <a class="tampilan" href="laporan.php?user=<?php echo htmlentities($user) ?>">
                                        <span class="name">Surat Ditolak : </span>
                                        <span class="">
                                            <?php echo htmlentities($surat_tolak); ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>Grafik Surat Masuk
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                        <script>
                        fetch('get_data.php')
                            .then(response => response.json())
                            .then(data => {
                                var dates = data.map(entry => entry.tanggal);
                                var counts = data.map(entry => entry.jumlah);

                                var ctx = document.getElementById('myAreaChart').getContext('2d');
                                var areaChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: dates,
                                        datasets: [{
                                            label: 'Surat Masuk per Hari',
                                            data: counts,
                                            fill: true,
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1,
                                            tension: 0.1,
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            x: {
                                                type: 'time',
                                                time: {
                                                    unit: 'day'
                                                }
                                            },
                                            y: {
                                                beginAtZero: true,
                                                ticks: {
                                                    stepSize: 1
                                                }
                                            }
                                        }
                                    }
                                });
                            })
                            .catch(error => console.error('Error fetching data:', error));
                        </script>

                        <div class="card-footer small text-muted">Terakhir pada tanggal
                            <?php
                            include("koneksi.php");

                            $query = "SELECT DATE(tanggal) 
                                    as tanggal FROM pengajuan_surat ORDER BY tanggal DESC LIMIT 1";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $data = $row['tanggal'];
                            } else {
                                $data = ""; // Atau sesuaikan dengan nilai default jika tidak ada data
                            }

                            echo $data;

                            $conn->close();
                            ?>
                            </tbody>
                            </table>
                        </div>
                    </div>


                </div>
        </div>
    </div>
    </main>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    <!-- <script src="assets/demo/chart-area-demo.js"></script> -->
    <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <!-- <script src="js/datatables-simple-demo.js"></script> -->
     
</body>

</html>