<?php
$laravelBase = 'http://172.22.64.11/49_modelchange/49_mdlchn_api/session/user';
$frontendBase = 'http://172.22.64.11/49_modelchange/49_frontend';
$laravelSessionCookieName = 'laravel_session';

$hasLaravelCookie = isset($_COOKIE[$laravelSessionCookieName]) && !empty($_COOKIE[$laravelSessionCookieName]);

if (!$hasLaravelCookie) {
    $qs = $_GET;
    $qs['return_url'] = $frontendBase; // ❌ ไม่ต้องมี /
    header("Location: " . $laravelBase . "?" . http_build_query($qs));
    exit;
}

$indexFile = __DIR__ . '/dist/index.html';
if (file_exists($indexFile)) {
    header('Content-Type: text/html; charset=UTF-8');
    $html = file_get_contents($indexFile);

    $faviconUrl = $frontendBase . '/public/Model Change v3.png';
    $customTitle = 'Model Change System';
    $html = preg_replace(
        '/<head(.*?)>/i',
        '<head$1>' . PHP_EOL .
            '    <title>' . htmlspecialchars($customTitle) . '</title>' . PHP_EOL .
            '    <link rel="icon" type="image/x-icon" href="' . htmlspecialchars($faviconUrl) . '">' . PHP_EOL,
        $html
    );

    echo $html;
    exit;
}

http_response_code(404);
echo "Nuxt build not found.";
