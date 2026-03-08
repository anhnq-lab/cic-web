<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>CKFinder Upload Fix</h2>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';

// ========== 1. Check PHP upload settings ==========
echo "<h3>1. PHP Upload Settings</h3>";
echo "<p>upload_max_filesize: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>post_max_size: " . ini_get('post_max_size') . "</p>";
echo "<p>max_file_uploads: " . ini_get('max_file_uploads') . "</p>";
echo "<p>max_execution_time: " . ini_get('max_execution_time') . "</p>";
echo "<p>file_uploads: " . (ini_get('file_uploads') ? 'ON' : 'OFF') . "</p>";
echo "<p>upload_tmp_dir: " . (ini_get('upload_tmp_dir') ?: 'default (sys_temp_dir)') . "</p>";
echo "<p>sys_temp_dir: " . sys_get_temp_dir() . "</p>";
echo "<p>Temp writable: " . (is_writable(sys_get_temp_dir()) ? '✅ YES' : '❌ NO') . "</p>";

// ========== 2. Create upload directories ==========
echo "<h3>2. Upload Directories</h3>";

$uploadBase = $base . '/upload_images';
$dirs = [
    $uploadBase,
    $uploadBase . '/images',
    $uploadBase . '/images/' . date('Y'),
    $uploadBase . '/images/' . date('Y') . '/' . date('m'),
    $uploadBase . '/images/' . date('Y') . '/' . date('m') . '/' . date('d'),
    $uploadBase . '/files',
    $uploadBase . '/.ckfinder',
    $uploadBase . '/.ckfinder/cache',
    $uploadBase . '/.ckfinder/cache/thumbs',
    $uploadBase . '/.ckfinder/tags',
    $uploadBase . '/.ckfinder/logs',
];

foreach ($dirs as $dir) {
    $relDir = str_replace($base, '', $dir);
    if (!is_dir($dir)) {
        if (@mkdir($dir, 0755, true)) {
            echo "<p style='color:green'>✅ Created: $relDir</p>";
        } else {
            echo "<p style='color:red'>❌ Failed to create: $relDir</p>";
        }
    } else {
        $writable = is_writable($dir) ? '✅ writable' : '❌ NOT writable';
        echo "<p>$relDir → EXISTS / $writable</p>";
        // Try to fix permissions
        if (!is_writable($dir)) {
            @chmod($dir, 0755);
            echo "<p>" . (is_writable($dir) ? '✅ Fixed permissions' : '❌ Cannot fix permissions') . "</p>";
        }
    }
}

// ========== 3. Test file write ==========
echo "<h3>3. Test File Write</h3>";
$testFile = $uploadBase . '/images/test_write_' . time() . '.txt';
if (file_put_contents($testFile, 'test')) {
    echo "<p style='color:green'>✅ Can write to images directory</p>";
    unlink($testFile);
} else {
    echo "<p style='color:red'>❌ Cannot write to images directory!</p>";
}

// ========== 4. Test upload with simple form ==========
echo "<h3>4. Quick Upload Test</h3>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['testfile'])) {
    $file = $_FILES['testfile'];
    echo "<p>File received: " . htmlspecialchars($file['name']) . "</p>";
    echo "<p>Size: " . $file['size'] . " bytes</p>";
    echo "<p>Error code: " . $file['error'] . "</p>";

    if ($file['error'] === 0) {
        $dest = $uploadBase . '/images/' . basename($file['name']);
        if (move_uploaded_file($file['tmp_name'], $dest)) {
            echo "<p style='color:green'>✅ Upload OK! File saved to: " . basename($dest) . "</p>";
            // Clean up
            unlink($dest);
        } else {
            echo "<p style='color:red'>❌ move_uploaded_file failed</p>";
        }
    } else {
        $errors = [
            1 => 'Exceeds upload_max_filesize',
            2 => 'Exceeds MAX_FILE_SIZE (form)',
            3 => 'Partial upload',
            4 => 'No file uploaded',
            6 => 'Missing temp folder',
            7 => 'Failed to write to disk',
            8 => 'PHP extension stopped upload',
        ];
        echo "<p style='color:red'>❌ Upload error: " . ($errors[$file['error']] ?? 'Unknown') . "</p>";
    }
} else {
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<input type="file" name="testfile" accept="image/*"> ';
    echo '<button type="submit">Test Upload</button>';
    echo '</form>';
}

// ========== 5. Check .htaccess blocking ==========
echo "<h3>5. Check .htaccess</h3>";
$htaccess = $uploadBase . '/.htaccess';
if (file_exists($htaccess)) {
    echo "<p>⚠️ .htaccess exists in upload_images/:</p>";
    echo "<pre>" . htmlspecialchars(file_get_contents($htaccess)) . "</pre>";
} else {
    echo "<p style='color:green'>✅ No .htaccess blocking uploads</p>";
}

$htaccessRoot = $base . '/.htaccess';
if (file_exists($htaccessRoot)) {
    $content = file_get_contents($htaccessRoot);
    // Check if it blocks PHP in upload dir
    if (strpos($content, 'upload_images') !== false) {
        echo "<p>⚠️ Root .htaccess references upload_images:</p>";
        // Show relevant lines
        $lines = explode("\n", $content);
        foreach ($lines as $i => $line) {
            if (strpos($line, 'upload') !== false) {
                echo "<pre>Line " . ($i + 1) . ": " . htmlspecialchars($line) . "</pre>";
            }
        }
    }
}

echo "<hr><p><strong>Done!</strong></p>";
