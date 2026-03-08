<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>CKFinder Connector Debug</h3>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$ckBase = $base . '/libraries/ckeditor/plugins/ckfinder';

// Check config
$configFile = $ckBase . '/config.php';
echo "<p>Config exists: " . (file_exists($configFile) ? 'YES' : 'NO') . "</p>";

// Show config contents (first 50 lines)
if (file_exists($configFile)) {
    echo "<h4>Config.php first 40 lines:</h4><pre>";
    $lines = file($configFile);
    for ($i = 0; $i < min(40, count($lines)); $i++) {
        echo htmlspecialchars($lines[$i]);
    }
    echo "</pre>";
}

// Check autoload
$autoload = $ckBase . '/core/connector/php/vendor/autoload.php';
echo "<p>Autoload exists: " . (file_exists($autoload) ? 'YES' : 'NO') . "</p>";

// Try autoload
echo "<h4>Loading autoload...</h4>";
try {
    @session_start();
    require_once $autoload;
    echo "<p style='color:green'>✅ Autoload OK</p>";

    // Try config
    echo "<h4>Loading config...</h4>";
    $config = require $configFile;
    echo "<p style='color:green'>✅ Config OK</p>";
    echo "<p>csrfProtection: " . var_export($config['csrfProtection'], true) . "</p>";
    echo "<p>Auth result: " . var_export($config['authentication'](), true) . "</p>";

    // Try CKFinder
    echo "<h4>Creating CKFinder instance...</h4>";
    $ckfinder = new CKSource\CKFinder\CKFinder($configFile);
    echo "<p style='color:green'>✅ CKFinder OK</p>";

    // Try Init command
    echo "<h4>Running Init command...</h4>";
    $_GET['command'] = 'Init';
    $_GET['type'] = 'Images';
    $_GET['currentFolder'] = '/';
    $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

    try {
        $response = $ckfinder->handle($request);
        echo "<p style='color:green'>✅ Init response: HTTP " . $response->getStatusCode() . "</p>";
        echo "<pre>" . htmlspecialchars(substr($response->getContent(), 0, 500)) . "</pre>";
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ Init error: " . $e->getMessage() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } catch (Error $e) {
        echo "<p style='color:red'>❌ Init fatal: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }

} catch (Exception $e) {
    echo "<p style='color:red'>❌ Exception: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ Fatal Error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<h4>Extensions:</h4>";
echo "GD: " . (function_exists('gd_info') ? 'YES' : 'NO') . "<br>";
echo "Fileinfo: " . (function_exists('finfo_file') ? 'YES' : 'NO') . "<br>";
echo "Intl: " . (extension_loaded('intl') ? 'YES' : 'NO') . "<br>";

$uploadDir = $base . '/upload_images/';
echo "<p>Upload dir: " . (is_dir($uploadDir) ? 'EXISTS' : 'MISSING') . " / " . (is_writable($uploadDir) ? 'WRITABLE' : 'NOT WRITABLE') . "</p>";
