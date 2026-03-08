<?php
/**
 * Debug CKFinder POST 500 error
 * Wraps the connector to catch and display errors
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug CKFinder POST Error</h2>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$ckBase = $base . '/libraries/ckeditor/plugins/ckfinder';
$configFile = $ckBase . '/config.php';

// Step 1: Enable display_errors in config.php
echo "<h3>Step 1: Enable error display in config.php</h3>";
$content = file_get_contents($configFile);
if (strpos($content, "display_errors', 0") !== false) {
    $content = str_replace("display_errors', 0", "display_errors', 1", $content);
    file_put_contents($configFile, $content);
    echo "<p style='color:green'>✅ Enabled display_errors=1</p>";
} else {
    echo "<p>Already enabled or not found</p>";
}

// Step 2: Check PHP error log
echo "<h3>Step 2: PHP Error Log</h3>";
$errorLog = ini_get('error_log');
echo "<p>Error log path: " . ($errorLog ?: 'default (server)') . "</p>";

// Try common log locations
$logPaths = [
    '/var/log/php-fpm/error.log',
    '/var/log/litespeed/error.log',
    '/var/www/vhosts/cic.com.vn/logs/error_log',
    '/var/www/vhosts/system/cic.com.vn/logs/error_log',
    $base . '/error_log',
    '/tmp/php_errors.log',
];

if ($errorLog && !in_array($errorLog, $logPaths)) {
    array_unshift($logPaths, $errorLog);
}

foreach ($logPaths as $log) {
    if (file_exists($log) && is_readable($log)) {
        echo "<h4>Found: $log</h4>";
        // Get last 20 lines
        $lines = file($log);
        $lastLines = array_slice($lines, -20);
        echo "<pre style='background:#1a1a2e;color:#e0e0e0;padding:10px;overflow-x:auto;max-height:400px'>";
        foreach ($lastLines as $line) {
            // Highlight CKFinder related errors
            if (stripos($line, 'ckfinder') !== false || stripos($line, 'connector') !== false) {
                echo "<span style='color:#ff6b6b'>" . htmlspecialchars($line) . "</span>";
            } else {
                echo htmlspecialchars($line);
            }
        }
        echo "</pre>";
        break;
    }
}

// Step 3: Simulate POST request through CKFinder
echo "<h3>Step 3: Simulate FileUpload POST</h3>";
@session_start();

$autoload = $ckBase . '/core/connector/php/vendor/autoload.php';
require_once $autoload;

try {
    $ckfinder = new CKSource\CKFinder\CKFinder($configFile);
    echo "<p style='color:green'>✅ CKFinder OK</p>";

    // Create a fake POST request for FileUpload
    $request = Symfony\Component\HttpFoundation\Request::create(
        '/connector.php?command=FileUpload&type=Images&currentFolder=/',
        'POST',
        [], // POST params
        [], // cookies
        [], // files - empty
        ['REQUEST_METHOD' => 'POST']
    );

    // Try to handle
    ob_start();
    try {
        $response = $ckfinder->handle($request);
        $output = ob_get_clean();
        echo "<p>Response: HTTP " . $response->getStatusCode() . "</p>";
        echo "<pre>" . htmlspecialchars($response->getContent()) . "</pre>";
        if ($output) {
            echo "<p>Extra output:</p><pre>" . htmlspecialchars($output) . "</pre>";
        }
    } catch (Exception $e) {
        ob_end_clean();
        echo "<p style='color:red'>❌ Exception: " . $e->getMessage() . "</p>";
        echo "<p>Class: " . get_class($e) . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } catch (Error $e) {
        ob_end_clean();
        echo "<p style='color:red'>❌ Fatal: " . $e->getMessage() . "</p>";
        echo "<p>File: " . $e->getFile() . ":" . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }

} catch (Exception $e) {
    echo "<p style='color:red'>❌ CKFinder Exception: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ CKFinder Fatal: " . $e->getMessage() . "</p>";
    echo "<p>File: " . $e->getFile() . ":" . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<hr><p><strong>Done</strong></p>";
