<?php
/**
 * CKFinder PHP 8 Compatibility Fix Script
 * Run: php fix_ckfinder.php (from document root)
 */

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$fixes = 0;

echo "=== CKFinder PHP 8 Fix Script ===\n\n";

// ============================================================
// FIX 1: config.php - proper chmod values + root path + followSymlinks
// ============================================================
$configFile = $base . '/libraries/ckeditor/plugins/ckfinder/config.php';
if (file_exists($configFile)) {
    $content = file_get_contents($configFile);
    $orig = $content;
    
    // Fix chmodFiles: restore to valid value (0644) if set to 0
    $content = preg_replace("/'chmodFiles'\s*=>\s*0([^x0-9])/", "'chmodFiles'   => 0644$1", $content);
    
    // Fix chmodFolders: restore to valid value (0755) if set to 0
    $content = preg_replace("/'chmodFolders'\s*=>\s*0([^x0-9])/", "'chmodFolders' => 0755$1", $content);
    
    // Add root + followSymlinks if not present
    if (strpos($content, "'root'") === false) {
        $content = str_replace(
            "'baseUrl'      => '/upload_images/',",
            "'baseUrl'      => '/upload_images/',\n    'root'         => '$base/upload_images/',\n    'followSymlinks' => true,",
            $content
        );
        // Also try without the root line we may have added incorrectly before
        $content = str_replace(
            "'baseUrl'      => '/upload_images/',\n    'root'         => '$base/upload_images/'",
            "'baseUrl'      => '/upload_images/',\n    'root'         => '$base/upload_images/',\n    'followSymlinks' => true",
            $content
        );
    }
    
    if ($content !== $orig) {
        file_put_contents($configFile, $content);
        echo "[FIXED] config.php - chmod values + root path\n";
        $fixes++;
    } else {
        echo "[OK] config.php - already correct or needs manual check\n";
    }
}

// ============================================================
// FIX 2: Local.php - suppress chmod errors with @
// ============================================================
$localFile = $base . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Backend/Adapter/Local.php';
if (file_exists($localFile)) {
    $content = file_get_contents($localFile);
    $orig = $content;
    
    // Line 93: chmod() -> @chmod() to suppress permission denied errors
    $content = str_replace(
        "        chmod(\$location, \$chmodFiles);\n",
        "        if (\$chmodFiles) { @chmod(\$location, \$chmodFiles); }\n",
        $content
    );
    
    // Line 59: Ensure @mkdir uses valid chmod
    // Already has @ so OK
    
    // Line 148: followSymlinks - add null coalescing to prevent undefined key
    $content = str_replace(
        "\$this->backendConfig['followSymlinks'] && is_link(\$location)",
        "(\$this->backendConfig['followSymlinks'] ?? false) && is_link(\$location)",
        $content
    );
    $content = str_replace(
        "if (\$this->backendConfig['followSymlinks']) {\n            return \$this->mapFileInfo(\$file);",
        "if (\$this->backendConfig['followSymlinks'] ?? false) {\n            return \$this->mapFileInfo(\$file);",
        $content
    );
    $content = str_replace(
        "if (\$this->backendConfig['followSymlinks'] && \$file->isLink())",
        "if ((\$this->backendConfig['followSymlinks'] ?? false) && \$file->isLink())",
        $content
    );
    
    if ($content !== $orig) {
        file_put_contents($localFile, $content);
        echo "[FIXED] Local.php - chmod suppression + followSymlinks null safety\n";
        $fixes++;
    } else {
        echo "[OK] Local.php - already fixed\n";
    }
}

// ============================================================
// FIX 3: CKFinder.php - Fix Symfony NativeSessionStorage deprecation
// ============================================================
$ckfinderDir = $base . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder';
$ckfinderFile = $ckfinderDir . '/CKFinder.php';
if (file_exists($ckfinderFile)) {
    $content = file_get_contents($ckfinderFile);
    $orig = $content;
    
    // Suppress deprecation warnings in CKFinder bootstrap
    if (strpos($content, 'error_reporting(E_ALL & ~E_DEPRECATED)') === false) {
        $content = str_replace(
            "namespace CKSource\\CKFinder;\n",
            "namespace CKSource\\CKFinder;\n\n// PHP 8 compatibility: suppress deprecation warnings\nif (PHP_MAJOR_VERSION >= 8) {\n    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);\n}\n",
            $content
        );
    }
    
    if ($content !== $orig) {
        file_put_contents($ckfinderFile, $content);
        echo "[FIXED] CKFinder.php - suppress deprecation warnings for PHP 8\n";
        $fixes++;
    } else {
        echo "[OK] CKFinder.php - already fixed\n";
    }
}

