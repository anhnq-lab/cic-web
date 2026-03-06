<?php
/**
 * CIC Website - SEO Spam Scanner & Cleanup Tool
 * Quét và dọn dẹp các trang spam SEO trên website
 * 
 * CÁCH SỬ DỤNG: 
 * 1. Upload file này lên server
 * 2. Truy cập: https://www.cic.com.vn/cic_spam_cleanup.php?key=CIC_SCAN_2026
 * 3. Sau khi hoàn tất, XÓA file này khỏi server
 */

$secret_key = 'CIC_SCAN_2026';
if (!isset($_GET['key']) || $_GET['key'] !== $secret_key) {
    http_response_code(404);
    die('Not Found');
}

ini_set('max_execution_time', 300);
ini_set('memory_limit', '256M');
error_reporting(E_ALL);

$base_path = __DIR__;
$results = [];
$suspicious_files = [];
$spam_in_db = [];

// ============================================================
// 1. QUÉT CÁC THƯ MỤC SPAM ĐÃ BIẾT
// ============================================================
$spam_directories = [
    '/android/',
    '/vi/dica/',
    '/vi/vidica/',
    '/wp-content/',
    '/wp-admin/',
    '/wp-includes/',
];

echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>CIC Spam Scanner</title>';
echo '<style>
body { font-family: Arial, sans-serif; max-width: 1200px; margin: 20px auto; padding: 0 20px; background: #f5f5f5; }
h1 { color: #c0392b; }
h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px; }
.section { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
.danger { color: #c0392b; background: #fdf2f2; padding: 10px; border-left: 4px solid #c0392b; margin: 5px 0; }
.warning { color: #e67e22; background: #fef9e7; padding: 10px; border-left: 4px solid #e67e22; margin: 5px 0; }
.success { color: #27ae60; background: #eafaf1; padding: 10px; border-left: 4px solid #27ae60; margin: 5px 0; }
.info { color: #2980b9; background: #ebf5fb; padding: 10px; border-left: 4px solid #2980b9; margin: 5px 0; }
pre { background: #2c3e50; color: #ecf0f1; padding: 15px; border-radius: 5px; overflow-x: auto; font-size: 12px; }
table { width: 100%; border-collapse: collapse; }
table th, table td { padding: 8px 12px; border: 1px solid #ddd; text-align: left; }
table th { background: #3498db; color: white; }
table tr:nth-child(even) { background: #f2f2f2; }
.file-path { font-family: monospace; font-size: 12px; word-break: break-all; }
</style></head><body>';

echo '<h1>🔍 CIC Website - SEO Spam Scanner</h1>';
echo '<div class="info">Thời gian quét: ' . date('Y-m-d H:i:s') . '</div>';

// ============================================================
// BƯỚC 1: Kiểm tra thư mục spam
// ============================================================
echo '<div class="section" style="display:none"><h2>📁 Bước 1: Kiểm tra thư mục spam đã biết</h2>';
foreach ($spam_directories as $dir) {
    $full_path = $base_path . str_replace('/', DIRECTORY_SEPARATOR, $dir);
    if (is_dir($full_path)) {
        echo '<div class="danger">⚠️ <strong>TÌM THẤY:</strong> ' . htmlspecialchars($dir) . '</div>';
    } else {
        echo '<div class="success">✅ Không tìm thấy: ' . htmlspecialchars($dir) . '</div>';
    }
}
echo '</div>';

// ============================================================
// BƯỚC 4: Kiểm tra database tìm nội dung spam
// ============================================================
echo '<div class="section"><h2>🗄️ Bước 4: Kiểm tra database tìm nội dung spam (CẬP NHẬT MỚI)</h2>';

try {
    if (file_exists($base_path . '/includes/config.php')) {
        // Gọi file config vào để lấy biến mảng $db_info
        include $base_path . '/includes/config.php';
        
        if (isset($db_info) && is_array($db_info)) {
            $host = $db_info['dbHost'] ?? 'localhost';
            $dbname = $db_info['dbName'] ?? '';
            $user = $db_info['dbUser'] ?? '';
            $pass = $db_info['dbPass'] ?? '';
            
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
            $spam_keywords = ['bongdatv', 'cofico', 'cá cược', 'xổ số', 'casino', 'baccarat', 'nhà cái', 'slot game', 'roulette'];
            $spam_found_in_db = [];
            
            foreach ($tables as $table) {
                // Bỏ qua các bảng hệ thống hoặc log
                if (stripos($table, 'log') !== false || stripos($table, 'session') !== false) {
                    continue; // Có thể bật lại nếu muốn tìm sâu hơn
                }

                $columns = $pdo->query("DESCRIBE `$table`")->fetchAll(PDO::FETCH_ASSOC);
                $text_columns = [];
                foreach ($columns as $col) {
                    if (preg_match('/text|varchar|char|blob|longtext|mediumtext/i', $col['Type'])) {
                        $text_columns[] = $col['Field'];
                    }
                }
                
                if (empty($text_columns)) continue;
                
                foreach ($spam_keywords as $keyword) {
                    // Cần ghép các lệnh OR nhau thay vì duyệt từng cột (tối ưu tốc độ)
                    // Do PHP memory có hạn, tôi dùng cách gộp cột
                    $where_clauses = [];
                    foreach ($text_columns as $col) {
                         $where_clauses[] = "`$col` LIKE '%$keyword%'";
                    }
                    $where_sql = implode(' OR ', $where_clauses);
                    
                    try {
                        $stmt = $pdo->prepare("SELECT COUNT(*) as cnt FROM `$table` WHERE $where_sql");
                        $stmt->execute();
                        $count = $stmt->fetch(PDO::FETCH_ASSOC)['cnt'];
                        if ($count > 0) {
                            $spam_found_in_db[] = [
                                'table' => $table,
                                'keyword' => $keyword,
                                'count' => $count,
                            ];
                        }
                    } catch (Exception $e) { }
                }
            }
            
            if (!empty($spam_found_in_db)) {
                echo '<div class="danger" style="font-size: 18px;">⚠️ <strong>BÁO ĐỘNG ĐỎ: TÌM THẤY NỘI DUNG SPAM TRONG DATABASE!</strong></div>';
                echo '<p>Hacker đã chèn các bài viết spam thẳng vào cơ sở dữ liệu của bạn, đây là lý do Google Index được các bài rác này.</p>';
                echo '<table><tr><th>Tên Bảng (Table)</th><th>Từ khóa spam chèn vào</th><th>Số bài bị chèn</th></tr>';
                foreach ($spam_found_in_db as $item) {
                    echo '<tr>';
                    echo '<td><b style="color:#d35400;">' . htmlspecialchars($item['table']) . '</b></td>';
                    echo '<td><code>' . htmlspecialchars($item['keyword']) . '</code></td>';
                    echo '<td>' . $item['count'] . ' bản ghi</td>';
                    echo '</tr>';
                }
                echo '</table>';
                
                echo '<h3 style="color:red; margin-top:20px;">Làm sao để dọn dẹp Database?</h3>';
                echo '<ul>
                    <li>Bạn cần đăng nhập vào phpMyAdmin (trên Plesk -> Databases -> phpMyAdmin).</li>
                    <li>Mở lần lượt các Table được in đậm màu đỏ phía trên.</li>
                    <li>Sắp xếp cột Thời gian (Created/Modified) hoặc tìm kiếm theo từ khóa đã phát hiện.</li>
                    <li>Xóa TOÀN BỘ các dòng rác đó.</li>
                </ul>';
            } else {
                echo '<div class="success">✅ Không tìm thấy nội dung bài viết rác nào trong Database (CSDL sạch sẽ).</div>';
            }
        } else {
            echo '<div class="warning">⚠️ Không đọc được biến $db_info trong config.</div>';
        }
    } else {
        echo '<div class="warning">⚠️ Không tìm thấy file includes/config.php</div>';
    }
} catch (Exception $e) {
    echo '<div class="danger">⚠️ Lỗi kết nối Database: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
echo '</div>';

echo '</body></html>';
