<?php

$imageName = './assets/images/dog.png';
$filePath = fopen($imageName, 'rb');

header('Content-Type: image/png');
header('Content-Length: ' . filesize($imageName));

fpassthru($filePath);
exit;