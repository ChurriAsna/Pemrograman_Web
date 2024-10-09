<?php
// login.php
session_start();
require_once 'includes/config.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $errors[] = "Username dan Password wajib diisi.";
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if($stmt->num_rows == 1){
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if(password_verify($password, $hashed_password)){
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $errors[] = "Password salah.";
            }
        } else {
            $errors[] = "Username tidak ditemukan.";
        }
        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<h2 class="d-flex justify-content-center">Selamat Datang di Toko Alat Kesehatan</h2><br>

<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="login.php" method="POST"  class="container">
    <div class="d-flex justify-content-center">
        <div>
            <table >
                <tr>
                    <td width="100px"><br><label for="username" class="form-label">Username</label></td>
                    <td><br><input type="text" class="form-control" id="username" name="username" required value="<?= isset($username) ? htmlspecialchars($username) : '' ?>"></td>
                </tr>
                <tr>
                    <td><br><label for="password" class="form-label">Password</label></td>
                    <td><br><input type="password" class="form-control" id="password" name="password" required></td>
                </tr>
            </table>
            <br><div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
    
</form>

<?php include 'footer.php'; ?>
