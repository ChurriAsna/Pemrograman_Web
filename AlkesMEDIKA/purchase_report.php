<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'includes/config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Memuat autoload Composer
require 'vendor/autoload.php';

// Ambil dan validasi order_id dari URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id <= 0) {
    header('Location: product.php');
    exit();
}

// Query untuk memastikan order milik user dan mengambil email pengguna (KALAU MAU NAMBAH SELECT YANG MANA TABEL YANG MAU DITAMBAH DI DATABASE)
$stmt = $conn->prepare("
    SELECT orders.id, users.email, users.username, orders.total, orders.payment_method, orders.created_at
    FROM orders 
    JOIN users ON orders.user_id = users.id 
    WHERE orders.id = ? AND orders.user_id = ?
");
$stmt->bind_param("ii", $order_id, $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($id, $customer_email, $customer_name, $total, $payment_method, $created_at); //(JANLUP TAMBAH DISINI)
$stmt->fetch();
$stmt->close();

// Ambil data item pesanan terkait
$stmt_items = $conn->prepare("
    SELECT products.name, order_items.quantity, order_items.price
    FROM order_items
    LEFT JOIN products ON order_items.product_id = products.id
    WHERE order_items.order_id = ?

");
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$result_items = $stmt_items->get_result();

$order_items = [];
while ($row = $result_items->fetch_assoc()) {
    $order_items[] = $row;
}

$stmt_items->close();

// Jika tidak ada item pesanan, tampilkan pesan error
if (empty($order_items)) {
    die("Tidak ada item pesanan ditemukan.");
}

// Debug: Tampilkan isi $order_items
// echo "<pre>";
// print_r($order_items);
// echo "</pre>";
// exit();

// Jika order tidak ditemukan atau tidak milik user, redirect ke halaman produk
if (!$id) {
    header('Location: product.php');
    exit();
}

// Path ke file PDF
$report_path = $report_path = __DIR__ . '/reports/' . $order_id . '.pdf';

// Cek apakah file laporan tersedia
if (!file_exists($report_path)) {
    // Jika file PDF belum ada, buat PDF
    generatePDF($order_id, $report_path, $customer_name, $total, $payment_method, $created_at, $order_items); //(JANLUP TAMBAH DISINI)
}

// Kirim email dengan lampiran PDF ke pelanggan
sendReportEmail($customer_email, $customer_name, $report_path);

// Siapkan file untuk diunduh
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="Laporan_Pesanan_' . $order_id . '.pdf"');
header('Content-Length: ' . filesize($report_path));
readfile($report_path);
exit();

/**
 * Fungsi untuk menghasilkan PDF
 *
 * @param int $order_id ID order
 * @param string $report_path Jalur tempat menyimpan file PDF
 * @param string $customer_name Nama pelanggan
 * @param float $total_price Total harga order
 * @param string $payment_method Metode Pembayaran
 * @param string $created_at Tanggal order
 * @param array $order_items Data order items
 * TAMBAH PARAM TIPE DATA YANG MAU DITAMBAH DI PDF
 */
function generatePDF($order_id, $report_path, $customer_name, $total, $payment_method, $created_at, $order_items) {
    require 'vendor/setasign/fpdf/fpdf.php';

    // Cek dan buat direktori jika belum ada
    $dir = dirname($report_path);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true); // Membuat direktori dengan izin yang sesuai
    }

    $pdf = new FPDF();
    $pdf->AddPage();

    // Debug: Tambahkan teks sebelum menulis tabel
    $pdf->SetFont('Arial', 'B', 16);
    //$pdf->Cell(0, 10, 'Debug: Memulai pembuatan tabel', 0, 1, 'C');
    $pdf->Ln(10);

    // Judul
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Laporan untuk Order ID: ' . $order_id);
    $pdf->Ln(10);

    // Informasi Pelanggan dan Order
    $pdf->SetFont('Arial', '', 12);
    
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $created_at);
    if ($dateTime) {
        $created_at_formatted = $dateTime->format('d-m-Y');
    } else {
        $created_at_formatted = 'Tanggal tidak tersedia';
    }
    // Tambahkan informasi pelanggan dan order
    $pdf->Cell(40, 10, 'Nama Pelanggan: ' . $customer_name);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Total Harga: ' . number_format($total, 2, ',', '.'));
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Metode Pembayaran: ' . $payment_method);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Tanggal Order: ' . $created_at_formatted);
    $pdf->Ln(20);
    
    //(TAMBAH LINE DATA ATAU SELIPIN DI PART INI)
    // Membuat Tabel Item Pesanan
    $pdf->SetFont('Arial', 'B', 12);
    // Header Tabel
    $pdf->Cell(10, 10, 'No', 1, 0, 'C');
    $pdf->Cell(70, 10, 'Nama Produk', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Harga (Rp)', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Sub Total (Rp)', 1, 1, 'C');
    
    // Isi Tabel
    $pdf->SetFont('Arial', '', 12);
    $no = 1;
    foreach ($order_items as $item) {
        $pdf->Cell(10, 10, $no++, 1, 0, 'C');
        $pdf->Cell(70, 10, $item['name'], 1, 0, 'L');
        $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
        $pdf->Cell(40, 10, number_format($item['price'], 2, ',', '.'), 1, 0, 'R');
        $subtotal = $item['quantity'] * $item['price'];
        $pdf->Cell(40, 10, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');
    }
    
    // Total Harga
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, 10, 'Total Harga Keseluruhan:', 1, 0, 'R');
    $pdf->Cell(40, 10, 'Rp ' . number_format($total, 2, ',', '.'), 1, 1, 'R');
    $pdf->Ln(20);
    
    // Tanda Tangan
    $pdf->Cell(0, 10, 'Mengetahui,', 0, 1, 'R');
    $pdf->Ln(15);
    $pdf->Cell(0, 10, '(____________________)', 0, 1, 'R');

    // Coba menyimpan PDF dan tangkap kesalahan
    try {
        $pdf->Output('F', $report_path); // Simpan PDF ke path yang ditentukan
    } catch (Exception $e) {
        error_log("Error saat menyimpan PDF: " . $e->getMessage());
        die("Gagal menyimpan laporan PDF. Silakan coba lagi.");
    }
}

