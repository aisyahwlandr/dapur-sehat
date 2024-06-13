<?php
include '../connection.php';

$loginMessage = "";
$registerMessage = "";
$loginSuccess = false;
$registerSuccess = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Proses login
    $result = mysqli_query($db, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

    if (mysqli_num_rows($result) == 1) {
        // Login berhasil
        session_start();
        $row = mysqli_fetch_object($result); // Mengambil data dari hasil query
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row->id;  // Menyimpan id ke dalam sesi jika diperlukan
        $loginSuccess = true;
        header("Location: ../admin/dashboard.php?id=" . $row->id);
        exit();
    } else {
        // Login gagal
        $loginMessage = "Username atau password salah";
        $loginSuccess = false;
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $code = $_POST['code'];  // input kode

    // Pemeriksaan apakah 'confirmPassword' ada dalam $_POST
    if (isset($_POST['confirmPassword'])) {
        $confirmPassword = $_POST['confirmPassword'];

        if ($password === $confirmPassword) {
            if ($code === 'DAPURsehat') {  // Pemeriksaan kode
                $hashedPassword = md5($password);
                // Proses register
                $result =  mysqli_query($db, "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')");
                if ($result) {
                    // Register berhasil
                    $registerMessage = "Registrasi berhasil, silahkan login.";
                    $registerSuccess = true;
                } else {
                    // Register gagal
                    $registerMessage = "Terjadi kesalahan: " . mysqli_error($db);
                    $registerSuccess = false;
                }
            } else {
                $registerMessage = "Kode registrasi salah. Harap registrasi ulang!";
                $registerSuccess = false;
            }
        } else {
            $registerMessage = "Password dan konfirmasi password tidak cocok. Harap registrasi ulang!";
            $registerSuccess = false;
        }
    } else {
        $registerMessage = "Konfirmasi password tidak ditemukan.";
        $registerSuccess = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="auth.css">
    <link rel="icon" href="../public/images/logo.png" type="image/x-icon">
    <title>Admin Dapur Sehat</title>
    <style>
        #formRegister {
            display: none;
        }

        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>

<body style="height: 200px; width: 90%;
background-image: linear-gradient(90deg, rgba(141, 139, 226, 1), rgba(253, 187, 203, 1));">
    <form id="formLogin" class="form" method="POST" action="">
        <p id="heading">Login</p>
        <div class="field">
            <svg viewBox="0 0 32 32" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z" />
            </svg>
            <input type="text" class="input-field" placeholder="Username" autocomplete="off" name="username" required />
        </div>
        <div class="field position-relative">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input type="password" class="input-field" placeholder="Password" name="password" id="login-password" required />
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('login-password')"></i>
        </div>
        <div class="custom-btn">
            <button class="button1 py-2" type="submit" name="login">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
            <button class=" button2 py-2" type="button" onclick="showRegisterForm()">Register</button>
        </div>
    </form>

    <form id="formRegister" class="form" method="POST" action="">
        <p id="heading">Register</p>
        <div class="field">
            <svg viewBox="0 0 32 32" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                <path d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z" />
            </svg>
            <input type="text" class="input-field" placeholder="Username" autocomplete="off" name="username" required />
        </div>
        <div class="field position-relative">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input type="password" class="input-field" placeholder="Password" name="password" id="register-password" required />
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('register-password')"></i>
        </div>
        <div class="field position-relative">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input type="password" class="input-field" placeholder="Confirm Password" name="confirmPassword" id="confirm-password" required />
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('confirm-password')"></i>
        </div>
        <div class="field position-relative">
            <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z">
                </path>
            </svg>
            <input type="password" class="input-field" placeholder="Registration Code" name="code" id="code-password" required />
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('code-password')"></i>
        </div>
        <div class="custom-btn">
            <button class="button1 py-2" type="button" onclick="showLoginForm()">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </button>
            <button class="button2 py-2" type="submit" name="register">Register</button>
        </div>
    </form>

    <!-- Toast Container -->
    <div id="toast-failed" class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToastFailed" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #BF3131; color: #F3EDC8;">
            <div class="toast-header" style="background-color: #7D0A0A; color: #EAD196;">
                <strong class="me-auto" id="toast-title-failed"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body-failed">
            </div>
        </div>
    </div>

    <div id="toast-success" class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToastSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: #7ABA78; color: #FFFFFF;">
            <div class="toast-header" style="background-color: #0A6847; color: #FFFFFF;">
                <strong class="me-auto" id="toast-title-success"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body-success">
            </div>
        </div>
    </div>

    <!-- Import Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Direct button login regist -->
    <script>
        function showRegisterForm() {
            document.getElementById("formRegister").style.display = "flex";
            document.getElementById("formLogin").style.display = "none";
        }

        function showLoginForm() {
            document.getElementById("formRegister").style.display = "none";
            document.getElementById("formLogin").style.display = "flex";
        }
    </script>

    <!-- toast -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if ($loginMessage) : ?>
                <?php if ($loginSuccess) : ?>
                    showToast('success', 'Login Notification', '<?php echo $loginMessage; ?>');
                <?php else : ?>
                    showToast('failed', 'Login Notification', '<?php echo $loginMessage; ?>');
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($registerMessage) : ?>
                <?php if ($registerSuccess) : ?>
                    showToast('success', 'Register Notification', '<?php echo $registerMessage; ?>');
                <?php else : ?>
                    showToast('failed', 'Register Notification', '<?php echo $registerMessage; ?>');
                <?php endif; ?>
            <?php endif; ?>
        });

        function showToast(type, title, message) {
            const toastTitle = type === 'success' ? document.getElementById('toast-title-success') : document.getElementById('toast-title-failed');
            const toastBody = type === 'success' ? document.getElementById('toast-body-success') : document.getElementById('toast-body-failed');
            const toastElement = new bootstrap.Toast(type === 'success' ? document.getElementById('liveToastSuccess') : document.getElementById('liveToastFailed'));

            toastTitle.textContent = title;
            toastBody.textContent = message;
            toastElement.show();
        }
    </script>

    <!-- Toggle Password Visibility -->
    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var icon = field.nextElementSibling;
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                field.type = "password";
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        }
    </script>

</body>

</html>