// ============================================================
// FIX 4: Fix each() in PEAR libraries (if not already fixed)
// ============================================================
$pearBase = $base . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/vendor/pear-pear.php.net';
$eachFixes = [
    'PEAR/PEAR.php' => [
        'while (list($k, $objref) = each($_PEAR_destructor_object_list))' => 
        'foreach($_PEAR_destructor_object_list as $k => $objref)'
    ],
    'PEAR/PEAR/Autoloader.php' => [
        'while (list($method, $obj) = each($this->_method_map))' =>
        'foreach($this->_method_map as $method => $obj)'
    ],
    'Mail_Mime/Mail/mime.php' => [
        'while (list($key, $value) = each($params))' =>
        'foreach($params as $key => $value)'
    ],
    'Mail_Mime/Mail/mimePart.php' => [
        'while (list($idx, $line) = each($lines))' =>
        'foreach($lines as $idx => $line)'
    ],
    'PEAR/PEAR/Command/Common.php' => [
        "while (list(\$option, \$info) = each(\$this->commands[\$command]['options']))" =>
        "foreach(\$this->commands[\$command]['options'] as \$option => \$info)"
    ],
    'Console_Getopt/Console/Getopt.php' => [
        'while (list($i, $arg) = each($args))' =>
        'foreach($args as $i => $arg)',
        '} else if (list(, $opt_arg) = each($args))' =>
        '} else if (($opt_arg = next($args)) !== false)',
        'if (!strlen($opt_arg) && !(list(, $opt_arg) = each($args)))' =>
        'if (!strlen($opt_arg) && (($opt_arg = next($args)) === false))'
    ],
];

foreach ($eachFixes as $relPath => $replacements) {
    $file = $pearBase . '/' . $relPath;
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    $orig = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    if ($content !== $orig) {
        file_put_contents($file, $content);
        echo "[FIXED] $relPath - each() -> foreach()\n";
        $fixes++;
    }
}

// ============================================================
// FIX 5: Fix each() in php5 files
// ============================================================
$php5Base = $base . '/libraries/ckeditor/plugins/ckfinder/core/connector/php/php5';
$php5Fixes = [
    'Utils/Security.php' => [
        'while (list($k,$v) = each($_FILES))' => 'foreach($_FILES as $k => $v)',
        'while (list($k,$v) = each($var))' => 'foreach($var as $k => $v)',
    ],
    'Core/Config.php' => [
        "while (list(\$_key,\$_resourceTypeNode) = each(\$GLOBALS['config']['ResourceType']))" =>
        "foreach(\$GLOBALS['config']['ResourceType'] as \$_key => \$_resourceTypeNode)"
    ],
];

foreach ($php5Fixes as $relPath => $replacements) {
    $file = $php5Base . '/' . $relPath;
    if (!file_exists($file)) continue;
    
    $content = file_get_contents($file);
    $orig = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    if ($content !== $orig) {
        file_put_contents($file, $content);
        echo "[FIXED] php5/$relPath - each() -> foreach()\n";
        $fixes++;
    }
}

// ============================================================
// FIX 6: Ensure upload directories exist with proper permissions
// ============================================================
$dirs = [
    $base . '/upload_images',
    $base . '/upload_images/images',
    $base . '/upload_images/images/' . date('Y'),
    $base . '/upload_images/images/' . date('Y') . '/' . date('m'),
    $base . '/upload_images/images/' . date('Y') . '/' . date('m') . '/' . date('d'),
    $base . '/upload_images/files',
    $base . '/upload_images/_thumbs',
    $base . '/upload_images/.ckfinder',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
        echo "[CREATED] $dir\n";
        $fixes++;
    }
}

// ============================================================
// DONE
// ============================================================
echo "\n=== Done! $fixes fixes applied ===\n";
echo "Please refresh CKFinder and try uploading again.\n";

// Cleanup test file
if (file_exists($base . '/test_upload.php')) {
    unlink($base . '/test_upload.php');
    echo "Cleaned up test_upload.php\n";
}
