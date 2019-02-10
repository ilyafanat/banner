<?php

namespace Classes;

class BannerClass
{
    public $ipAddress;
    public $userAgent;
    public $pageUrl;

    function __construct($serverArgs, $requestedUrl)
    {
        $this->db = $db;
        $this->ipAddress = ip2long($serverArgs['REMOTE_ADDR']);
        $this->userAgent = $serverArgs['HTTP_USER_AGENT'];
        $this->pageUrl = $requestedUrl;
    }
}

