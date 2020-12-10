<?php

namespace awheel\OSSUpload;

use OSS\OssClient;
use awheel\md52url\md52url;
use OSS\Core\OssException;

/**
 * OSS 上传简单封装
 *
 * Class OSSUpload
 */
class OSSUpload
{
    /**
     * bucket
     *
     * @var
     */
    protected $bucket;

    /**
     * accessKeyId
     *
     * @var
     */
    protected $accessKeyId;

    /**
     * accessKeySecret
     *
     * @var
     */
    protected $accessKeySecret;

    /**
     * endpoint
     *
     * @var
     */
    protected $endpoint;

    /**
     * prefix
     *
     * @var
     */
    protected $prefix;

    /**
     * OSSUpload constructor.
     *
     * @param $bucket
     * @param $accessKeyId
     * @param $accessKeySecret
     * @param $endpoint
     * @param $prefix
     *
     * @return self
     */
    public function __construct($bucket, $accessKeyId, $accessKeySecret, $endpoint, $prefix = null)
    {
        $this->bucket = $bucket;
        $this->accessKeyId = $accessKeyId;
        $this->accessKeySecret = $accessKeySecret;
        $this->endpoint = $endpoint;
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * 上传图片, 可传入普通文件, 文件内容 buffer
     *
     * @param string $file
     * @param boolean $fullPath 是否返回文件全路径, 默认返回 md5
     * @param string $filename 用于辅助识别文件类型
     *
     * @return string md5
     * @throws OssException
     */
    public function upload($file, $fullPath = false, $filename = null)
    {
        $md52url = new md52url(array(), $this->prefix);
        $md5 = $md52url->md5($file, $filename);
        $path = $md52url->path($md5);

        $ossClient = self::getOssClient();
        $ossClient->uploadFile($this->bucket, ltrim($path, '/'), $file);

        if ($fullPath) {
            return $path;
        }

        return $md5;
    }

    /**
     * 获取 oss client
     *
     * @return OssClient
     * @throws OssException
     */
    protected function getOssClient()
    {
        return new OssClient($this->accessKeyId, $this->accessKeySecret, $this->endpoint, false);
    }
}
