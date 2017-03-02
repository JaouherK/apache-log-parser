<?php

/**
 * Created by PhpStorm.
 * User: kharr
 * Date: 22/02/2017
 * Time: 22:16
 */
class ApacheLogController
{
    public $config;
    public $conn;
    private $username;
    private $password;
    private $servername;
    private $db;
    private $table;

    function __construct($user, $pass, $server, $db, $table)
    {
        try {
            $this->username = $user;
            $this->password = $pass;
            $this->servername = $server;
            $this->db = $db;
            $this->table = $table;
            $conn = new PDO("mysql:host=$this->servername", $this->username, $this->password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS ".$this->db;
            $conn->exec($sql);
            $sql = "use ".$this->db;
            $conn->exec($sql);
            $sql = "CREATE TABLE IF NOT EXISTS `".$this->db."`.`".$this->table."` ( `id` INT(50) NOT NULL AUTO_INCREMENT , `host` VARCHAR(255) NOT NULL , `logname` VARCHAR(255) NOT NULL , `user` VARCHAR(255) NOT NULL , `stamp` VARCHAR(255) NOT NULL , `time` VARCHAR(255) NOT NULL , `request` VARCHAR(255) NOT NULL , `status` VARCHAR(255) NOT NULL , `responseBytes` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;";
            $conn->exec($sql);
            echo "DB verified";
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }


    function save_log($data)
    {
        try {
            try {

                $conn = new PDO("mysql:host=$this->servername", $this->username, $this->password,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'ERROR: ' . $e->getMessage();
            }

            $data = (array)$data;
            $sql = "INSERT INTO `".$this->db."`.`".$this->table."` ( `host`, `logname`, `user`, `stamp`, `time`, `request`, `status`, `responseBytes`) VALUES ( :host, :logname, :user_id, :stamp, :time_id, :request, :status, :responseBytes)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':host', $data['host'], PDO::PARAM_STR);
            $stmt->bindParam(':logname', $data['logname'], PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $data['user'], PDO::PARAM_STR);
            $stmt->bindParam(':stamp', $data['stamp'], PDO::PARAM_STR);
            $stmt->bindParam(':time_id', $data['time'], PDO::PARAM_STR);
            $stmt->bindParam(':request', $data['request'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':responseBytes', $data['responseBytes'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}