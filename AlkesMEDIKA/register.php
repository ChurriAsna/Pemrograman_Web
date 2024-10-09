<?php
// register.php
session_start();
require_once 'includes/config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $email = trim($_POST['email']);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = trim($_POST['address']);
    $city = $_POST['city'];
    $contact_no = trim($_POST['contact_no']);
    $paypal_id = trim($_POST['paypal_id']);
    
    // Validasi input
    if (empty($username) || empty($password) || empty($retype_password) || empty($email)) {
        $errors[] = "Username, Password, dan Email wajib diisi.";
    }
    
    if ($password !== $retype_password) {
        $errors[] = "Password dan Retype Password tidak cocok.";
    }
    
    // Cek apakah username atau email sudah digunakan
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $errors[] = "Username atau Email sudah digunakan.";
    }
    $stmt->close();
    
    // Jika tidak ada error, lanjutkan pendaftaran
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, password, email, dob, gender, address, city, contact_no, paypal_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $username, $hashed_password, $email, $dob, $gender, $address, $city, $contact_no, $paypal_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Registrasi berhasil. Silakan login.";
            header("Location: login.php");
            exit();
        } else {
            $errors[] = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<h2>Daftar Akun Baru</h2>

<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="register.php" method="POST">
    <div class="mb-3">
        <label for="username" class="form-label">Username *</label>
        <input type="text" class="form-control" id="username" name="username" required value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password *</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="mb-3">
        <label for="retype_password" class="form-label">Retype Password *</label>
        <input type="password" class="form-control" id="retype_password" name="retype_password" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" name="email" required value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="dob" class="form-label">Tanggal Lahir</label>
        <input type="date" class="form-control" id="dob" name="dob" value="<?= isset($dob) ? htmlspecialchars($dob) : '' ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?= (isset($gender) && $gender == 'Male') ? 'checked' : '' ?>>
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?= (isset($gender) && $gender == 'Female') ? 'checked' : '' ?>>
            <label class="form-check-label" for="female">Female</label>
        </div>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Alamat</label>
        <textarea class="form-control" id="address" name="address"><?= isset($address) ? htmlspecialchars($address) : '' ?></textarea>
    </div>
    <div class="mb-3">
        <label for="city" class="form-label">Kota</label>
        <select class="form-select" id="city" name="city">
            <option value="">Pilih Kota</option>
            <option value="Jakarta" <?= (isset($city) && $city == 'Jakarta') ? 'selected' : '' ?>>Jakarta</option>
            <option value="Bandung" <?= (isset($city) && $city == 'Bandung') ? 'selected' : '' ?>>Bandung</option>
            <option value="Bandung" <?= (isset($city) && $city == 'Surabaya') ? 'selected' : '' ?>>Surabaya</option>
            <!-- Tambahkan opsi kota lainnya sesuai kebutuhan -->
        </select>
    </div>
    <div class="mb-3">
        <label for="contact_no" class="form-label">Nomor Kontak</label>
        <input type="text" class="form-control" id="contact_no" name="contact_no" pattern="\d{10,15}" title="Nomor telepon harus antara 10 hingga 15 digit." value="<?= isset($contact_no) ? htmlspecialchars($contact_no) : '' ?>">
    </div>
    <div class="mb-3">
        <label for="paypal_id" class="form-label">PayPal ID</label>
        <input type="email" class="form-control" id="paypal_id" name="paypal_id" value="<?= isset($paypal_id) ? htmlspecialchars($paypal_id) : '' ?>">
    </div>
    <button type="submit" class="btn btn-primary">Daftar</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
</form>

<?php include 'footer.php'; ?>
