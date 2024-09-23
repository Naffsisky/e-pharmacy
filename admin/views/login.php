<?php
session_start();

// Cek apakah pengguna sudah login melalui sesi atau cookies
if (isset($_SESSION['username'])) {
  header('Location: ./dashboard.php'); // Redirect ke halaman dashboard atau index
  exit(); // Hentikan script agar tidak menjalankan sisa kode
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
  <link rel="stylesheet" href="../css/login.css" />
  <title>Admin Login</title>
</head>

<body>
  <div class="container">
    <?php if (isset($error)) : ?>
      <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <div class="brand">
      <div class="login-title">A<span style="color: #0db8de">potek</span> K<span style="color: #27ef9f">u</span></div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-2"></div>
      <div class="col-lg-6 col-md-8 login-box">
        <div class="col-lg-12 login-key">
          <i class="fa fa-key" aria-hidden="true"></i>
        </div>
        <div class="col-lg-12 login-title">ADMIN LOGIN</div>

        <div class="col-lg-12 login-form">
          <div class="col-lg-12 login-form">
            <form action="../php/controllers/login.php" method="POST">
              <div class="form-group">
                <label class="form-control-label">USERNAME</label>
                <input type="text" class="form-control" name="username" id="username" />
              </div>
              <div class="form-group" style="position: relative;">
                <label class="form-control-label">PASSWORD</label>
                <input type="password" class="form-control" name="password" id="password" />
              </div>

              <div class="col-lg-12 loginbttm">
                <div class="col-lg-6 login-btm login-text"></div>
                <div class="col-lg-6 login-btm login-button">
                  <button type="submit" class="btn btn-outline-primary" name="login" id="login">LOGIN</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-3 col-md-2"></div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      // Add a toggle button after the password input
      $('#password').after('<button type="button" id="togglePassword" class="btn btn-outline-secondary">Show</button>');

      // Style the toggle button to appear on the same line as the input
      $('#togglePassword').css({
        'position': 'absolute',
        'right': '10px',
        'top': '50%',
        'transform': 'translateY(-50%)',
        'z-index': '10'
      });

      // Add some padding to the password input to prevent overlap
      $('#password').css('padding-right', '70px');

      // Toggle password visibility
      $('#togglePassword').click(function() {
        const passwordInput = $('#password');
        const toggleButton = $(this);

        if (passwordInput.attr('type') === 'password') {
          passwordInput.attr('type', 'text');
          toggleButton.text('Hide');
        } else {
          passwordInput.attr('type', 'password');
          toggleButton.text('Show');
        }
      });
    });
  </script>
</body>

</html>