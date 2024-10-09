<?php
require 'vendor/autoload.php'; // Pastikan untuk memuat autoloader PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Fungsi untuk mengirim email
function sendDummyEmail($customer_email) {
    $mail = new PHPMailer(true);

    // Buat dummy file
    $dummy_file_path = 'dummy_report.txt';
    $content = "Ini adalah file dummy untuk pengujian pengiriman email.\n";
    $content .= "Tanggal: " . date('Y-m-d H:i:s');
    file_put_contents($dummy_file_path, $content);
    
    try {
        // Konfigurasi SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
        $mail->SMTPAuth = true;
        $mail->Username = 'alearaboa@gmail.com'; // Ganti dengan email Anda
        $mail->Password = 'dhbkownvrztdszcw'; // Ganti dengan password Anda
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengaturan penerima
        $mail->setFrom('alearaboa@gmail.com', 'Your Name'); // Ganti dengan email Anda
        $mail->addAddress($customer_email); // Alamat email penerima
        
        // Subjek dan isi email
        $mail->Subject = 'Uji Kirim Email dengan File Dummy';
        $mail->Body = 'Ini adalah email uji dengan lampiran file dummy.';
        
        // Lampirkan dummy file
        $mail->addAttachment($dummy_file_path);
        
        // Kirim email
        $mail->send();
        echo 'Email berhasil dikirim.';
    } catch (Exception $e) {
        echo "Email tidak dapat dikirim. Kesalahan: {$mail->ErrorInfo}";
    }
}

// Panggil fungsi untuk mengirim email
sendDummyEmail('recipient@example.com'); // Ganti dengan alamat email penerima
?>
