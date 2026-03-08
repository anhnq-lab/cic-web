<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$base = '/var/www/vhosts/cic.com.vn/httpdocs';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    $file = $_FILES['upload'];
    echo "<h2>Upload Result</h2>";
    echo "<p>File: " . htmlspecialchars($file['name']) . " | Size: " . number_format($file['size']) . " bytes | Error: " . $file['error'] . "</p>";

    if ($file['error'] === 0) {
        $dest = $base . '/upload_images/images/test_' . time() . '_' . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            echo "<p style='color:green;font-size:20px'>✅ UPLOAD THÀNH CÔNG!</p>";
            echo "<p><img src='/upload_images/images/" . basename($dest) . "' style='max-width:400px'></p>";
        } else {
            echo "<p style='color:red'>❌ move_uploaded_file failed</p>";
        }
    } else {
        echo "<p style='color:red'>❌ Upload error code: " . $file['error'] . "</p>";
    }
    echo "<p><a href='?'>← Thử lại</a></p>";
} else {
    echo "<h2>Test Upload Ảnh</h2>";
    echo "<p>PHP " . PHP_VERSION . " | upload_max: " . ini_get('upload_max_filesize') . " | post_max: " . ini_get('post_max_size') . "</p>";
    echo '<form method="post" enctype="multipart/form-data" style="padding:30px;background:#1a1a2e;border-radius:12px;max-width:500px;margin:20px 0">';
    echo '<p style="color:#fff;font-size:18px;margin-bottom:15px">📷 Chọn ảnh JPG/PNG:</p>';
    echo '<input type="file" name="upload" accept="image/*" style="color:#fff;margin-bottom:15px;display:block">';
    echo '<button type="submit" style="padding:14px 28px;background:#4CAF50;color:white;border:none;cursor:pointer;font-size:16px;border-radius:6px">📤 Upload</button>';
    echo '</form>';
}
