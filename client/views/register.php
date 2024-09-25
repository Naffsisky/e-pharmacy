<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="p-2">
            <div style="background-color: rgba(255, 255, 255, 0.07); border: 0px solid black; border-radius: 20px">
                <h2 class="title py-3">Register Form</h2>
            </div>
            <br />
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form class="row g-3" action="../php/controllers/register.php" method="POST">
                        <div class="col-12 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dateOfBirth" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="" disabled selected>Select your gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact" name="contact" pattern="[0-9]{10}" required placeholder="+1234567890">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="paypalID" class="form-label">PayPal ID</label>
                            <input type='text' class='form-control' id='paypalID' name='paypalID' required placeholder='your-paypal@example.com'>
                        </div>

                        <div class='col-6'>
                            <span class="text-light"> Sudah punya akun?</span>
                            <a href="./login.php" style='text-decoration: none;'>Login</a>
                        </div>

                        <div class='col-6' style="text-align: right">
                            <button type='submit' class='btn btn-light'>Register</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js' integrity='sha384-oBqDVmMz4fnFO9gybU8g+u1H6fU1YxgF1cGgF5yL9o4qZ0Bz0A6m8JtZ9k+ZB7w9' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js' integrity='sha384-q8i/X+965DzO0rT2x1aO7C8p4e4D9z0cL7u6vY1QyF4S8gWcXhOe7XlRzQwM8N' crossorigin='anonymous'></script>

</body>

</html>