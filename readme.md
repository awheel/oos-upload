OSS Upload
====

上传文件到阿里云 OSS 的封装, 文件格式使用 [md52url](https://github.com/awheel/md52url) 规范.

## 使用方法

```

composer require awheel/oss-upload

use awheel\OSSUpload\OSSUpload;

$bucket = '__BUCKET_NAME__';
$accessKeyId = '__ACCESS_KEY_ID__';
$accessKeySecret = '__ACCESS_KEY_SECRET__';
$endpoint = '__ENDPOINT__';
$pathPrefix = '/testupload';

$upload = new OSSUpload($bucket, $accessKeyId, $accessKeySecret, $endpoint, $pathPrefix);
$md5 = $upload->upload('./test.png');
$path = $upload->upload('./test.png', true);

echo $md5.PHP_EOL;
echo $path.PHP_EOL;

```

其中bucket，accessKeyId等需要替换为真实的配置信息，详见 example/upload.php
