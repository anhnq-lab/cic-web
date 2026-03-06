<?php
/**
 * PHP 8 Upgrade Deployment Script
 * Applies all compatibility patches automatically
 * DELETE THIS FILE AFTER RUNNING!
 */

header('Content-Type: text/html; charset=utf-8');
echo "<h1>PHP 8 Upgrade - Deployment Script</h1><pre>\n";

$root = dirname(__FILE__);
$results = [];
$errors = [];

function patch_file($filepath, $search, $replace, $description) {
    global $root, $results, $errors;
    $fullpath = $root . '/' . $filepath;
    
    if (!file_exists($fullpath)) {
        $errors[] = "❌ File not found: $filepath";
        return false;
    }
    
    $content = file_get_contents($fullpath);
    if (strpos($content, $search) === false) {
        $results[] = "⏭️ Already patched: $filepath ($description)";
        return true;
    }
    
    // Backup
    $backupDir = $root . '/php8_backup';
    if (!is_dir($backupDir)) mkdir($backupDir, 0755, true);
    $backupPath = $backupDir . '/' . str_replace(['/', '\\'], '_', $filepath);
    copy($fullpath, $backupPath);
    
    $newContent = str_replace($search, $replace, $content);
    if (file_put_contents($fullpath, $newContent) !== false) {
        $results[] = "✅ Patched: $filepath ($description)";
        return true;
    } else {
        $errors[] = "❌ Write failed: $filepath";
        return false;
    }
}

// ===== 1. CORE FRAMEWORK FIXES =====
echo "=== Phase 1: Core Framework ===\n";

// pdo.php - Fix constructor + var keyword
$pdo_file = 'libraries/database/pdo.php';
$pdo_content = file_get_contents($root . '/' . $pdo_file);
if ($pdo_content && strpos($pdo_content, 'var $host') !== false) {
    $pdo_content = str_replace('var $host', 'public $host', $pdo_content);
    $pdo_content = str_replace('var $user', 'public $user', $pdo_content);
    $pdo_content = str_replace('var $pass', 'public $pass', $pdo_content);
    $pdo_content = str_replace('var $database', 'public $database', $pdo_content);
    $pdo_content = str_replace('var $db', 'public $db', $pdo_content);
    $pdo_content = str_replace('var $query_count', 'public $query_count', $pdo_content);
    
    // Fix old-style constructor - merge FS_PDO() into __construct()
    if (strpos($pdo_content, 'function FS_PDO()') !== false) {
        // Remove the old FS_PDO() method and merge into __construct
        $pdo_content = preg_replace(
            '/function\s+FS_PDO\s*\(\)\s*\{[^}]*\}/',
            '',
            $pdo_content
        );
        // Update __construct to include the connection logic
        $pdo_content = str_replace(
            'function __construct($host, $user, $pass, $database){',
            "function __construct(\$host, \$user, \$pass, \$database){\n\t\t\$this->host = \$host;\n\t\t\$this->user = \$user;\n\t\t\$this->pass = \$pass;\n\t\t\$this->database = \$database;",
            $pdo_content
        );
    }
    
    $backupDir = $root . '/php8_backup';
    if (!is_dir($backupDir)) mkdir($backupDir, 0755, true);
    copy($root . '/' . $pdo_file, $backupDir . '/pdo.php');
    file_put_contents($root . '/' . $pdo_file, $pdo_content);
    $results[] = "✅ Patched: $pdo_file (var→public, constructor fix)";
} else {
    $results[] = "⏭️ Already patched or not found: $pdo_file";
}

// templates.php - Fix constructor + var keyword
$tpl_file = 'libraries/templates.php';
$tpl_content = file_get_contents($root . '/' . $tpl_file);
if ($tpl_content && strpos($tpl_content, 'var $dir') !== false) {
    $tpl_content = str_replace('var $dir', 'public $dir', $tpl_content);
    $tpl_content = str_replace('var $template', 'public $template', $tpl_content);
    $tpl_content = str_replace('var $tpl_vars', 'public $tpl_vars', $tpl_content);
    $tpl_content = str_replace('var $left_delimiter', 'public $left_delimiter', $tpl_content);
    $tpl_content = str_replace('var $right_delimiter', 'public $right_delimiter', $tpl_content);
    
    // Fix old-style constructor
    if (strpos($tpl_content, 'function Templates()') !== false) {
        $tpl_content = preg_replace(
            '/function\s+Templates\s*\(\)\s*\{/',
            'function __construct(){',
            $tpl_content
        );
        // Remove separate __construct that calls old constructor
        $tpl_content = preg_replace(
            '/function\s+__construct\s*\(\)\s*\{\s*\$this->Templates\(\);\s*\}/',
            '',
            $tpl_content
        );
    }
    
    copy($root . '/' . $tpl_file, $backupDir . '/templates.php');
    file_put_contents($root . '/' . $tpl_file, $tpl_content);
    $results[] = "✅ Patched: $tpl_file (var→public, constructor fix)";
} else {
    $results[] = "⏭️ Already patched or not found: $tpl_file";
}

