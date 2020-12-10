<?php

require __DIR__.'/../vendor/autoload.php';

use awheel\md52url\md52url;
use awheel\OSSUpload\OSSUpload;

$bucket = '__BUCKET_NAME__';
$accessKeyId = '__ACCESS_KEY_ID__';
$accessKeySecret = '__ACCESS_KEY_SECRET__';
$endpoint = '__ENDPOINT__';
$domains = array(
    'http://img1.example.com',
    'http://img2.example.com',
    'http://img3.example.com',
    'http://img4.example.com'
);
$pathPrefix = '/testupload';

$upload = new OSSUpload($bucket, $accessKeyId, $accessKeySecret, $endpoint, $pathPrefix);
$md5 = $upload->upload('./test.txt');
$path = $upload->upload('./test.txt', true);
$md52url = new md52url($domains, $pathPrefix);
$url = $md52url->url($md5);

echo $md5.PHP_EOL;
echo $path.PHP_EOL;
echo $url.PHP_EOL;

/**
dd18bf3a8e0a2a3e53e2661c7fb53534010
/testupload/dd/18/bf/dd18bf3a8e0a2a3e53e2661c7fb53534010.txt
http://http://img1.example.com/testupload/dd/18/bf/dd18bf3a8e0a2a3e53e2661c7fb53534010.txt
 */
