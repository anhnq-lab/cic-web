<?php
/**
 * CKFinder Fix Script - Fix CKFinder.php + config.php + test
 * Truy cập: https://www.cic.com.vn/ckfinder_fix_all.php
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>CKFinder Fix & Debug</h2>";
echo "<p>PHP: " . PHP_VERSION . "</p>";

$base = '/var/www/vhosts/cic.com.vn/httpdocs';
$ckBase = $base . '/libraries/ckeditor/plugins/ckfinder';
$configFile = $ckBase . '/config.php';

// Git deploys repo to /httpdocs/, so repo's httpdocs/ is at /httpdocs/httpdocs/
$gitBase = $base . '/httpdocs';
$gitCkBase = $gitBase . '/libraries/ckeditor/plugins/ckfinder';

// ========== STEP 1: Fix CKFinder.php from git version ==========
echo "<h3>Step 1: Fix CKFinder vendor files</h3>";

$filesToCopy = [
    'config.js',
    'core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/CKFinder.php',
    'core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Backend/Adapter/Local.php',
    'core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Exception/InvalidCsrfTokenException.php',
    'core/connector/php/vendor/cksource/ckfinder/src/CKSource/CKFinder/Command/FileUpload.php',
];

foreach ($filesToCopy as $relPath) {
    $gitFile = $gitCkBase . '/' . $relPath;
    $serverFile = $ckBase . '/' . $relPath;

    if (file_exists($gitFile)) {
        // Backup
        if (file_exists($serverFile)) {
            copy($serverFile, $serverFile . '.bak');
        }
        copy($gitFile, $serverFile);
        echo "<p style='color:green'>✅ Copied: " . basename($relPath) . "</p>";
    } else {
        echo "<p style='color:orange'>⚠️ Git version not found: " . basename($relPath) . " - checking server version...</p>";
        if (file_exists($serverFile)) {
            echo "<p>Server file exists, showing line 275-285:</p><pre>";
            $lines = file($serverFile);
            for ($i = max(0, 275); $i < min(count($lines), 290); $i++) {
                echo ($i + 1) . ": " . htmlspecialchars($lines[$i]);
            }
            echo "</pre>";
        }
    }
}

// ========== STEP 2: Write config.php ==========
echo "<h3>Step 2: Write config.php</h3>";

$newConfig = '<?php
@session_start();

/*
 * CKFinder Configuration File
 * Fixed by ckfinder_fix_all.php
 */

