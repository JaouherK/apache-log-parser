<?php
$rustart = getrusage();

include_once "LogParser.php";
include_once "Controller/ApacheLogController.php";
include_once "Conf/config.php";

try {
    passthru('clear');
    echo $header;
    echo "Script start...\n";
    if ($options = getopt("f::d::t::h::")) {

        if (isset($options['h'])) {
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
    $data = new ApacheLogController($username, $password, $servername, $db, $table);

    echo "Parsing file: " . $log_file . "\n";
    $handle = fopen($log_file, "r");
    $done = 0;
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $entry = $parser->parse($line);
            $data->save_log($entry);
            $done++;
        }
        fclose($handle);
    } else {
        echo "An error occurred: unable to open the file!\n";
    }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage() . "\n";
}

echo "Script executed\n";


$ru = getrusage();
echo $footer;
echo "Computations \t:" . $data->rutime($ru, $rustart, "utime") .
    " ms\n";
echo "System calls \t:" . $data->rutime($ru, $rustart, "stime") .
    " ms\n";
echo "Total lines \t:" . $done . "\n";
echo $footer2;