/**
 * Fungsi untuk mengirim email dengan laporan PDF terlampir
 *
 * @param string $customer_email Email pelanggan
 * @param string $customer_name Nama pelanggan
 * @param string $report_path Jalur file PDF
 * @param array $order_items Data order items (Opsional)
 */
function sendReportEmail($customer_email, $customer_name, $report_path, $order_items = []) {
    $mail = new PHPMailer(true);

    try {
        // Konfigurasi server SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Ganti dengan host SMTP Anda
        $mail->SMTPAuth   = true;
        $mail->Username   = 'alearaboa@gmail.com'; // Ganti dengan email Pengirim
        $mail->Password   = 'dhbkownvrztdszcw'; // Ganti dengan password email pengirim
        $mail->SMTPSecure = 'tls'; // Atau 'ssl' sesuai kebutuhan
        $mail->Port       = 587; // Sesuaikan dengan port SMTP Anda

        // Pengaturan penerima
        $mail->setFrom('alearaboa@gmail.com', 'AlkesMEDIKA');
        $mail->addAddress($customer_email, $customer_name);

        // Konten email
        $mail->isHTML(true);
        $mail->Subject = 'Laporan Pesanan Anda';
        $mail->Body    = 'Halo ' . htmlspecialchars($customer_name) . ',<br><br>Laporan pesanan Anda sudah tersedia. Silakan unduh lampiran PDF untuk detailnya.<br><br>Terima kasih telah berbelanja di AlkesMEDIKA.';

        // Lampirkan file PDF
        $mail->addAttachment($report_path);

        // Kirim email
        $mail->send();
    } catch (Exception $e) {
        error_log("Email tidak dapat dikirim. Error: {$mail->ErrorInfo}");
    }
}
?>
