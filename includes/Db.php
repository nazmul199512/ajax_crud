<?php

namespace crud;

use mysqli;

class Db {
    const info = [
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => '',
        'name'     => 'crud',
    ];

    function __construct() {
        $this->db = self::db();
    }

    public static function db() {
        $db = false;

        if (! $db ) {
            $db = new mysqli(
                self::info['host'],
                self::info['user'],
                self::info['password'],
                self::info['name']
            );
        }

        return $db;
    }

    public static function qry( $qry ) {
        return self::db()->query( $qry );
    }

    public static function create_table() {        
        $schema = "CREATE TABLE IF NOT EXISTS `employee` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `first_name` longtext DEFAULT NULL,
                `last_name` longtext DEFAULT NULL,
                `job_title` longtext DEFAULT NULL,
                `date_of_birth` longtext DEFAULT NULL,
                `work_shift` longtext DEFAULT NULL,
                `mobile` longtext DEFAULT NULL,
                `email` longtext DEFAULT NULL,
                `address` longtext DEFAULT NULL,
                `joined` longtext DEFAULT NULL,
                PRIMARY KEY (`id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        self::qry( $schema );        
    }
}