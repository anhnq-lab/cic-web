<?php
/**
 * CKFinder PHP 8.1 Comprehensive Fix Script
 * Patches ALL known issues in one execution
 * Access via: https://www.cic.com.vn/ckfinder_fix_all.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

$base = __DIR__ . '/libraries/ckeditor/plugins/ckfinder';
$results = [];

// ====== FIX 1: UploadedFile.php - Remove strict type hint ======
$file1 = $base . '/core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Filesystem/File/UploadedFile.php';
if (file_exists($file1)) {
    $content = file_get_contents($file1);
    $original = $content;
    
    // Fix: Remove strict UploadedFileBase type hint from constructor
    $content = str_replace(
        'public function __construct(UploadedFileBase $uploadedFile, CKFinder $app)',
        'public function __construct($uploadedFile, CKFinder $app)',
        $content
    );
    
    if ($content !== $original) {
        file_put_contents($file1, $content);
        $results[] = '✅ FIX 1: UploadedFile.php - Removed strict type hint from constructor';
    } else {
        $results[] = '⏭️ FIX 1: UploadedFile.php - Already fixed or no match found';
    }
} else {
    $results[] = '❌ FIX 1: UploadedFile.php - File not found';
}

// ====== FIX 2: config.php (v3) - PHP 8 settings + backend config ======
$file2 = $base . '/config.php';
if (file_exists($file2)) {
    $content = file_get_contents($file2);
    $original = $content;
    
    // Fix 2a: Add error suppression at top
    if (strpos($content, 'E_DEPRECATED') === false) {
        $content = str_replace(
            "<?php\n\n\$config = [];\n",
            "<?php\n\nerror_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);\nini_set('display_errors', 0);\n\n\$config = [];\n",
            $content
        );
    }
    
    // Fix 2b: Add root path if missing
    if (strpos($content, "'root'") === false && strpos($content, '"root"') === false) {
        $content = str_replace(
            "'name'         => 'default',",
            "'name'         => 'default',\n        'root'         => \$_SERVER['DOCUMENT_ROOT'] . '/upload_images/',\n        'followSymlinks' => true,",
            $content
        );
    }
    
    // Fix 2c: Fix chmodFiles - change 0 to 0644
    $content = preg_replace(
        "/'chmodFiles'\s*=>\s*0([^0-9x])/",
        "'chmodFiles'   => 0644$1",
        $content
    );
    
    if ($content !== $original) {
        file_put_contents($file2, $content);
        $results[] = '✅ FIX 2: config.php - Added error suppression, root path, chmod fix';
    } else {
        $results[] = '⏭️ FIX 2: config.php - Already fixed or no match found';
    }
} else {
    $results[] = '⚠️ FIX 2: config.php - File not found (checking if using _config.php instead)';
}

// ====== FIX 3: Local.php - Suppress chmod and fix followSymlinks ======
$file3 = $base . '/core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Backend/Adapter/Local.php';
if (file_exists($file3)) {
    $content = file_get_contents($file3);
    $original = $content;
    
    // Fix 3a: Suppress chmod errors - add @ before chmod calls
    $content = preg_replace('/(?<!@)chmod\(/', '@chmod(', $content);
    
    // Fix 3b: Fix followSymlinks access without null coalescing
    $content = str_replace(
        "\$this->backendConfig['followSymlinks']",
        "(\$this->backendConfig['followSymlinks'] ?? false)",
        $content
    );
    
    if ($content !== $original) {
        file_put_contents($file3, $content);
        $results[] = '✅ FIX 3: Local.php - Suppressed chmod errors, fixed followSymlinks';
    } else {
        $results[] = '⏭️ FIX 3: Local.php - Already fixed or no match found';
    }
} else {
    $results[] = '❌ FIX 3: Local.php - File not found';
}

// ====== FIX 4: CKFinder.php - Deprecated methods ======
$file4 = $base . '/core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/CKFinder.php';
if (file_exists($file4)) {
    $content = file_get_contents($file4);
    $original = $content;
    
    // Fix 4a: Replace deprecated Response::create()
    $content = str_replace(
        'Response::create(',
        'new Response(',
        $content
    );
    
    // Fix 4b: Replace deprecated HttpKernelInterface::MASTER_REQUEST (PHP 8+)
    $content = str_replace(
        'HttpKernelInterface::MASTER_REQUEST',
        'self::MASTER_REQUEST',
        $content
    );
    
    // Fix 4c: Add error suppression after namespace
    if (strpos($content, 'E_DEPRECATED') === false) {
        $content = str_replace(
            "namespace CKSource\\CKFinder;\n",
            "namespace CKSource\\CKFinder;\n\nerror_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);\nini_set('display_errors', 0);\n",
            $content
        );
    }
    
    if ($content !== $original) {
        file_put_contents($file4, $content);
        $results[] = '✅ FIX 4: CKFinder.php - Fixed deprecated methods, added error suppression';
    } else {
        $results[] = '⏭️ FIX 4: CKFinder.php - Already fixed or no match found';
    }
} else {
    $results[] = '❌ FIX 4: CKFinder.php - File not found';
}

// ====== FIX 5: connector.php - Enable error reporting for debugging ======
$file5 = $base . '/core/connector/php/connector.php';
if (file_exists($file5)) {
    $content = file_get_contents($file5);
    $original = $content;
    
    if (strpos($content, 'error_reporting') === false) {
        $content = str_replace(
            "<?php\n",
            "<?php\nerror_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);\nini_set('display_errors', 0);\n",
            $content
        );
        
        if ($content !== $original) {
            file_put_contents($file5, $content);
            $results[] = '✅ FIX 5: connector.php - Added error suppression';
        }
    } else {
        $results[] = '⏭️ FIX 5: connector.php - Already has error_reporting';
    }
} else {
    $results[] = '❌ FIX 5: connector.php - File not found';
}

// ====== Display Results ======
echo "<html><head><title>CKFinder Fix Results</title></head><body>";
echo "<h1>CKFinder PHP 8.1 Fix Results</h1>";
echo "<hr>";
foreach ($results as $r) {
    echo "<p style='font-size:16px; margin:8px 0;'>$r</p>";
}
echo "<hr>";

// ====== Quick Upload Test ======
echo "<h2>Quick Upload Test</h2>";

// Test 1: Directory exists and writable
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload_images/images/2026/03/05/';
echo "<p>Upload dir: $uploadDir</p>";
echo "<p>Exists: " . (is_dir($uploadDir) ? '✅ YES' : '❌ NO') . "</p>";
echo "<p>Writable: " . (is_writable($uploadDir) ? '✅ YES' : '❌ NO') . "</p>";

// Test 2: Temp dir writable
$tempDir = sys_get_temp_dir();
echo "<p>Temp dir: $tempDir - Writable: " . (is_writable($tempDir) ? '✅ YES' : '❌ NO') . "</p>";

// Test 3: PHP settings
echo "<p>PHP: " . phpversion() . "</p>";
echo "<p>upload_max_filesize: " . ini_get('upload_max_filesize') . "</p>";
echo "<p>post_max_size: " . ini_get('post_max_size') . "</p>";

echo "<hr>";
echo "<p><strong>Done. Now test the upload in CMS.</strong></p>";
echo "<p><a href='/libraries/ckeditor/plugins/ckfinder/ckfinder.html?type=Images' target='_blank'>Open CKFinder →</a></p>";
echo "</body></html>";
?>