// fsmodels.php - Fix var keyword + implode arg order
$fsm_file = 'libraries/fsmodels.php';
patch_file($fsm_file, 'var $table', 'public $table', 'var→public $table');
patch_file($fsm_file, 'var $fields', 'public $fields', 'var→public $fields');
patch_file($fsm_file, 'var $primary_key', 'public $primary_key', 'var→public $primary_key');
patch_file($fsm_file, "implode(\$fields, ',')", "implode(',', \$fields)", 'implode arg order');

echo implode("\n", $results) . "\n";
$results = [];

// ===== 2. PLUGIN FIXES =====
echo "\n=== Phase 2: Plugin Fixes ===\n";

// counter.php
patch_file('plugins/counter/counter.php',
    "mysql_real_escape_string(\$page)",
    "\$db->escape_string(\$page)",
    'mysql_real_escape_string→$db->escape_string');

// comment.php
patch_file('plugins/comments/comment.php',
    "mysql_real_escape_string(",
    "\$db->escape_string(",
    'mysql_real_escape_string→$db->escape_string');

// enterprise.php
$ent_file = 'plugins/modules/enterprises/models/enterprise.php';
$ent_content = @file_get_contents($root . '/' . $ent_file);
if ($ent_content && strpos($ent_content, 'mysql_real_escape_string') !== false) {
    copy($root . '/' . $ent_file, $backupDir . '/enterprise.php');
    $ent_content = str_replace('mysql_real_escape_string(', '$db->escape_string(', $ent_content);
    file_put_contents($root . '/' . $ent_file, $ent_content);
    $results[] = "✅ Patched: $ent_file";
} else {
    $results[] = "⏭️ Already patched: $ent_file";
}

// accessories.php
$acc_file = 'cms/modules/products/models/accessories.php';
$acc_content = @file_get_contents($root . '/' . $acc_file);
if ($acc_content && strpos($acc_content, 'mysql_real_escape_string') !== false) {
    copy($root . '/' . $acc_file, $backupDir . '/accessories.php');
    $acc_content = str_replace('mysql_real_escape_string(', '$db->escape_string(', $acc_content);
    // Remove get_magic_quotes_gpc
    $acc_content = preg_replace('/if\s*\(\s*!get_magic_quotes_gpc\s*\(\s*\)\s*\)\s*\{?\s*/', '', $acc_content);
    file_put_contents($root . '/' . $acc_file, $acc_content);
    $results[] = "✅ Patched: $acc_file";
} else {
    $results[] = "⏭️ Already patched: $acc_file";
}

echo implode("\n", $results) . "\n";
$results = [];

// ===== 3. CKFINDER PEAR VENDOR FIXES =====
echo "\n=== Phase 3: CKFinder PEAR Vendor ===\n";

$ck_dirs = ['libraries/ckeditor', 'libraries/ckeditor_'];

foreach ($ck_dirs as $ck_dir) {
    $pear_base = $ck_dir . '/plugins/ckfinder/core/connector/php/vendor/pear-pear.php.net/PEAR/PEAR';
    
    // Autoloader.php
    patch_file($pear_base . '/Autoloader.php',
        "create_function('\$a,&\$b', '\$b = strtolower(\$b);')",
        "function(\$a, &\$b) { \$b = strtolower(\$b); }",
        'create_function→closure');
    
    // Downloader.php
    patch_file($pear_base . '/Downloader.php',
        "create_function('\$a','return strtolower(\$a);')",
        "function(\$a) { return strtolower(\$a); }",
        'create_function→closure');
    
    // Command/Registry.php
    patch_file($pear_base . '/Command/Registry.php',
        "create_function('\$a',\n                                'return join(\" = \",\$a);')",
        "function(\$a) {\n                                return join(\" = \", \$a); }",
        'create_function→closure');
    
    // PackageFile/v2.php
    $v2_file = $pear_base . '/PackageFile/v2.php';
    $v2_content = @file_get_contents($root . '/' . $v2_file);
    if ($v2_content && strpos($v2_content, "create_function('&\$i, \$k'") !== false) {
        copy($root . '/' . $v2_file, $backupDir . '/' . str_replace(['/', '\\'], '_', $v2_file));
        $v2_content = str_replace(
            "create_function('&\$i, \$k', '\$i = \$i[\"handle\"];')",
            "function(&\$i, \$k) { \$i = \$i[\"handle\"]; }",
            $v2_content
        );
        file_put_contents($root . '/' . $v2_file, $v2_content);
        $results[] = "✅ Patched: $v2_file";
    } else {
        $results[] = "⏭️ Already patched: $v2_file";
    }
    
    // Registry.php
    patch_file($pear_base . '/Registry.php',
        "create_function('\$a','return !empty(\$a);')",
        "function(\$a) { return !empty(\$a); }",
        'create_function→closure');
}

echo implode("\n", $results) . "\n";

echo "\n=== DEPLOYMENT COMPLETE ===\n";
echo "Backups saved to: httpdocs/php8_backup/\n";
echo "⚠️ DELETE THIS SCRIPT (deploy_php8.php) NOW!\n";
echo "</pre>";
