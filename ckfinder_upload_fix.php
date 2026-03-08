<?php
/**
 * Test CKFinder FileUpload - chọn ảnh rồi nhấn Upload
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>CKFinder Upload Test</h2>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$ckBase = $base . '/libraries/ckeditor/plugins/ckfinder';
$configFile = $ckBase . '/config.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    // Handle upload test
    $file = $_FILES['upload'];
    echo "<p>File: " . htmlspecialchars($file['name']) . "</p>";
    echo "<p>Size: " . number_format($file['size']) . " bytes</p>";
    echo "<p>Type: " . $file['type'] . "</p>";
    echo "<p>PHP Error: " . $file['error'] . "</p>";

    if ($file['error'] !== 0) {
        $errors = [1 => 'exceeds upload_max_filesize', 2 => 'exceeds form MAX_FILE_SIZE', 3 => 'partial', 4 => 'no file', 6 => 'no tmp dir', 7 => 'write fail', 8 => 'extension block'];
        echo "<p style='color:red'>❌ PHP Upload Error: " . ($errors[$file['error']] ?? 'unknown') . "</p>";
    } else {
        // Test 1: Simple move
        $dest = $base . '/upload_images/images/test_' . time() . '_' . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            echo "<p style='color:green'>✅ Direct upload OK! File: " . basename($dest) . "</p>";
            echo "<p><img src='/upload_images/images/" . basename($dest) . "' style='max-width:300px'></p>";
            // Don't delete - keep to verify
        } else {
            echo "<p style='color:red'>❌ move_uploaded_file failed</p>";
        }
    }
    echo "<hr><p><a href='?'>← Back</a></p>";
} else {
    // Show upload form
    echo "<p>upload_max_filesize: " . ini_get('upload_max_filesize') . " | post_max_size: " . ini_get('post_max_size') . "</p>";
    echo '<form method="post" enctype="multipart/form-data" style="padding:20px;background:#222;border-radius:8px;margin:20px 0">';
    echo '<p style="color:#fff;font-size:18px">Chọn ảnh (JPG/PNG) rồi nhấn Upload:</p>';
    echo '<input type="file" name="upload" accept="image/*" style="margin:10px 0;color:#fff"> ';
    echo '<br><button type="submit" style="padding:12px 24px;background:#4CAF50;color:white;border:none;cursor:pointer;font-size:16px;border-radius:4px;margin-top:10px">📤 Test Upload</button>';
    echo '</form>';

    // Also show CKFinder upload info
    echo "<h3>CKFinder Upload Status</h3>";
    $autoload = $ckBase . '/core/connector/php/vendor/autoload.php';
    require_once $autoload;

    try {
        $config = require $configFile;
        echo "<p>CSRF: " . var_export($config['csrfProtection'], true) . " | Auth: " . var_export($config['authentication'](), true) . "</p>";

        $ckfinder = new CKSource\CKFinder\CKFinder($configFile);

        // Test Init
        $request = Symfony\Component\HttpFoundation\Request::create('/connector.php?command=Init&type=Images&currentFolder=/', 'GET');
        $response = $ckfinder->handle($request);

        if ($response->getStatusCode() === 200) {
            echo "<p style='color:green'>✅ Init OK (HTTP 200)</p>";
        } else {
            echo "<p style='color:red'>❌ Init failed: HTTP " . $response->getStatusCode() . "</p>";
        }
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ " . $e->getMessage() . "</p>";
    } catch (Error $e) {
        echo "<p style='color:red'>❌ " . $e->getMessage() . " in " . basename($e->getFile()) . ":" . $e->getLine() . "</p>";
    }

    // Directory check
    echo "<h3>Upload Directories</h3>";
    $uploadDir = $base . '/upload_images/images/';
    echo "<p>images/: " . (is_writable($uploadDir) ? '✅ writable' : '❌ not writable') . "</p>";
}
