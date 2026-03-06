<?php
// Temporary DB scan script - DELETE AFTER USE
header('Content-Type: text/plain; charset=utf-8');

// Use same config as the site
require_once("includes/config.php");

$conn = new mysqli($db_info['dbHost'], $db_info['dbUser'], $db_info['dbPass'], $db_info['dbName']);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "=== CIC DATABASE SPAM SCAN ===\n";
echo "Database: " . $db_info['dbName'] . "\n";
echo "Time: " . date('Y-m-d H:i:s') . "\n\n";

// 1. Show all tables
echo "--- ALL TABLES ---\n";
$result = $conn->query("SHOW TABLES");
$tables = [];
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
    echo $row[0] . "\n";
}
echo "Total: " . count($tables) . " tables\n\n";

// 2. Scan each content table for spam keywords
$spam_keywords = ['casino', 'slot', 'gambling', 'betting', 'poker', 'baccarat', 'xổ số', 'nhà cái', 'cá cược', 'xóc đĩa', 'bắn cá', 'cược', 'sòng bài'];
$content_tables = ['fs_news', 'fs_contents', 'fs_products', 'fs_services'];

echo "--- SPAM KEYWORD SCAN ---\n";
foreach ($content_tables as $table) {
    if (!in_array($table, $tables)) {
        echo "[$table] - NOT FOUND, skipping\n";
        continue;
    }
    
    // Get columns
    $cols_result = $conn->query("SHOW COLUMNS FROM $table");
    $text_cols = [];
    while ($col = $cols_result->fetch_object()) {
        if (strpos($col->Type, 'text') !== false || strpos($col->Type, 'varchar') !== false || strpos($col->Type, 'char') !== false) {
            $text_cols[] = $col->Field;
        }
    }
    
    if (empty($text_cols)) {
        echo "[$table] - No text columns\n";
        continue;
    }
    
    $where_parts = [];
    foreach ($spam_keywords as $kw) {
        foreach ($text_cols as $col) {
            $where_parts[] = "`$col` LIKE '%" . $conn->real_escape_string($kw) . "%'";
        }
    }
    
    $query = "SELECT COUNT(*) as cnt FROM $table WHERE " . implode(' OR ', $where_parts);
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_object();
        echo "[$table] Spam records found: " . $row->cnt . "\n";
        
        if ($row->cnt > 0) {
            // Show sample records
            $detail_cols = array_intersect(['id', 'title', 'name', 'alias'], $text_cols);
            $detail_cols = array_merge(['id'], $detail_cols);
            $select = implode(', ', array_unique($detail_cols));
            
            $detail_query = "SELECT $select FROM $table WHERE " . implode(' OR ', $where_parts) . " LIMIT 10";
            $detail_result = $conn->query($detail_query);
            if ($detail_result) {
                while ($drow = $detail_result->fetch_object()) {
                    echo "  ID: " . $drow->id;
                    if (isset($drow->title)) echo " | Title: " . mb_substr($drow->title, 0, 80);
                    if (isset($drow->name)) echo " | Name: " . mb_substr($drow->name, 0, 80);
                    echo "\n";
                }
            }
        }
    } else {
        echo "[$table] Query error: " . $conn->error . "\n";
    }
}

// 3. Japanese character scan
echo "\n--- JAPANESE CHARACTER SCAN ---\n";
foreach ($content_tables as $table) {
    if (!in_array($table, $tables)) continue;
    
    $cols_result = $conn->query("SHOW COLUMNS FROM $table");
    $text_cols = [];
    while ($col = $cols_result->fetch_object()) {
        if (strpos($col->Type, 'text') !== false || strpos($col->Type, 'varchar') !== false) {
            $text_cols[] = $col->Field;
        }
    }
    
    if (empty($text_cols)) continue;
    
    $jp_where = [];
    foreach ($text_cols as $col) {
        $jp_where[] = "`$col` REGEXP '[一-龥]|[ぁ-ん]|[ァ-ヶ]'";
    }
    
    $query = "SELECT COUNT(*) as cnt FROM $table WHERE " . implode(' OR ', $jp_where);
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_object();
        echo "[$table] Japanese content found: " . $row->cnt . "\n";
        
        if ($row->cnt > 0) {
            $detail_query = "SELECT id, title FROM $table WHERE " . implode(' OR ', $jp_where) . " LIMIT 5";
            $detail_result = $conn->query($detail_query);
            if ($detail_result) {
                while ($drow = $detail_result->fetch_object()) {
                    echo "  ID: " . $drow->id . " | Title: " . mb_substr($drow->title, 0, 100) . "\n";
                }
            }
        }
    }
}

// 4. Check for suspicious URLs in content
echo "\n--- SUSPICIOUS URL SCAN ---\n";
$suspicious_domains = ['bit.ly', 'tinyurl', 'goo.gl', 't.co', 'is.gd', 'clickbait', 'redirect'];
foreach (['fs_news', 'fs_contents'] as $table) {
    if (!in_array($table, $tables)) continue;
    
    $url_where = [];
    foreach ($suspicious_domains as $domain) {
        $url_where[] = "content LIKE '%" . $conn->real_escape_string($domain) . "%'";
    }
    
    $query = "SELECT COUNT(*) as cnt FROM $table WHERE " . implode(' OR ', $url_where);
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_object();
        echo "[$table] Suspicious URLs: " . $row->cnt . "\n";
    }
}

// 5. Recent records (last 30 days)
echo "\n--- RECENT RECORDS (last 30 days) ---\n";
foreach (['fs_news', 'fs_contents', 'fs_products'] as $table) {
    if (!in_array($table, $tables)) continue;
    
    $query = "SELECT COUNT(*) as cnt FROM $table WHERE created_time > DATE_SUB(NOW(), INTERVAL 30 DAY) OR edited_time > DATE_SUB(NOW(), INTERVAL 30 DAY)";
    $result = $conn->query($query);
    if ($result) {
        $row = $result->fetch_object();
        echo "[$table] Recent records: " . $row->cnt . "\n";
        
        if ($row->cnt > 0 && $row->cnt < 20) {
            $detail_query = "SELECT id, title, created_time, edited_time FROM $table WHERE created_time > DATE_SUB(NOW(), INTERVAL 30 DAY) OR edited_time > DATE_SUB(NOW(), INTERVAL 30 DAY) ORDER BY COALESCE(edited_time, created_time) DESC LIMIT 10";
            $detail_result = $conn->query($detail_query);
            if ($detail_result) {
                while ($drow = $detail_result->fetch_object()) {
                    echo "  ID: " . $drow->id . " | " . mb_substr($drow->title, 0, 60) . " | Created: " . $drow->created_time . " | Edited: " . $drow->edited_time . "\n";
                }
            }
        }
    }
}

echo "\n=== SCAN COMPLETE ===\n";
$conn->close();
?>
