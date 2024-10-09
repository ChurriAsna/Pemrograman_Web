<?php
if (!is_dir($reports_dir)) {
    if (!mkdir($reports_dir, 0755, true)) {
        die('Gagal membuat direktori reports.');
    }
}
?>