<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Login - Kauman</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(to right, #17a2b8, #0d6efd);
      color: #333;
      font-family: Arial, sans-serif;
    }
    .card {
      width: 600px; /* Membuat card lebih lebar */
      padding: 40px; /* Memberikan lebih banyak padding di dalam card */
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      margin-top: 50px;
    }
    .card-header {
      background-color: #ffffff;
      text-align: center;
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .btn-primary {
      background-color: #0d6efd;
      border: none;
      font-weight: bold;
    }
    .btn-primary:hover {
      background-color: #0b5ed7;
    }
    .small {
      color: #0d6efd;
    }
    .small:hover {
      color: #0b5ed7;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container d-flex justify-content-center">
          <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header">
              <img src="assets/img/logonganjuk.png" class="mx-auto d-block" alt="Logo" style="width: 25%;">
              <h3 class="text-center font-weight-light mt-3">Login</h3>
            </div>
            <div class="card-body">
              <form action="login_proses.php" method="POST" name="login">
                <div class="form-floating mb-3">
                  <input class="form-control" id="username" name="username" type="text" placeholder="Username" required />
                  <label for="username"><i class="fas fa-user me-2"></i>Username</label>
                </div>
                <div class="form-floating mb-3">
                  <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                  <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                  <a class="small" href="verKodeOTP/proses_kirimkodeotp.php">Lupa Password?</a>
                  <input class="btn btn-primary px-4 py-2" type="submit" value="Login">
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>

      <!-- Modal Error -->
      <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="errorModalLabel">Login Gagal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Login gagal. Silakan coba lagi.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var showErrorModal = <?php echo isset($_GET['error']) ? 'true' : 'false'; ?>;
      if (showErrorModal) {
        var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
        myModal.show();
      }
    });
  </script>
</body>
</html>
