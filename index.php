<?php
// Đọc nội dung của file keylog.php
$file = 'api/keylog.php';

if (file_exists($file)) {
    // Lấy nội dung của file
    $content = file_get_contents($file);
    
    // Thay thế các ký tự đặc biệt để hiển thị đúng
    echo '<pre>' . htmlspecialchars($content) . '</pre>';
} else {
    echo "File không tồn tại.";
}
?>
