<?php
/**
 * Test CKFinder FileUpload command directly
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>CKFinder FileUpload Debug</h2>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$ckBase = $base . '/libraries/ckeditor/plugins/ckfinder';
$configFile = $ckBase . '/config.php';

@session_start();

// Load autoload
$autoload = $ckBase . '/core/connector/php/vendor/autoload.php';
require_once $autoload;

// Load config
$config = require $configFile;
echo "<p>CSRF: " . var_export($config['csrfProtection'], true) . "</p>";
echo "<p>Auth: " . var_export($config['authentication'](), true) . "</p>";

// Create CKFinder instance
try {
    $ckfinder = new CKSource\CKFinder\CKFinder($configFile);
    echo "<p style='color:green'>✅ CKFinder OK</p>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ CKFinder error: " . $e->getMessage() . " in " . basename($e->getFile()) . ":" . $e->getLine() . "</p>";
    die("<pre>" . $e->getTraceAsString() . "</pre>");
}

// Simulate FileUpload POST
echo "<h3>Testing FileUpload command...</h3>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload'])) {
    echo "<p>File received: " . htmlspecialchars($_FILES['upload']['name']) . "</p>";
    echo "<p>Size: " . $_FILES['upload']['size'] . " bytes</p>";
    echo "<p>Type: " . $_FILES['upload']['type'] . "</p>";
    echo "<p>Error: " . $_FILES['upload']['error'] . "</p>";

    // Try handling via CKFinder
    $_GET['command'] = 'FileUpload';
    $_GET['type'] = 'Images';
    $_GET['currentFolder'] = '/';
    $_REQUEST['command'] = 'FileUpload';
    $_REQUEST['type'] = 'Images';
    $_REQUEST['currentFolder'] = '/';

    try {
        $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
        echo "<p>Request method: " . $request->getMethod() . "</p>";
        echo "<p>Request has files: " . ($request->files->count() > 0 ? 'YES (' . $request->files->count() . ')' : 'NO') . "</p>";

        $response = $ckfinder->handle($request);
        echo "<p style='color:green'>✅ FileUpload: HTTP " . $response->getStatusCode() . "</p>";
        echo "<pre>" . htmlspecialchars($response->getContent()) . "</pre>";
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ Exception: " . $e->getMessage() . "</p>";
        echo "<p>Class: " . get_class($e) . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } catch (Error $e) {
        echo "<p style='color:red'>❌ Fatal: " . $e->getMessage() . " in " . basename($e->getFile()) . ":" . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    // Show upload form
    echo '<form method="post" enctype="multipart/form-data">';
    echo '<p>Select an image to test CKFinder upload:</p>';
    echo '<input type="file" name="upload" accept="image/*"> ';
    echo '<button type="submit" style="padding:8px 16px;background:green;color:white;border:none;cursor:pointer">Test FileUpload</button>';
    echo '</form>';

    // Also test what happens with an empty POST
    echo "<h3>Testing empty POST to connector (simulating upload check)...</h3>";

    // Use internal HTTP request
    $connectorUrl = 'https://www.cic.com.vn/libraries/ckeditor/plugins/ckfinder/core/connector/php/connector.php';

    // Simulate the request locally
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_GET['command'] = 'FileUpload';
    $_GET['type'] = 'Images';
    $_GET['currentFolder'] = '/';

    try {
        $request = Symfony\Component\HttpFoundation\Request::create(
            '/connector.php?command=FileUpload&type=Images&currentFolder=/',
            'POST'
        );

        // Boot and handle
        $ckfinder2 = new CKSource\CKFinder\CKFinder($configFile);
        $response = $ckfinder2->handle($request);
        echo "<p>Empty POST response: HTTP " . $response->getStatusCode() . "</p>";
        echo "<pre>" . htmlspecialchars($response->getContent()) . "</pre>";
    } catch (Exception $e) {
        echo "<p style='color:red'>❌ POST Exception: " . $e->getMessage() . "</p>";
        echo "<p>Class: " . get_class($e) . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    } catch (Error $e) {
        echo "<p style='color:red'>❌ POST Fatal: " . $e->getMessage() . " in " . basename($e->getFile()) . ":" . $e->getLine() . "</p>";
        echo "<pre>" . $e->getTraceAsString() . "</pre>";
    }
}
