<?php
require 'vendor/setasign/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();

// Header Tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(70, 10, 'Nama Produk', 1, 0, 'C');
$pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C');
$pdf->Cell(40, 10, 'Harga (Rp)', 1, 0, 'C');
$pdf->Cell(40, 10, 'Sub Total (Rp)', 1, 1, 'C');

// Isi Tabel
$pdf->SetFont('Arial', '', 12);
$no = 1;
$data = [
    ['name' => 'Stetoskop', 'quantity' => 1, 'price' => 150000],
    ['name' => 'Vitamin C 1000mg', 'quantity' => 2, 'price' => 20000],
];

foreach ($data as $item) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(70, 10, utf8_decode($item['name']), 1, 0, 'L');
    $pdf->Cell(30, 10, $item['quantity'], 1, 0, 'C');
    $pdf->Cell(40, 10, number_format($item['price'], 2, ',', '.'), 1, 0, 'R');
    $subtotal = $item['quantity'] * $item['price'];
    $pdf->Cell(40, 10, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');
}

$pdf->Output();
?>
