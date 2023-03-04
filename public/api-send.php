<?php

//require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$data = [
    'result' => 'success'
];

$url = $_POST['url'];
$action = $_POST['action'];
$type = $action == 'update' ? 'URL_UPDATED' : 'URL_DELETED';

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    $data['result'] = 'error';
    $data['error'] = 'URL не является корректным.';
    echo json_encode($data);
    exit();
}

$client = new Google_Client();
// file-containing-secret-key.json - секретный ключ для доступа к API Google
$client->setAuthConfig(public_path('/api/my-project-test.json'));
$client->addScope('https://www.googleapis.com/auth/indexing');
$httpClient = $client->authorize();
$endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';
if ($action == 'get') {
    $response = $httpClient->get('https://indexing.googleapis.com/v3/urlNotifications/metadata?url=' . urlencode($url));
} else {
    $content = json_encode([
        'url' => $url,
        'type' => $type
    ]);
    $response = $httpClient->post($endpoint, ['body' => $content]);
}

$data['body'] = (string) $response->getBody();

echo json_encode($data);
