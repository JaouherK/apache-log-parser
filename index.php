<?php
$options = getopt("f:g:");
var_dump($options);
include_once "LogParser.php";
include_once "Controller/ApacheLogController.php";
include_once "Conf/config.php";

try {
    $parser = new LogParser();
    $db = new ApacheLogController($username, $password, $servername, $db, $table);
    $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $entry = $parser->parse($line);
        $db->save_log($entry);

    }
 } catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
