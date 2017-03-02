<?php
$rustart = getrusage();

include_once "LogParser.php";
include_once "Controller/ApacheLogController.php";
include_once "Conf/config.php";

try {

    passthru('clear');
    echo $header;

    if ($options = getopt("f::d::t::h::")) {


        if (isset($options['h'])){
            echo $help;
            die();
        }
        if (isset($options['f']))
            $log_file = $options['f'];
        if (isset($options['d']))
            $db = $options['d'];
        if (isset($options['t']))
            $table = $options['t'];
    }
    $i = 0;
    $parser = new LogParser();
    $db = new ApacheLogController($username, $password, $servername, $db, $table);
    $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $entry = $parser->parse($line);
        $db->save_log($entry);
        $i++;
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage()."\n";
}
echo "Script executed\n";
function rutime($ru, $rus, $index)
{
    return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000))
    - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
}

$ru = getrusage();
echo $footer;
echo "Computations \t:" . rutime($ru, $rustart, "utime") .
    " ms\n";
echo "System calls \t:" . rutime($ru, $rustart, "stime") .
    " ms\n";
echo $footer2;

