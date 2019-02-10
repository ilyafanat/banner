<?php

namespace Classes;

use Classes\DbClass as DbClass, Classes\BannerClass as BannerClass;

class BannerMapperClass
{
    protected $db;
    protected $banner;

    function __construct(DbClass $db, BannerClass $banner)
    {
        $this->db = $db;
        $this->banner = $banner;
    }

    public function insertOrUpdate()
    {
        $existingView = $this->getView();
        if (!$existingView) {
            return $this->insertView();
        }
        return $this->updateView($existingView['id']);
    }

    public function getView()
    {
        $queryArgs = [
            ':ip_address' => $this->banner->ipAddress,
            ':user_agent' => $this->banner->userAgent,
            ':page_url' => $this->banner->pageUrl,
        ];

        return $this->db->run('SELECT id FROM views WHERE ip_address = :ip_address and user_agent = :user_agent and page_url = :page_url', $queryArgs)->fetch();
    }

    public function insertView()
    {
        $queryArgs = [
            ':ip_address' => $this->banner->ipAddress,
            ':user_agent' => $this->banner->userAgent,
            ':page_url' => $this->banner->pageUrl,
            ':views_count' => 1,
        ];

        return $this->db->run('INSERT INTO views (ip_address, user_agent, page_url, views_count) VALUES (:ip_address, :user_agent, :page_url, :views_count)', $queryArgs)->rowCount();
    }

    public function updateView($id)
    {
        $queryArgs = [
            ':ip_address' => ip2long($serverArgs['REMOTE_ADDR']),
            ':user_agent' => $serverArgs['HTTP_USER_AGENT'],
            ':page_url' => $serverArgs['REQUEST_URI'],
        ];

        return $this->db->run("UPDATE views SET views_count = views_count + 1 WHERE id = :id", [':id' => $id])->rowCount();
    }
}