// Suppress deprecation notices for PHP 8
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);
ini_set(\'display_errors\', 0);

$config = array();

// Authentication - always return true (CMS handles its own auth)
$config[\'authentication\'] = function () {
    return true;
};

// License
$config[\'licenseName\'] = $_SERVER[\'HTTP_HOST\'];
$config[\'licenseKey\']  = \'*V?X-*1**-7**Z-*8**-*4**-1*W*-2**F\';

// Private directory
$config[\'privateDir\'] = array(
    \'backend\' => \'default\',
    \'tags\'   => \'.ckfinder/tags\',
    \'logs\'   => \'.ckfinder/logs\',
    \'cache\'  => \'.ckfinder/cache\',
    \'thumbs\' => \'.ckfinder/cache/thumbs\',
);

// Images
$config[\'images\'] = array(
    \'maxWidth\'  => 1600,
    \'maxHeight\' => 9200,
    \'quality\'   => 80,
    \'sizes\' => array(
        \'small\'  => array(\'width\' => 480, \'height\' => 320, \'quality\' => 80),
        \'medium\' => array(\'width\' => 600, \'height\' => 480, \'quality\' => 80),
        \'large\'  => array(\'width\' => 800, \'height\' => 600, \'quality\' => 80)
    )
);

// Backend
$config[\'backends\'][] = array(
    \'name\'         => \'default\',
    \'adapter\'      => \'local\',
    \'baseUrl\'      => \'/upload_images/\',
    \'root\'         => \'' . $base . '/upload_images/\',
    \'chmodFiles\'   => 0644,
    \'chmodFolders\' => 0755,
    \'filesystemEncoding\' => \'UTF-8\',
    \'followSymlinks\' => true,
);

// Resource Types
$config[\'defaultResourceTypes\'] = \'\';

$config[\'resourceTypes\'][] = array(
    \'name\'              => \'Files\',
    \'directory\'         => \'files\',
    \'maxSize\'           => 0,
    \'allowedExtensions\' => \'7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip,m4a\',
    \'deniedExtensions\'  => \'\',
    \'backend\'           => \'default\'
);

$config[\'resourceTypes\'][] = array(
    \'name\'              => \'Images\',
    \'directory\'         => \'images\',
    \'maxSize\'           => 0,
    \'allowedExtensions\' => \'bmp,gif,jpeg,jpg,png,svg\',
    \'deniedExtensions\'  => \'\',
    \'backend\'           => \'default\'
);

// Access Control
$config[\'roleSessionVar\'] = \'CKFinder_UserRole\';
$config[\'accessControl\'][] = array(
    \'role\'                => \'*\',
    \'resourceType\'        => \'*\',
    \'folder\'              => \'/\',
    \'FOLDER_VIEW\'         => true,
    \'FOLDER_CREATE\'       => true,
    \'FOLDER_RENAME\'       => true,
    \'FOLDER_DELETE\'       => true,
    \'FILE_VIEW\'           => true,
    \'FILE_CREATE\'         => true,
    \'FILE_RENAME\'         => true,
    \'FILE_DELETE\'         => true,
    \'IMAGE_RESIZE\'        => true,
    \'IMAGE_RESIZE_CUSTOM\' => true
);

// Other Settings
$config[\'overwriteOnUpload\'] = false;
$config[\'checkDoubleExtension\'] = true;
$config[\'disallowUnsafeCharacters\'] = false;
$config[\'secureImageUploads\'] = true;
$config[\'checkSizeAfterScaling\'] = true;
$config[\'htmlExtensions\'] = array(\'html\', \'htm\', \'xml\', \'js\', \'svg\');
$config[\'hideFolders\'] = array(\'.*\', \'CVS\', \'__thumbs\', \'large\', \'small\', \'resized\');
$config[\'hideFiles\'] = array(\'.*\');
$config[\'forceAscii\'] = true;
$config[\'xSendfile\'] = false;

// Debug
$config[\'debug\'] = false;

// Plugins
$config[\'pluginsDirectory\'] = __DIR__ . \'/plugins\';
$config[\'plugins\'] = array();

// Cache
$config[\'cache\'] = array(
    \'imagePreview\' => 24 * 3600,
    \'thumbnails\'   => 24 * 3600 * 365,
    \'proxyCommand\' => 0
);

// Temp
$config[\'tempDirectory\'] = sys_get_temp_dir();

// Session
$config[\'sessionWriteClose\'] = true;

// CSRF - DISABLED to fix Browse Server popup issue
$config[\'csrfProtection\'] = false;

// Headers
$config[\'headers\'] = array();

return $config;
';

// Only rewrite if needed
$currentConfig = file_exists($configFile) ? file_get_contents($configFile) : '';
if (strpos($currentConfig, 'return true') !== false && strpos($currentConfig, "csrfProtection'] = false") !== false) {
    echo "<p style='color:green'>✅ Config already correct, skipping rewrite</p>";
} else {
    if (file_exists($configFile)) {
        copy($configFile, $configFile . '.bak.' . date('YmdHis'));
    }
    file_put_contents($configFile, $newConfig);
    echo "<p style='color:green'>✅ Config.php written!</p>";
}

// ========== STEP 3: Test config ==========
echo "<h3>Step 3: Test config</h3>";
try {
    $config = require $configFile;
    echo "<p style='color:green'>✅ Config loads OK</p>";
    echo "<p>CSRF: " . var_export($config['csrfProtection'], true) . " | Auth: " . var_export($config['authentication'](), true) . "</p>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ Config error: " . $e->getMessage() . "</p>";
    die();
}

// ========== STEP 4: Test autoload ==========
echo "<h3>Step 4: Test autoload</h3>";
$autoload = $ckBase . '/core/connector/php/vendor/autoload.php';
try {
    require_once $autoload;
    echo "<p style='color:green'>✅ Autoload OK</p>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ Autoload error: " . $e->getMessage() . "</p>";
    die();
}

// ========== STEP 5: Test CKFinder ==========
echo "<h3>Step 5: Test CKFinder instance</h3>";
try {
    $ckfinder = new CKSource\CKFinder\CKFinder($configFile);
    echo "<p style='color:green'>✅ CKFinder instance OK</p>";

    // Test Init
    echo "<h3>Step 6: Test Init command</h3>";
    $_GET['command'] = 'Init';
    $_GET['type'] = 'Images';
    $_GET['currentFolder'] = '/';
    $request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
    $response = $ckfinder->handle($request);
    echo "<p style='color:green'>✅ Init: HTTP " . $response->getStatusCode() . "</p>";
    echo "<pre>" . htmlspecialchars(substr($response->getContent(), 0, 500)) . "</pre>";

} catch (Exception $e) {
    echo "<p style='color:red'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "<p style='color:red'>❌ Fatal: " . $e->getMessage() . " in " . basename($e->getFile()) . ":" . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

// Extensions check
echo "<h3>PHP Extensions</h3>";
echo "GD: " . (function_exists('gd_info') ? '✅' : '❌') . " | ";
echo "Fileinfo: " . (function_exists('finfo_file') ? '✅' : '❌') . " | ";
echo "Intl: " . (extension_loaded('intl') ? '✅' : '❌') . "<br>";

$uploadDir = $base . '/upload_images/';
echo "<p>Upload dir: " . (is_dir($uploadDir) ? '✅ EXISTS' : '❌ MISSING') . " / " . (is_writable($uploadDir) ? '✅ WRITABLE' : '❌ NOT WRITABLE') . "</p>";
echo "<hr><p><strong>Done!</strong> Nếu tất cả ✅ → thử lại Browse Server trong CMS!</p>";
