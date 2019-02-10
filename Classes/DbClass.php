<?php

namespace Classes;

use \PDO as PDO;

class DbClass extends PDO
{
    public function __construct($dsn, $username = NULL, $password = NULL, $options = [])
    {
        $default_options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];
        $options = array_replace($default_options, $options);
        try {
            parent::__construct($dsn, $username, $password, $options);
        } catch(\PDOException $exception) {
            throw new \Exception($exception->getMessage());
        }
        
    }
    public function run($sql, $args = NULL)
    {
        if (!$args) {
             return $this->query($sql);
        }
        $stmt = $this->prepare($sql);

        try {
            $stmt->execute($args);
        } catch(\PDOException $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $stmt;
    }
}