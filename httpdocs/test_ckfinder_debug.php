<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>CKFinder Connector Debug</h3>";
echo "<p>PHP version: " . PHP_VERSION . "</p>";

// Test 1: Check config file
$configPath = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/config.php';
echo "<p>Config file exists: " . (file_exists($configPath) ? 'YES' : 'NO') . "</p>";

// Test 2: Check connector file
$connectorPath = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/connector.php';
echo "<p>Connector file exists: " . (file_exists($connectorPath) ? 'YES' : 'NO') . "</p>";

// Test 3: Check autoload
$autoloadPath = __DIR__ . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/vendor/autoload.php';
echo "<p>Autoload file exists: " . (file_exists($autoloadPath) ? 'YES' : 'NO') . "</p>";

// Test 4: Try to load autoload
echo "<p>Trying to load autoload...</p>";
try {
    require_once $autoloadPath;
    echo "<p style='color:green'>Autoload loaded OK</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Autoload error: " . $e->getMessage() . "</p>";
} catch (Error $e) {
    echo "<p style='color:red'>Autoload fatal error: " . $e->getMessage() . "</p>";
}

// Test 5: Try to load config
echo "<p>Trying to load config...</p>";
try {
    $config = require $configPath;
    echo "<p style='color:green'>Config loaded OK</p>";
    echo "<p>CSRF Protection: " . ($config['csrfProtection'] ? 'true' : 'false') . "</p>";
    $authResult = $config['authentication']();
    echo "<p>Auth result: " . ($authResult ? 'true' : 'false') . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Config error: " . $e->getMessage() . "</p>";
} catch (Error $e) {
    echo "<p style='color:red'>Config fatal error: " . $e->getMessage() . "</p>";
}

// Test 6: Try to create CKFinder instance
echo "<p>Trying to create CKFinder instance...</p>";
try {
    if (class_exists('CKSource\CKFinder\CKFinder')) {
        $ckfinder = new CKSource\CKFinder\CKFinder($configPath);
        echo "<p style='color:green'>CKFinder instance created OK</p>";
    } else {
        echo "<p style='color:red'>CKFinder class does not exist after autoload</p>";
    }
} catch (Exception $e) {
    echo "<p style='color:red'>CKFinder error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "<p style='color:red'>CKFinder fatal error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

// Test 7: Check required extensions
echo "<h4>PHP Extensions:</h4>";
echo "<p>GD: " . (function_exists('gd_info') ? 'YES' : 'NO') . "</p>";
echo "<p>Fileinfo: " . (function_exists('finfo_file') ? 'YES' : 'NO') . "</p>";
echo "<p>Intl: " . (extension_loaded('intl') ? 'YES' : 'NO') . "</p>";
echo "<p>JSON: " . (function_exists('json_encode') ? 'YES' : 'NO') . "</p>";

// Test 8: Check upload directory
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload_images/';
echo "<p>Upload dir exists: " . (is_dir($uploadDir) ? 'YES' : 'NO') . "</p>";
echo "<p>Upload dir writable: " . (is_writable($uploadDir) ? 'YES' : 'NO') . "</p>";

echo "<p><strong>Done.</strong></p>";
