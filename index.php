<?php
// frontend/index.php
// Loader สำหรับ Nuxt SPA - forward params ไป Laravel เพื่อให้ browser ได้ cookie session

$laravelBase = 'http://172.22.64.11/49_modelchange/49_mdlchn_api/api/session/user';

$frontendBase = 'http://web-server/49_modelchange/frontend/';

// ชื่อ cookie Laravel
$laravelSessionCookieName = 'laravel_session';

// ตรวจว่ามี empno (หรือพารามิเตอร์ login) ใน query string
$hasLoginParams = isset($_GET['empno']) && !empty($_GET['empno']);
$hasLaravelCookie = isset($_COOKIE[$laravelSessionCookieName]) && !empty($_COOKIE[$laravelSessionCookieName]);

if ($hasLoginParams && !$hasLaravelCookie) {
    // เตรียม query string ส่งไป Laravel
    $allowedKeys = ['username', 'empno', 'department', 'USE_PERMISSION', 'sec', 'MSECT_ID', 'timestamp', 'signature'];
    $qs = [];
    foreach ($allowedKeys as $k) {
        if (isset($_GET[$k])) {
            $qs[$k] = $_GET[$k];
        }
    }
    // return_url เพื่อ Laravel redirect กลับ SPA
    $qs['return_url'] = $frontendBase;

    // ใช้ GET ผ่าน CURL
    $url = $laravelBase . '?' . http_build_query($qs);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $response = curl_exec($ch);

    // แยก header และ body
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    curl_close($ch);

    // ส่ง Set-Cookie ที่ Laravel ส่งกลับ browser
    if (preg_match_all('/Set-Cookie:\s*([^;]*)/mi', $header, $matches)) {
        foreach ($matches[1] as $cookie) {
            header('Set-Cookie: ' . trim($cookie), false);
        }
    }

    // ส่ง body กลับ browser
    header('Content-Type: text/html; charset=UTF-8');
    echo $body;
    exit;
}

// ถ้าไม่มี params หรือตรวจแล้วมี cookie ให้ serve SPA
$indexFile = __DIR__ . '/dist/index.html';
if (file_exists($indexFile)) {
    header('Content-Type: text/html; charset=UTF-8');
    readfile($indexFile);
    exit;
}

// ถ้าไม่มีไฟล์ dist
http_response_code(404);
echo "Nuxt build not found. Please run `npm run build && npm run generate` and copy dist/ to frontend/dist.";
