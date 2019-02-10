<?php

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {   
    echo json_encode(['error' => 'Only ajax allowed']);
    exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/autoload.php';

use Classes\DbClass as DbClass, Classes\BannerClass as BannerClass, Classes\BannerMapperClass as BannerMapperClass;

$requestedUrl = trim(htmlentities($_POST['path']));
$db = new DbClass('mysql:host=localhost;dbname=banner;charset=utf8', 'root', '');
$banner = new BannerClass($_SERVER, $requestedUrl);
$bannerMapper = new BannerMapperClass($db, $banner);
$response = $bannerMapper->insertOrUpdate();

if (!empty($response)) {
    return json_encode(['success' => 'view recorded']);
}

return json_encode(['error' => 'something was wrong']);