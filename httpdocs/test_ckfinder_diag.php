<?php
/**
 * CKFinder PHP 8 Diagnostic
 * Truy cập: https://www.cic.com.vn/test_ckfinder_diag.php
 * XÓA FILE SAU KHI DÙNG
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>CKFinder PHP 8 Diagnostic</h2>";
echo "<p>PHP Version: " . PHP_VERSION . "</p>";

// Test 1: Load autoloader
echo "<h3>Test 1: Autoloader</h3>";
$autoload = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/vendor/autoload.php';
if (file_exists($autoload)) {
    echo "✅ autoload.php exists<br>";
    try {
        require_once $autoload;
        echo "✅ autoload.php loaded OK<br>";
    } catch (Throwable $e) {
        echo "❌ autoload.php ERROR: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "❌ autoload.php not found<br>";
}

// Test 2: Load config
echo "<h3>Test 2: Config</h3>";
$config_path = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/config.php';
if (file_exists($config_path)) {
    echo "✅ config.php exists<br>";
    try {
        @session_start();
        $config = require $config_path;
        echo "✅ config.php loaded OK<br>";
        if (is_array($config)) {
            echo "Authentication callback: " . (isset($config['authentication']) ? 'SET' : 'MISSING') . "<br>";
            echo "License: " . (isset($config['licenseKey']) ? 'SET' : 'MISSING') . "<br>";
            echo "CSRF: " . ($config['csrfProtection'] ? 'ENABLED' : 'DISABLED') . "<br>";
        }
    } catch (Throwable $e) {
        echo "❌ config.php ERROR: " . $e->getMessage() . "<br>";
        echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
    }
} else {
    echo "❌ config.php not found<br>";
}

// Test 3: Instantiate CKFinder
echo "<h3>Test 3: CKFinder Class</h3>";
try {
    if (class_exists('CKSource\CKFinder\CKFinder')) {
        echo "✅ CKFinder class exists<br>";
        $ckfinder = new CKSource\CKFinder\CKFinder($config_path);
        echo "✅ CKFinder instantiated OK<br>";
    } else {
        echo "❌ CKFinder class NOT found<br>";
        // Check if there's a php5 specific version
        $php5_path = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/php5';
        if (is_dir($php5_path)) {
            echo "⚠️ Found php5 directory - this CKFinder may only support PHP 5<br>";
        }
    }
} catch (Throwable $e) {
    echo "❌ CKFinder ERROR: " . $e->getMessage() . "<br>";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "<br>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr><p>⚠️ XÓA FILE NÀY SAU KHI KIỂM TRA!</p>";
