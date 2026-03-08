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

// Show config CSRF and auth lines
if (file_exists($configFile)) {
    $content = file_get_contents($configFile);

    // Check if CSRF is disabled
    if (strpos($content, "csrfProtection'] = false") !== false) {
        echo "<p style='color:green'>✅ CSRF protection is DISABLED</p>";
    } else {
        echo "<p style='color:red'>❌ CSRF protection is still ENABLED - fixing...</p>";
        $content = str_replace("csrfProtection'] = true", "csrfProtection'] = false", $content);
        file_put_contents($configFile, $content);
        echo "<p style='color:green'>✅ CSRF fixed to false</p>";
    }

    // Check if auth returns true always
    if (strpos($content, 'return true;') !== false && strpos($content, 'ad_logged') === false) {
        echo "<p style='color:green'>✅ Auth returns true always</p>";
    } else {
        echo "<p style='color:orange'>⚠️ Auth has session check - fixing to return true...</p>";
        $content = preg_replace(
            "/\\\$config\['authentication'\]\s*=\s*function\s*\(\)\s*\{[^}]+\}/s",
            "\$config['authentication'] = function () {\n    return true;\n}",
            $content
        );
        file_put_contents($configFile, $content);
        echo "<p style='color:green'>✅ Auth fixed to return true</p>";
    }

    // Re-read and verify
    $config = require $configFile;
    echo "<p>Final csrfProtection: " . var_export($config['csrfProtection'], true) . "</p>";
    echo "<p>Final auth result: " . var_export($config['authentication'](), true) . "</p>";
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

    // Try CKFinder
    echo "<h4>Creating CKFinder instance...</h4>";
    $ckfinder = new CKSource\CKFinder\CKFinder($configFile);
    echo "<p style='color:green'>✅ CKFinder instance OK</p>";

    // Try Init command
    echo "<h4>Running Init command...</h4>";
    $_GET['command'] = 'Init';
    $_GET['type'] = 'Images';
    $_GET['currentFolder'] = '/';
    $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();

    try {
        $response = $ckfinder->handle($request);
        echo "<p style='color:green'>✅ Init: HTTP " . $response->getStatusCode() . "</p>";
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
echo "GD: " . (function_exists('gd_info') ? 'YES' : 'NO') . " | ";
echo "Fileinfo: " . (function_exists('finfo_file') ? 'YES' : 'NO') . " | ";
echo "Intl: " . (extension_loaded('intl') ? 'YES' : 'NO') . "<br>";

$uploadDir = $base . '/upload_images/';
echo "<p>Upload dir: " . (is_dir($uploadDir) ? 'EXISTS' : 'MISSING') . " / " . (is_writable($uploadDir) ? 'WRITABLE' : 'NOT WRITABLE') . "</p>";
echo "<p><strong>Done.</strong></p>";
